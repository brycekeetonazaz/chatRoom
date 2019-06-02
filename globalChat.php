<?php
function globalChat($message)
{
	$globalConsole = fopen("commandOutput/globalConsole.txt", "r+");
	fwrite($globalConsole, $_SESSION['name'] . " (GLOBAL): " . $message . " <br>");
	fclose($globalConsole);
	parseConsole();
}

?>