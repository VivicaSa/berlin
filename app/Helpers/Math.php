<?php

namespace App\Helpers;

class Math
{

    public function ageCalculator($birthdate) {

        $age = date_diff(date_create($birthdate), date_create('now'))->y;
        return $age;
    }


}