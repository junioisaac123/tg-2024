<?php

if (! function_exists('getLetterFromNumber')) {
    function getLetterFromNumber($number)
    {
        // Check if the number is within the range of 0-25
        if ($number >= 0 && $number <= 25) {
            // Use chr() to get the corresponding ASCII character
            return chr($number + 65);
        } else {
            throw "Invalid input. Enter a number between 0 and 25.";
        }
    }
}

if (! function_exists('getNumberFromLetter')) {
    function getNumberFromLetter($letter)
    {
        // Check if the letter is within the range of A-Z
        if ($letter >= 'A' && $letter <= 'Z') {
            // Use ord() to get the corresponding ASCII code
            return ord($letter) - 65;
        } else {
            throw "Invalid input. Enter a letter between A and Z.";
        }
    }
}
