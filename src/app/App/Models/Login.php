<?php
namespace App\Models;

abstract class Login {
    
    public static function validateSubmission(array $data)
    {
        return true;
    }
    
}