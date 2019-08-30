<?php
function palindrome($string)
{
    if (strlen($string) == 1) {
        return "palindrome";
    }

    if (substr($string, 0, 1) === substr($string, -1, 1)) {
        if (strlen($string) == 2) {
            return "palindrome";
        }
        return palindrome(substr($string, 1, -1));
    } else {
        return "not palindrome";
    }
}

echo palindrome("testset");