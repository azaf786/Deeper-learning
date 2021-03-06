<?php

echo time(); //161504978920
echo"<br>";
echo date('Y-m-d H:i:s' ); //21-03-06 16:56:29
echo"<br>";
echo strtotime('+1 week 2 hours');
echo"<br>";
$oneDayToday = date('Y-m-d', strtotime('+1 week'));
echo($oneDayToday);
?>