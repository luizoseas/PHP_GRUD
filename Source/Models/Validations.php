<?php

namespace Source\Models;

final class Validations{
    public static function validationString(string $String){
        return strlen($String)>=3 && !is_numeric($String);
    }
    public static function validationEmail(string $Email){
        return filter_var($Email,FILTER_VALIDATE_EMAIL);
    }
    public static function validationInteger(string $Integet){
        return filter_var($Integet,FILTER_VALIDATE_INT) && $Integet>0;
    }
}