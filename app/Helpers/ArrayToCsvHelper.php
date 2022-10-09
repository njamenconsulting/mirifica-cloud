<?php

namespace App\Helpers;

class ArrayToCsvHelper
{
    public static function createCsvFileFromArray($filename,$csv_content,$separator)
    {

        $filename = date('Ymd-His').'-'.$filename.'.csv';

        $path = public_path('csv_reports/'.$filename);

        # Configure fopen to create, open, and write data.
        $fp = fopen($path, 'a');
        if ($fp === false) {
            die('Error opening the file ' . $filename);
        }
        fputcsv($fp, array_keys($csv_content[0])); // Add the keys as the column headers

        // Loop over the array and passing in the values only.
        foreach ($csv_content as $row)
        {
            fputcsv($fp, $row);
        }
        // Close the file
        fclose($fp);
    }
}
