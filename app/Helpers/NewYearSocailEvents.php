<?php

namespace App\Helpers;

use Carbon\Carbon;

class NewYearSocailEvents
{
    protected $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
    protected $headers=['Month', 'Brunch & Catchup', 'Thirsty Thursday', 'Friday Fry-up'];
    protected $fileName='socail-events';

    public function makeSocailEvents()
    {
        //array of each month object data
        $socailEvents = [];

        foreach ($this->months as $monthIndex => $month) {
            $thisMonthIndex = $monthIndex + 1;
            $MonthlySocalEvents=[];

            array_push($MonthlySocalEvents,$month);
            //Month Date
            $date = $thisMonthIndex . '/' . Carbon::now()->year;
            array_push($MonthlySocalEvents,$date);
            //First Monday of the month
            $brunchAndCatchup = Carbon::parse('first monday of' . $month)->format('d/m/Y');
            array_push($MonthlySocalEvents,$brunchAndCatchup);
            //3rd Thursday of the month
            $thirstyThursday = Carbon::parse('third thursday of' . $month)->format('d/m/Y');
            array_push($MonthlySocalEvents,$thirstyThursday);
            //last friday of the month
            $fridayFryUp = Carbon::parse('last friday of' . $month)->format('d/m/Y');
            array_push($MonthlySocalEvents,$fridayFryUp);

            array_push($socailEvents, $MonthlySocalEvents);
        }
        $generateCSV=new GenerateCSV();

        return $generateCSV->GenerateFileCSV($this->fileName,$this->headers,$socailEvents);
    }

}
