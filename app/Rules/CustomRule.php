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
    public $project_id;

    public function __construct($number, $project_id)
    {
        $this->number = $number;
        $this->project_id = $project_id;
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
        // Fetch the project and its related buses
        $project = Project::where('id', $this->project_id)->with('Bus')->first();
        
        if (!$project) {
            return false;
        }

        $start_date = $project->start_date;
        $end_date = $project->end_date;

        $buses = $project->Bus;

        $number_of_people = 0;
        $text = '';

        foreach ($buses as $bus) {
            $number_of_people_in_bus = TripBooking::where('bus_id', $bus->id)
                ->where('status', '1')
                ->whereHas('Project', function ($query) use ($start_date, $end_date) {
                    $query->whereBetween('start_date', [$start_date, $end_date]);
                })
                ->sum('number_of_people');

            $remaining_seats = $bus->number_of_seats - $number_of_people_in_bus;
            $text .= 'اسم الباص: ' . $bus->bus_number . " عدد الاشخاص المتبقي: " . $remaining_seats . "</br>";

            $number_of_people += $number_of_people_in_bus;
        }

        // Output the total number of people
        $text .= "إجمالي عدد الأشخاص: " . $number_of_people . "</br>";

        // Check if there are enough seats in the buses
        $total_seats = $buses->sum('number_of_seats');
        if ($total_seats >= $this->number) {
            return true;
        }

        $this->message = $text; // Set the custom message
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
