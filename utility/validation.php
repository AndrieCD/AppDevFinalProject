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

    function checkDBEmail()
    {
        //this function checks if the inputted email is in the database and returns if admin or voter
    }

    // Password validation. 
    // The password should have atleast 8 characters, one uppercase, one lowercase, one number, and one special character.

    function validatePassword($password) 
    {
        $passwordFormat = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
        return preg_match($passwordFormat, $password);
    }

    function checkDBPassword()
    {
        //this function checks if the inputted password matches the respective email.
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
        $partyNameFormat = "/^[A-Za-z]{5,}$/";
        return preg_match($partyNameFormat, $party);
    }

    // $email = "sampleemail@sample.com";
    // $password = "StrongP@ss1";

    // if (validateEmail($email)) {
    //     echo "Valid email<br>";
    // } else {
    //     echo "Invalid email<br>";
    // }

    // if (validatePassword($password)) {
    //     echo "Valid password<br>";
    // } else {
    //     echo "Invalid password<br>";
    // }

?>
<!-- ========== Email, Password, Positions, Party name (like 5letters more, bawal numbers ganun), Candidate name (letters only) ========== -->
