<?php
namespace App\Models;

abstract class Login {
    
    public static function initializeVars()
    {
        $data = ['username' => ''];
        return $data;
    }
    
    public static function validateSubmission(array $data)
    {
        $data['validSubmission'] = true;
        
        // Check required fields
        $requiredFields = ['username', 'password'];
        foreach ($requiredFields as $fieldName):
            if (trim($data[$fieldName]) == ''):
                $data['missingFields'][] = $fieldName;
                $data['validSubmission'] = false;
            endif;
        endforeach;
        
        // Check username is email
        if (!filter_var($data['username'], FILTER_VALIDATE_EMAIL)):
            $data['validSubmission'] = false;
        endif;
        
        return $data;
    }
    
}