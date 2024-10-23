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
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'pdf'){
                $data = file_get_contents($image);
                $base64 = base64_encode($data);
            }
        }
        else{
            $base64='';
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

  
    //Convert Image To base64 2
    function convertImage2($image)
    {
        if ($image){
            $ext = $image->extension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'pdf'){
                $data = file_get_contents($image);
                $base64 = base64_encode($data);
            }
        }
        return ($base64);
    }

    //Get Extension From Image 2
    function getExtensionImage2($image)
    {
        if ($image){
            $ext = $image->extension();
        }
        return ($ext);
    }
  
    //Convert Image To base64 3
    function convertImage3($image)
    {
        if ($image){
            $ext = $image->extension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'pdf'){
                $data = file_get_contents($image);
                $base64 = base64_encode($data);
            }
        }
        return ($base64);
    }

    //Get Extension From Image 3
    function getExtensionImage3($image)
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
            if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
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
        else{
            $ext='';
        }
        return ($ext);
    }
}

?>