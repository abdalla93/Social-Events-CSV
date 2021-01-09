<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class GenerateCSV
{

     /**
     * create and download new csv file to CSV_files folder.
     *
     * @param  string  $name
     * @param  array  $fileHeaders
     * @param  array  $data
     */
    public function GenerateFileCSV($name,$fileHeaders,$data)
    {
        $fileName = $name.'-' . Carbon::parse()->year . '.csv';
        $filePath = "CSV_files/" . $fileName;
        $handle = fopen($filePath, 'w+');
        fputcsv($handle, $fileHeaders);

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filePath, $fileName, $headers);
    }

}
