<?php
	//check if the player has chosen a name
	if(!isset($_POST['nameInput']) && !isset($_SESSION['name']))
	{
		echo "please choose a name before starting";
		exit();
	}
	
	//first time setup
	if(isset($_POST['nameInput']))
	{
		//set session variables
		$_SESSION['name'] = $_POST['nameInput'];
		$_SESSION['pX'] = 0;
		$_SESSION['pY'] = 0;
		$_SESSION['pZ'] = 0;
		
		//make appropriate files
		mkdir("names/" . $_SESSION['name']);
		$name = fopen("names/" . $_SESSION['name'] . "/" . $_SESSION['name'] . ".php", "w"); 
		fwrite($name, "<?php \$x=\$_SESSION['pX']; \$y=\$_SESSION['pY']; \$z=\$_SESSION['pZ']; ?>");
		fclose($name);
		$playerConsole = fopen("names/" . $_SESSION['name'] . "/playerChat.txt", "w"); //for player direct messages
		fwrite($playerConsole, " ");
		fclose($playerConsole);
		$roomPlayers = fopen("map/" . 0 . 0 . 0 . "/roomPlayers/" . $_SESSION['name'] . ".txt", "a");
		fwrite($roomPlayers, $_SESSION['name'] . PHP_EOL);
		fclose($roomPlayers);
	}
	
	//get rid of associated data for player and leave
	if(isset($_POST['leave']))
	{
		//remove files
		unlink("map/" . $_SESSION['pX'] . $_SESSION['pY'] . $_SESSION['pZ'] . "/roomPlayers/" . $_SESSION['name'] . ".txt");
		$nameFile = "names/" . $_SESSION['name'] . "/" . $_SESSION['name'] . ".php";
		unlink($nameFile);
		unlink("names/" . $_SESSION['name'] . "/playerChat.txt");
		rmdir("names/" . $_SESSION['name']);
		//end session
		session_unset();
		session_destroy();
		header("Refresh:0");
		exit();
	}
	
	//include important functions
	include "roomMover.php";
	include "globalChat.php";
	include "roomChat.php";
	include "playerChat.php";
?>