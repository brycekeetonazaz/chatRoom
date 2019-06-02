<?php
function playerChat($player, $message)
{
	if(file_exists("names/" . $player . "/playerChat.txt"))
	{
		$playerConsole = fopen("names/" . $player . "/playerChat.txt", "r+");
		fwrite($playerConsole, $_SESSION['name'] . " (DIRECT MESSAGE FROM " . $_SESSION['name'] . "): " . $message . " <br>");
		fclose($playerConsole);
		$playerConsole = fopen("names/" . $_SESSION['name'] . "/playerChat.txt", "r+");
		fwrite($playerConsole, $_SESSION['name'] . " (DIRECT MESSAGE TO " . $player . "): " . $message . " <br>");
		fclose($playerConsole);
		parseConsole();
	}
	else
	{
		$_SESSION['cMessages'] = "Player does not exist. <br>";
		parseConsole();
	}
}
?>