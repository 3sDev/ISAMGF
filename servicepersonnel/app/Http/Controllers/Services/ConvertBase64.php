<?php

namespace App\Http\Controllers\Services;

/**
 * 
 */
trait ConvertBase64
{
    //Convert Image To base64
    function convertImage($image)
    {
        if ($image){
            $ext = $image->extension();
            if ($ext == 'pdf' || $ext == 'doc' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'doc' || $ext == 'docx' || $ext == 'rtf' || $ext == 'xls' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'txt' || $ext == 'zip' || $ext == 'rar'){
                $data = file_get_contents($image);
                $base64 = base64_encode($data);
            }
        }
        return ($base64);
    }

    //Get Extension From Image
    function getExtensionImage($image)
    {
        if ($image){
            $ext = $image->extension();
        }
        return ($ext);
    }

    //Convert File To base64
    function convertFile($file)
    {
        if ($file){
            $ext = $file->extension();
            if ($ext == 'pdf'){
                $data = file_get_contents($file);
                $base64 = base64_encode($data);
            }
        }
        return ($base64);
    }

    //Convert All Types of File To base64
    function convertAllFile($file)
    {
        if ($file){
            $ext = $file->extension();
            if ($ext == 'pdf' || $ext == 'doc' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'doc' || $ext == 'docx' || $ext == 'rtf' || $ext == 'xls' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'txt' || $ext == 'zip' || $ext == 'rar'){
                $data = file_get_contents($file);
                $base64 = base64_encode($data);
            }
        }
        return ($base64);
    }

    //Get Extension from File
    function getExtensionFile($file)
    {
        if ($file){
            $ext = $file->extension();
        }
        return ($ext);
    }
}

?>