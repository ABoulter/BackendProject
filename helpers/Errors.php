<?php
class Errors
{
    public static $firstNameCharacters = "Your first name must be between 3 and 65 characters";
    public static $lastNameCharacters = "Your last name must be between 3 and 65 characters";
    public static $usernameCharacters = "Your username must be between 3 and 65 characters";
    public static $usernameTaken = "This user already exists";
    public static $emailTaken = "This email is already in use";
    public static $invalidEmail = "Please provide a valid email";
    public static $emailsDontMatch = "Please confirm your email";
    public static $passwordsDontMatch = "Please confirm your password";
    public static $passwordLength = "Your password must be between 8 and 1000 characters";
    public static $loginFailed = "Your username or password was incorrect";

    public static function showHttpError($src, $alt)
    {
        die("<div class='errorImg'>
                <img  src='$src' alt='$alt'>
            </div>");
    }
}

?>