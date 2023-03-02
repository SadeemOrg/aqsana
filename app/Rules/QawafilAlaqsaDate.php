<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class QawafilAlaqsaDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     public $Date;
    public function __construct($Date)
    {
        $this->Date = $Date;
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
        $starttime = Carbon::parse($this->Date);
        $finishTime = Carbon::parse($value);

        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
//   dd($startDate->lt($endDate));

        return ($startDate->lt($endDate));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تاربج نهاية القافلة اقل من تاربج انطلاق القافلة';
    }
}
