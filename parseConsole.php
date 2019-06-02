<?php
$_SESSION['console'] = "";
function parseConsole()
{
	echo $_SESSION['console'];
	$globalConsole = fopen("commandOutput/globalConsole.txt", "r");
	$roomConsole = fopen("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomConsole.txt", "r");
	$playerConsole = fopen("names/" . $_SESSION['name'] . "/playerChat.txt", "r");
	if(isset($_SESSION['cMessages']))
		$_SESSION['console'] .= $_SESSION['console'] . $_SESSION['cMessages'] . fread($playerConsole, filesize("names/" . $_SESSION['name'] . "/playerChat.txt")) . fread($globalConsole, filesize("commandOutput/globalConsole.txt")) . fread($roomConsole, filesize("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomConsole.txt"));
	else
		$_SESSION['console'] .= $_SESSION['console'] . fread($globalConsole, filesize("commandOutput/globalConsole.txt")) . fread($roomConsole, filesize("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomConsole.txt"));
	fclose($globalConsole);
	fclose($roomConsole);
	
	$globalConsole = fopen("commandOutput/globalConsole.txt", "w");
	$roomConsole = fopen("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomConsole.txt", "w");
	$playerConsole = fopen("names/" . $_SESSION['name'] . "/playerChat.txt", "r");
	fwrite($globalConsole, " ");
	fwrite($roomConsole, " ");
	fwrite($playerConsole, " ");
	fclose($globalConsole);
	fclose($roomConsole);
	fclose($playerConsole);
	$_SESSION['cMessages'] = "";
}
?>