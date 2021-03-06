<?php
/**
 * Login model
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace App\Models;

/**
 * Models front-end login behavior.
 */
abstract class Login
{
    
    /**
     * Initializes the vars for display of the login form. Things like the username and error messages.
     * Input overwritten by user's previous login submission($_SESSION['loginForm']), if applicable.
     * 
     * @return array $data Initialized data to populate the form fields
     */
    public static function initializeVars()
    {
        // Initialize form vars
        $data = ['username' => ''];
        
        // Overwrite applicable form fields with SESSION data
        if(isset($_SESSION['loginForm'])):
            $data['username'] = $_SESSION['loginForm']['submission']['username'];
        endif;
        
        return $data;
    }
    
    /**
     * Validates a user's login submission for things like required fields and email address.
     *
     * @param array $data Login submission data
     * @return array $validationResults Validation results including any errors.
     */
    public static function validateSubmission(array $data)
    {
        // Initialize validation results
        $validationResults['validSubmission'] = true;
        $validationResults['errors'] = [];
        
        // Check required fields
        $requiredFields = ['username', 'password'];
        foreach ($requiredFields as $fieldName):
            if (trim($data[$fieldName]) == ''):
                $validationResults['errors'][] = ucfirst($fieldName) . ' is required.';
                $validationResults['validSubmission'] = false;
            endif;
        endforeach;
        
        // Check username is email
        if (!filter_var($data['username'], FILTER_VALIDATE_EMAIL)):
            $validationResults['errors'][] = "Username is not a valid email.";
            $validationResults['validSubmission'] = false;
        endif;
        
        return $validationResults;
    }
    
}