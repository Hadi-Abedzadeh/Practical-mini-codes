<?php

function clear_phone($phone, $phone_code = 0)
{
    $clear_phones = null;
    $regex = '/^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/';

    $phone = str_replace(" ", "", $phone);
    preg_match_all($regex, $phone, $matches);

    if (isset($matches[2][0])) {
        $clear_phones = $phone_code . $matches[2][0];
    }
    

    return $clear_phones;
}
