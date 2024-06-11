<?php

namespace App\Rules;


use App\Models\Bus;
use App\Models\Project;
use App\Models\TripBooking;
use Illuminate\Contracts\Validation\Rule;

class CustomRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $number;
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $IsFull = 1;

        $projext = Project::where('id', $value)->with('bus')->first();

        $buss = $projext->bus;
        $number_of_people_in_all=0;
        $number_of_seats_in_all=0;

        foreach ($buss as $key => $bus) {

            $number_of_people = TripBooking::where([
                ['bus_id', $bus->id],
                ['status', '1'],
            ])->sum('number_of_people');

            $number_of_seats_in_all +=$bus->number_of_seats;
            $number_of_people_in_all +=$number_of_people;




        }
           if (($number_of_seats_in_all >= $this->number)) {
                return true;
            }
            return false;


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'الحافلات ممتلئة';
    }
}
