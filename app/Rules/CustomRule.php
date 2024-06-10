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

        // dd("dd");
        foreach ($buss as $key => $bus) {
            $number_of_people = TripBooking::where([
                ['bus_id', $bus->id],
                ['status', '1'],
            ])->sum('number_of_people');
            $number_of_people += $this->number;

            if (($number_of_people  < $bus->number_of_seats)) {
                return true;
            }

            return false;
        }



        // // dd( $this->number , $attribute , $va lue );
        // $Buss =  Bus::where('id', $value)->withCount('TripBookings')->first();
        // $number_of_people =  TripBooking::where('bus_id', $value)->sum('number_of_people');
        // // dd(   $number_of_people);
        // $number_of_people += $this->number;
        // if (($number_of_people  < $Buss->number_of_seats)) {
        //     return true;
        // }
        // return false;

        // dd($Buss->trip_bookings_count  < $Buss->number_of_seats);
        // if ( ($Buss->trip_bookings_count  < $Buss->number_of_seats)) {
        //     return true;
        // }
        // return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The buss is full.';
    }
}
