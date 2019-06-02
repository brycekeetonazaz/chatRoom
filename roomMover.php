<?php
include "map.php";

//function to move from one room to the next
function moveRoomHelper($targetX, $targetY, $targetZ)
{
	if(!file_exists("map/" . $targetX . $targetY . $targetZ . "/" . $targetX . $targetY . $targetZ . ".txt"))
	{
		mkdir("map/" . $targetX . $targetY . $targetZ);
		$targetRoom = fopen("map/" . $targetX . $targetY . $targetZ . "/" . $targetX . $targetY . $targetZ . ".txt", "w");
		if(rand(0, 10) > 4)
		{
			fwrite($targetRoom, "T");
			$roomConsole = fopen("map/" . $targetX . $targetY . $targetZ . "/roomConsole.txt", "w");
			fwrite($roomConsole, " ");
			fclose($roomConsole);
			mkdir("map/" . $targetX . $targetY . $targetZ . "/roomPlayers");
		}
		else
			fwrite($targetRoom, "S");
		fclose($targetRoom);
	}
	$targetRoom = fopen("map/" . $targetX . $targetY . $targetZ . "/" . $targetX . $targetY . $targetZ . ".txt", "r");
	if(fread($targetRoom, filesize("map/" . $targetX . $targetY . $targetZ . "/" . $targetX . $targetY . $targetZ . ".txt")) == "T")
	{
		fclose($targetRoom);
		return true;
	}
	else
	{
		fclose($targetRoom);
		return false;
	}
}
function addToPlayerList($targetX, $targetY, $targetZ)
{
	$roomPlayers = fopen("map/" . $targetX . $targetY . $targetZ . "/roomPlayers/" . $_SESSION['name'] . ".txt", "a");
	fwrite($roomPlayers, $_SESSION['name'] . PHP_EOL);
	fclose($roomPlayers);
}
function removeFromPlayerList($targetX, $targetY, $targetZ)
{
	unlink("map/" . $targetX . $targetY . $targetZ . "/roomPlayers/" . $_SESSION['name'] . ".txt");
}
function moveRoom($direction)
{
	//increment direction
	switch($direction){
		case "north":
			if(moveRoomHelper($_SESSION['pX'], $_SESSION['pY']+1, $_SESSION['pZ']) != false)
			{
				addToPlayerList($_SESSION['pX'], $_SESSION['pY']+1, $_SESSION['pZ']);
				removeFromPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']);
				$_SESSION['pY'] ++;
				$_SESSION['cMessages'] = "Transparent room. You move to " . $direction . " one room. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ") <br>";
				parseConsole();
			}
			else
			{
				$_SESSION['cMessages'] = "The room you are trying to go to is solid. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
				parseConsole();
			}
			break;
		case "south":
			if(moveRoomHelper($_SESSION['pX'], $_SESSION['pY']-1, $_SESSION['pZ']) != false)
			{
				addToPlayerList($_SESSION['pX'], $_SESSION['pY']-1, $_SESSION['pZ']);
				removeFromPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']);
				$_SESSION['pY'] --;
				$_SESSION['cMessages'] = "Transparent room. You move to " . $direction . " one room. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ") <br>";
				parseConsole();
			}
			else
			{
				$_SESSION['cMessages'] = "The room you are trying to go to is solid. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
				parseConsole();
			}
			break;
		case "east":
			if(moveRoomHelper($_SESSION['pX']+1, $_SESSION['pY'], $_SESSION['pZ']) != false)
			{
				addToPlayerList($_SESSION['pX']+1, $_SESSION['pY'], $_SESSION['pZ']);
				removeFromPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']);
				$_SESSION['pX'] ++;
				$_SESSION['cMessages'] = "Transparent room. You move to " . $direction . " one room. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ") <br>";
				parseConsole();
			}
			else
			{
				$_SESSION['cMessages'] = "The room you are trying to go to is solid. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
				parseConsole();
			}
			break;
		case "west":
			if(moveRoomHelper($_SESSION['pX']-1, $_SESSION['pY'], $_SESSION['pZ']) != false)
			{
				addToPlayerList($_SESSION['pX']-1, $_SESSION['pY'], $_SESSION['pZ']);
				removeFromPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']);
				$_SESSION['pX'] --;
				$_SESSION['cMessages'] = "Transparent room. You move to " . $direction . " one room. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ") <br>";
				parseConsole();
			}
			else
			{
				$_SESSION['cMessages'] = "The room you are trying to go to is solid. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
				parseConsole();
			}
			break;
		case "up":
			if(moveRoomHelper($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']+1) != false)
			{
				addToPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']+1);
				removeFromPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']);
				$_SESSION['pZ'] ++;
				$_SESSION['cMessages'] = "Transparent room. You move to " . $direction . " one room. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ") <br>";
				parseConsole();
			}
			else
			{
				$_SESSION['cMessages'] = "The room you are trying to go to is solid. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
				parseConsole();
			}
			break;
		case "down":
			if(moveRoomHelper($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']-1) != false)
			{
				addToPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']-1);
				removeFromPlayerList($_SESSION['pX'], $_SESSION['pY'], $_SESSION['pZ']);
				$_SESSION['pZ'] --;
				$_SESSION['cMessages'] = "Transparent room. You move to " . $direction . " one room. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ") <br>";
				parseConsole();
			}
			else
			{
				$_SESSION['cMessages'] = "The room you are trying to go to is solid. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
				parseConsole();
			}
			break;
		default:
			$_SESSION['cMessages'] = "That is not a valid direction. Your coords: (" . $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ'] . ")<br>";
			parseConsole();
	}
}
?>