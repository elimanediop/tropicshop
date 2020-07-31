<?php


namespace App\Services\Utils;


class Utils
{
    /**
     * @param string $file_path
     * @return array
     */
    public function getCSVContent(string $file_path){
        $dataCsvArray = [];
        $dataCsvAssoc = [];
        $handle = fopen($file_path,'r');
        ini_set('auto_detect_line_endings',TRUE);
        while ( ($data = fgetcsv($handle) ) !== FALSE ) {
            $dataCsvArray[] = $data;
        }
        ini_set('auto_detect_line_endings',FALSE);
        $array_keys = $dataCsvArray[0];
        array_shift($dataCsvArray);
        foreach ($dataCsvArray as $productValue){
            $dataCsvAssoc[] = array_combine($array_keys, $productValue);
        }
        return $dataCsvAssoc;
    }

}