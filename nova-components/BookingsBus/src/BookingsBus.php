<?php

namespace Acme\BookingsBus;

use Laravel\Nova\Fields\Field;

class BookingsBus extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'bookings-bus';


    public function hues(array $hues)
    {
        return $this->withMeta(['hues' => $hues]);
    }
}
