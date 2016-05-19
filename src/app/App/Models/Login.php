<?php
namespace App\Models;

abstract class Login {
    
    public static function initializeVars()
    {
        // Initialize vars
        $data = ['username' => ''];
        
        // Overwrite vars with applicable SESSION data
        if(isset($_SESSION['loginFormData'])):
            $data['username'] = $_SESSION['loginFormData']['username'];
        endif;
        
        return $data;
    }
    
    public static function validateSubmission(array $data)
    {
        // Initialize validation data
        $data['validSubmission'] = true;
        unset($data['errorMsgs']);
        
        // Check required fields
        $requiredFields = ['username', 'password'];
        foreach ($requiredFields as $fieldName):
            if (trim($data[$fieldName]) == ''):
                $data['errorMsgs'][] = ucfirst($fieldName) . ' is required.';
                $data['validSubmission'] = false;
            endif;
        endforeach;
        
        // Check username is email
        if (!filter_var($data['username'], FILTER_VALIDATE_EMAIL)):
            $data['errorMsgs'][] = "Username is not a valid email.";
            $data['validSubmission'] = false;
        endif;
        
        return $data;
    }
    
}