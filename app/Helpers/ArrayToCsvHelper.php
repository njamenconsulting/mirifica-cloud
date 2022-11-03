<?php

namespace App\Helpers;

class ArrayToCsvHelper
{
    public static function createCsvFileFromArray($filename,$csv_content,$separator)
    {

        $filename = date('Ymd-His') . '-' . $filename . '.csv';

        //$path = public_path('csv_reports/' . $filename);
        $path = storage_path('app/public/').''.$filename;

        # Configure fopen to create, open, and write data.
        $fp = fopen($path, 'a');
        if ($fp === false) {
            die('Error opening the file ' . $filename);
        }
        //If the content is not empty array
        if(count($csv_content) >0 ) {

            fputcsv($fp, array_keys($csv_content[0])); // Add the keys as the column headers

            // Loop over the array and passing in the values only.
            foreach ($csv_content as $row) {
                fputcsv($fp, $row);
            }
            // Close the file
            fclose($fp);
        }
        else {
            fputcsv($fp, ["No stock updates found"]);
        }
    }
}
