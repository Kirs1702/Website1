<?php

session_start();

function checkData($x, $y, $r){
    $xValues = array(-4, -3, -2, -1, 0, 1, 2, 3, 4);
    $rValues = array(1, 1.5, 2, 2.5, 3);
    if ((!is_numeric($x)) or (!in_array($x, $xValues))) return false;
    if ((($y<=-5) or ($y>=5)) or (!is_numeric($y))) return false;
    if ((!is_numeric($r)) or (!in_array($r, $rValues))) return false;
    return true;

}


function checkHit($x,$y,$r){
    if (($x <= 0) and ($y <= 0) and ($x >= -$r) and ($y >= -($r / 2))) return "Да";     //прямоугольник
    if (($x >= 0) and ($y >= 0) and ($y <= -$x + $r)) return "Да";                      //треугольник
    if (($x >= 0) and ($y <= 0) and ($x*$x + $y*$y <= $r*$r)) return "Да";              //круг
    return "Нет";
}



if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(500);
    exit;
}

$startTime = microtime(true);

try {
    $x = $_GET['x'];
    $y = $_GET['y'];
    $r = $_GET['r'];
} catch (Exception $e) {http_response_code(500);}

if (!checkData($x,$y,$r)){
    http_response_code(500);
    exit;
}

$result = checkHit($x,$y,$r);

date_default_timezone_set('Europe/Moscow');

$currentTime = date("H:i:s");

$executionTime = number_format((microtime(true)-$startTime)*1000000,3,".","");

if (!isset($_SESSION['dataHistory'])) {
    $_SESSION['dataHistory'] = array();
}

$columns = "        <tr>
            <th id=\"xColumn\">X</th>
            <th id=\"yColumn\">Y</th>
            <th id=\"rColumn\">R</th>
            <th id=\"currentTime\">Текущее время</th>
            <th id=\"executionTime\">Время работы</th>
            <th id=\"resultColumn\">Результат</th>
        </tr>";


$currentResponse=
    "<tr>
<td>$x</td>
<td>$y</td>
<td>$r</td>
<td>$currentTime</td>
<td>$executionTime мкс</td>
<td>$result</td>
</tr>";

$response = '';
array_push($_SESSION['dataHistory'],$currentResponse);

foreach($_SESSION['dataHistory'] as $value){
    $response = $response.$value;
}
echo $columns.$response;