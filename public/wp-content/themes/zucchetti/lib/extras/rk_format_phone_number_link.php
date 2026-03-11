<?php
/**
 *	Formats a string into a useable phone number for tel hrefs
 *	prefixes with a '+'
 */
function formatPhoneNumber($number) {
    
    return preg_replace("![^a-z0-9]+!i", "", $number);
}