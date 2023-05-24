<?php

class Rememberfields
{

    public static function getInputValue($name)
    {
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }

}