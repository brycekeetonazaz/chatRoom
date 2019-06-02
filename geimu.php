<?php
	session_start();
?>

<html>
<head title = "jef">
<style>
	a:link {
		color:blue;
	}
	a:visited {
		color:blue;
	}
	a:active {
		color:purple;
	}
</style>
</head>

<body>
	<div name="writeName">
		<form name = "submitName" action="" method="post">
			What is your name? <input type="text" name="nameInput">
			<input type="submit" value="Choose Name">
		</form>
	</div>
		
	<?php
		include "nameSet.php";
		include "parseConsole.php";
		include "dissectCommand.php";
	?>
	
	<div name="showName">
	Name: <?php echo $_SESSION['name']; ?>
	</div>
	<form name="logout" action="" method="post"> 
		<input type="submit" value="Log Out" name="leave">
	</form>
	<div name="showCoords">
	Coords: (<?php echo $_SESSION['pX'] . ", " . $_SESSION['pY'] . ", " . $_SESSION['pZ']; ?>)
	</div>
	<br>
	<br>Console:
	<br>
	<?php echo $_SESSION['console']; ?>
	<br>
	<br>___________
	<br>Type a command:
	<br><form action="" method="post">
			What is your quest? <input type="text" name="commandInput">
			<input type="submit" value="Submit Command">
		</form>
	<br>
	<br>Commands:
	<br>move &lt;north, south, east, west, up, down&gt; (move a new room)
	<br>yell &lt;message&gt; (talk in global chat)
	<br>say &lt;message&gt; (talk in local chat)
	<br>tell &lt;player&gt; &lt;message&gt; (direct message someone)
	<br>
	<br>Players in current room:
	<br>
	<?php 
		include "listPlayersInRoom.php";
		listPlayersInRoom();
	?>
</body>
</html>



















