<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class passwordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $Oldpasw;

    public function __construct($Oldpasw)
    {
        $this->Oldpasw = $Oldpasw;
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
       return (Hash::check($value,$this->Oldpasw));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'كلمة المرور خاطئة';
    }
}
