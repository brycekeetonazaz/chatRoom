<?php

//turn command into array, first element is command, second element is recipient of action or message, third element is message if needed
$a = array("", "", "");
if(isset($_POST['commandInput']))
{
	$j = 0;
	for($i = 0; $i < strlen($_POST['commandInput']); $i ++)
	{
		if(substr($_POST['commandInput'], $i, 1) == " " && $j < 3)
			$j ++;
		else if($j >= 3)
		{
			$a[2] .= " " . substr($_POST['commandInput'], $i);
			break;
		}
		else
			$a[$j] .= substr($_POST['commandInput'], $i, 1);
	}
	//echo $a[0] . ", " . $a[1] . ", " . $a[2];
	
	//call the function for the command
	switch($a[0])
	{
		case "move":
			moveRoom($a[1]);
			break;
		case "yell":
			globalChat($a[1] . " " . $a[2]);
			break;
		case "say":
			roomChat($a[1] . " " . $a[2]);
			break;
		case "tell":
			playerChat($a[1], $a[2]);
			break;
		default:
			$_SESSION['cMessages'] = "Not a valid command <br>";
			parseConsole();
	}
}

?>