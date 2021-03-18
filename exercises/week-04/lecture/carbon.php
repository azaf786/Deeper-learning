<?php

require_once'setup.php';

use Carbon\carbon;

$birthday = Carbon::createFromDate(1999,07,26);
$age = $birthday->age;

echo 'You are ' . $age . ' years old. ' . '<br>';
echo 'Date of birth: '. $birthday->format('D/M/Y');

$rightNow = Carbon::now();
$midnight = Carbon::today();
$diff = $rightNow->diff($midnight);

var_dump($diff);
