<?php

namespace App\Rules;

use App\Models\Bus;
use Illuminate\Contracts\Validation\Rule;

class CustomRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // dd($value);

        $Buss =  Bus::where('id', $value)->withCount('TripBookings')->first();
        // echo $post->id;
        // dd($Buss->trip_bookings_count  < $Buss->number_of_seats);
        if ( ($Buss->trip_bookings_count  < $Buss->number_of_seats)) {
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
        return 'The buss is full.';
    }
}
