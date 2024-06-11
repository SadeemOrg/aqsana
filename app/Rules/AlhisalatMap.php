<?php

namespace App\Rules;


use App\Models\Bus;
use App\Models\Project;
use App\Models\TripBooking;
use Illuminate\Contracts\Validation\Rule;

class AlhisalatMap implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        if ($value == "null") {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'هذا الحقل مطلوب';
    }
}
