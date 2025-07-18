<!-- ========== Validation for all fieldsets ========== -->
<?php

    // email validation. 
    // The email should be a valid email like: sample@sample.com
    // There should be no spaces or invalid characters.
    function validateEmail($email) 
    {
    $emailFormat = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($emailFormat, $email);
    }

    // Password validation. 
    // The password should have atleast 8 characters, one uppercase, one lowercase, one number, and one special character.

    function validatePassword($password) 
    {
        $passwordFormat = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
        return preg_match($passwordFormat, $password);
    }

    // Candidate Name validation.
    // The candidate name should only be letters and spaces.

    function validateCandidateName($name) 
    {
        $candidateNameFormat = "/^[A-Za-z]+(?: [A-Za-z]+)*$/";
        return preg_match($candidateNameFormat, $name);
    }
    
    // Party Name validation.
    // The party name should 5 or more characters and only contain Upper and lowercase letters.
    function validatePartyName($party) 
    {
        $partyNameFormat = "/^[A-Za-z ]{5,}$/"; 
        return preg_match($partyNameFormat, $party);
    }

    function validateSession() 
    {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
            header("Location: ../index.php");
            exit;
        }
    }

?>
<!-- ========== Email, Password, Positions, Party name (like 5letters more, bawal numbers ganun), Candidate name (letters only) ========== -->
