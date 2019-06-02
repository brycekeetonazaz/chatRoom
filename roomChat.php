<?php
function roomChat($message)
{
	$roomConsole = fopen("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomConsole.txt", "w");
	fwrite($roomConsole, $_SESSION['name'] . " (ROOM): " . $message . " <br>");
	fclose($roomConsole);
	parseConsole();
}
?>