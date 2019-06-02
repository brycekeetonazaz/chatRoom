<?php
//this could cause issues with large numbers of players, because it is O(n) due to the while loop.
function listPlayersInRoom()
{
	if($thePath = opendir("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomPlayers"))
	{
		while(false !== ($entry = readdir($thePath))) 
		{
			if($entry != "." && $entry != "..")
			{
				$players = fopen("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomPlayers/" . $entry, "r");
				echo fread($players, filesize("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomPlayers/" . $entry)) . "<br>";
				fclose($players);
			}
		}
		closedir($thePath);
	}
}
?>