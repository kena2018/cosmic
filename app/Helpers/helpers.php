<?php

if (!function_exists('formatIndianCurrency')) {
    function formatIndianCurrency($number) {
        $number = (string) $number;

        if (strpos($number, '.') !== false) {
            list($integerPart, $decimalPart) = explode('.', $number);
        } else {
            $integerPart = $number;
            $decimalPart = '';
        }

        $integerPart = str_replace(',', '', $integerPart);

        $lastThreeDigits = substr($integerPart, -3);
        $otherDigits = substr($integerPart, 0, -3);

        if ($otherDigits !== '') {

            $otherDigits = preg_replace('/(?<=\d)(?=(\d{2})+(?!\d))/', ',', $otherDigits);
            $integerPart = $otherDigits . ',' . $lastThreeDigits;
        } else {
            $integerPart = $lastThreeDigits;
        }

        if ($decimalPart !== '') {
            return '₹' . $integerPart . '.' . $decimalPart;
        }

        return '₹' . $integerPart;
    }
}

if (!function_exists('formatIndianCurrencyNumber')) {
    function formatIndianCurrencyNumber($number) {
        $number = (string) $number;

        if (strpos($number, '.') !== false) {
            list($integerPart, $decimalPart) = explode('.', $number);
        } else {
            $integerPart = $number;
            $decimalPart = '';
        }

        $integerPart = str_replace(',', '', $integerPart);

        $lastThreeDigits = substr($integerPart, -3);
        $otherDigits = substr($integerPart, 0, -3);

        if ($otherDigits !== '') {

            $otherDigits = preg_replace('/(?<=\d)(?=(\d{2})+(?!\d))/', ',', $otherDigits);
            $integerPart = $otherDigits . ',' . $lastThreeDigits;
        } else {
            $integerPart = $lastThreeDigits;
        }

        if ($decimalPart !== '') {
            return $integerPart . '.' . $decimalPart;
        }

        return $integerPart;
    }
}

if (!function_exists('convertToPlainNumber')) {
    function convertToPlainNumber($formattedNumber) {
        // If the input is an array, apply the function to each element
        if (is_array($formattedNumber)) {
            return array_map('convertToPlainNumber', $formattedNumber);
        }

        // Ensure the input is a string
        if (!is_string($formattedNumber)) {
            return $formattedNumber; // or handle this case as needed
        }

        // Remove any non-numeric characters (like ₹ and commas)
        $plainNumber = preg_replace('/[^\d.]/', '', $formattedNumber);

        // Convert to a float or integer
        return strpos($plainNumber, '.') !== false ? (float) $plainNumber : (int) $plainNumber;
    }
}


