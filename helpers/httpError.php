<?php
class HttpError
{


    public static function showHttpError($src, $alt)
    {
        die("<div class='errorImg'>
                <img  src='$src' alt='$alt'>
            </div>");
    }
}