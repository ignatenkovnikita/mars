<!doctype html>
	<html>
<head>

</head>
<body>

	<h1>Rover Command Test</h1>
	<p>Example:</p>
	<p>
		<pre>
5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
	</pre>
	</p>
	<form method="post" action="index.php">
		<label for="command">Enter command lines here</label><br />
		<textarea name="command" rows="13" cols="30" id="command"><?= !empty($_POST['command']) ? $_POST['command'] : '';?></textarea><br />
		<input type="submit" value="Send commands" />
	</form>


	<h1>Output</h1>

<?php

require_once('vendor/autoload.php');
use Rover\RoverApp;

if (!empty($_POST['command'])) {

	try {
		$app = new RoverApp($_POST['command']);
		$result =  $app->processBatchCommand();

		echo '<pre style="font-weight: bold; font-size: 14px;">';
		echo $result;
		echo '</pre>';

	} catch (Exception $exc) {
		echo '<p style="color: red;">'.$exc->getMessage().'</p>';
	}

}

?>
</body>
</html>