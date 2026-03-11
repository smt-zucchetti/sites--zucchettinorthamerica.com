<?php

function rk_phone_number_to_href($number) {
    // Map letters to phone keypad digits
    $letters_to_numbers = [
        'A' => '2', 'B' => '2', 'C' => '2',
        'D' => '3', 'E' => '3', 'F' => '3',
        'G' => '4', 'H' => '4', 'I' => '4',
        'J' => '5', 'K' => '5', 'L' => '5',
        'M' => '6', 'N' => '6', 'O' => '6',
        'P' => '7', 'Q' => '7', 'R' => '7', 'S' => '7',
        'T' => '8', 'U' => '8', 'V' => '8',
        'W' => '9', 'X' => '9', 'Y' => '9', 'Z' => '9'
    ];

    // Uppercase the string and replace letters
    $number = strtoupper($number);
    $number = strtr($number, $letters_to_numbers);

    // Keep only digits and plus sign
    $digits = preg_replace('/[^0-9+]/', '', $number);

    // Optional: prepend +1 if missing and likely US number
    if (strlen($digits) === 10) {
        $digits = '+1' . $digits;
    }

    return 'tel:' . $digits;
}