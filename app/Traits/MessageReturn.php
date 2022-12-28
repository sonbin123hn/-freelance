<?php

namespace App\Traits;

trait MessageReturn
{
    public static function convertArrayMessage($arrayMessage)
    {
        $errors = [];
        foreach ($arrayMessage as $k => $val) {
            foreach ($val as $value) {
                $errors[] = $value;
            }
        }
        return array_unique($errors);
    }
}
