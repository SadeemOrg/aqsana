<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;

class ExportReport extends Action
{
    public  function name()
    {
        return __('Export To Exsel');
    }
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $string = '?reselt=' . $models->pluck('id') . '&from=' . $fields->from . '&to=' . $fields->to . '&dateType=' . $fields->type . '&PaymentType=' . $fields->Payment_type. '&print=' . $fields->print;

        return Action::openInNewTab('/export/ExportReport' . $string);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('نوع التاريخ', 'type')
                ->options([
                    '1' => 'تاريخ السند',
                    '2' => 'تاريخ الدفعة',
                ])
                ->displayUsingLabels()->default(1),
            Select::make(__("Payment_type"), "Payment_type")->options(
                [
                    '0' => __('all'),
                    '1' => __('cash'),
                    '2' => __('shek'),
                    '3' => __('bit'),
                    '4' => __('hawale'),
                    '5' => __('حصالة'),
                    // '6' => __('التطبيق'),

                ]
            )->displayUsingLabels()->default(0),
            Date::make(__('from'), 'from')->required(),
            Date::make(__('to'), 'to')->required(),
            Select::make('معاينة ', 'print')
                ->options([
                    '1' => 'معاينة قبل الطباعة',
                    '2' => 'تنزيل Excel',
                ])
                ->displayUsingLabels()->default(1),

        ];
    }
}
