<?php

namespace App\Helpers;

use Carbon\Carbon;

class NewYearSocailEvents
{
    protected $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
    protected $headers = ['Month', 'Brunch & Catchup', 'Thirsty Thursday', 'Friday Fry-up'];
    protected $fileName = 'socail-events';

    public function makeSocailEvents()
    {
        //array of each month object data
        $socailEvents = [];

        $thisMonth=Carbon::parse()->month;
        $thisYear = Carbon::parse()->year;
        
        $month = $thisMonth;
        do {
            $MonthlySocalEvents = [];

            $monthName = $this->months[$month - 1];
            //Month Date
            $date = $month . '/' . $thisYear;
            array_push($MonthlySocalEvents, $date);
            //First Monday of the month 
            $brunchAndCatchup = Carbon::parse('first monday of' . $monthName . ' ' . $thisYear)->format('d/m/Y');
            array_push($MonthlySocalEvents, $brunchAndCatchup);
            //3rd Thursday of the month
            $thirstyThursday = Carbon::parse('third thursday of' . $monthName . ' ' . $thisYear)->format('d/m/Y');
            array_push($MonthlySocalEvents, $thirstyThursday);
            //last friday of the month
            $fridayFryUp = Carbon::parse('last friday of' . $monthName . ' ' . $thisYear)->format('d/m/Y');
            array_push($MonthlySocalEvents, $fridayFryUp);

            array_push($socailEvents, $MonthlySocalEvents);

            if ($month == 12) {
                $month = 1;
                $thisYear = Carbon::now()->addYear()->year;
            } else {
                $month++;
            }

        } while ($month != $thisMonth);
        $generateCSV = new GenerateCSV();

        return $generateCSV->GenerateFileCSV($this->fileName,$this->headers,$socailEvents);
    }

}
