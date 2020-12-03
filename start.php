<?php
session_start();
$response = "<tr>
            <th id=\"xColumn\">X</th>
            <th id=\"yColumn\">Y</th>
            <th id=\"rColumn\">R</th>
            <th id=\"currentTime\">Текущее время</th>
            <th id=\"executionTime\">Время работы</th>
            <th id=\"resultColumn\">Результат</th>
        </tr>";

if (isset($_SESSION['dataHistory'])) {
    foreach ($_SESSION['dataHistory'] as $value) {
        $response = $response . $value;
    }
}
echo $response;