<?php

namespace App;

// use finfo;

use Valitron\Validator as ValitronValidator;

class Validator extends ValitronValidator {


    protected static $_lang = "fr";

    public function __construct($data = array(), $fields = array(), $lang = null, $langDir = null)
    {
        parent::__construct($data, $fields, $lang, $langDir);
        self::addRule('image', function( $field, $value, array $params, array $fields){
            if ($value['size'] === 0){
                return true;
            }else{
                $mimes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $fileinfoMIME = finfo_file($fileinfo, $value['tmp_name']);
                finfo_close($fileinfo);
                return in_array($fileinfoMIME,$mimes);
            }

        }, 'Le fichier est invalide');
    }

    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message) . '.';
    }

}