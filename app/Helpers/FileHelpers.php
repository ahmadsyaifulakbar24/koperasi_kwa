<?php

namespace App\Helpers;

class FileHelpers {
    
    public static function uploadFile($path, $requestFile)
    {
        $couter = 0;
        $name_of_upload = $requestFile->getClientOriginalName();
        $original_name = pathinfo($name_of_upload, PATHINFO_FILENAME);
        $ext = $requestFile->getClientOriginalExtension();
        
        if($requestFile->isValid()) {
            while(file_exists($path.$name_of_upload)) {
                $couter++;
                $name_of_upload = $original_name." (".$couter.").".$ext;
            }
            $requestFile->move($path, $name_of_upload);
            return $name_of_upload;
        }
    }

    public static function removeFile($path)
    {
        if(file_exists($path)) {
            unlink($path);
            $message = "success delete file";
        } else {
            $message = "file not found";
        }
        return $message;
    }
}