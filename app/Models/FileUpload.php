<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class FileUpload extends Model
{
    use HasFactory;
}*/


class FileUpload {
    public static function upload_ori($file, $directory = ''){
        try {
            if (!$directory) {
                    $directory = '/uploads/';
            }else{
                if (!self::startsWith($directory, '/')) {
                        $directory = '/' . $directory;
                }
                if (!self::endsWith($directory, '/')) {
                        $directory = $directory . '/';
                }
            }
            $today = date('d-m-Y', time());
            $path = public_path() . $directory;
            $ext = '.' . $file->getClientOriginalExtension();
            $filename = $today.'-'.md5(round(microtime(true)) . '_' . uniqid()) . $ext;
            $file->move($path, $filename);
            $uploaded_file_path = $directory . $filename;
            return $uploaded_file_path;
        } catch (Exception $e) {
                return '';
        }
    }

    public static function upload($file, $directory = ''){
        try {
            $directory = 'uploads/'.$directory.'/';

            $today      = date('d-m-Y', time());
            // $path       = public_path() . '/uploads/'.$directory.'/';
            $path       = public_path('/') . $directory;
            $ext        = '.' . $file->getClientOriginalExtension();
            $filename   = md5(round(microtime(true))) . $ext;
            $file->move($path, $filename);
            $uploaded_file_path = $directory . $filename;

            return $uploaded_file_path;
        } catch (Exception $e) {
                return '';
        }
    }

    //Multiple file uploads
    public static function file_uploads($file, $directory = ''){
        try {
            if (!$directory) {
                    $directory = '/uploads/';
            }else{
                if (!self::startsWith($directory, '/')) {
                        $directory = '/' . $directory;
                }
                if (!self::endsWith($directory, '/')) {
                        $directory = $directory . '/';
                }
            }
            $today = date('d-m-Y', time());
            $path = public_path() . $directory;
            $ext = '.' . $file->getClientOriginalExtension();
            $filename = md5(round(microtime(true))) . $ext;
            $file->move($path, $filename);
            $uploaded_file_path = $directory . $filename;
            return $filename;
        } catch (Exception $e) {
                return $e;
        }
    }

    private static function startsWith($haystack, $needle){
         return (substr($haystack, 0, strlen($needle)) === $needle);
    }

    private static function endsWith($haystack, $needle){
         return (substr($haystack, -strlen($needle)) === $needle);
    }
}