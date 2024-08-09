<?php

	// Define the paths to the shell scripts
	$createTunnelScript = __DIR__ . '/create_ssh_tunnel.sh';
	$makeExecutableScript = __DIR__ . '/make_executable.sh';

	// Make the create_ssh_tunnel.sh script executable
	exec($makeExecutableScript, $output, $return_var);
	if ($return_var !== 0) {
		// Handle the error
		error_log("Error making the script executable: " . implode("\n", $output));
		exit;
	}

	// Execute the create_ssh_tunnel.sh script
	exec($createTunnelScript, $output, $return_var);
	if ($return_var !== 0) {
		// Handle the error
		error_log("Error establishing SSH tunnel: " . implode("\n", $output));
		exit;
	}

	echo "SSH tunnel established successfully.";
	// Continue with the rest of the initialization if needed

	//$dbHost = 'localhost';
	$dbHost = '127.0.0.1';
	// localhost due to SSH tunnel

	//$dbPort = '22';
	$dbPort = '3306';
	// the local port you specified in the SSH tunnel script

	$dbName = 'detroit';
	$dbUser = 'root';
	$dbPass = 'Rkakfsus97313';
	//$dsn = "mysql:host = $dbHost;dbname = $dbName";
	$dsn = "mysql:host = $dbHost;port = $dbPort;dbname = $dbName";

	/*echo "<br /><br />dbHost: ".$dbHost."<br />";
	echo "dbPort: ".$dbPort."<br />";
	echo "dbName: ".$dbName."<br />";
	echo "dbUser: ".$dbUser."<br />";
	echo "dbPass: ".$dbPass."<br />";
	echo "dsn: ".$dsn."<br /><br />";*/

	/*try {
		$pdo = new PDO($dsn, $dbUser, $dbPass);
		if($pdo) {
			echo "<br />Connected to the $dbName database successfully!";
		}
	} catch(PDOException $e) {
		echo "<br />".$e->getMessage();
	}*/

	$return_array = [];
	$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if($connection->connect_error) {
        die("Connection failed: ".$connection->connect_error);
    } else {
        echo "Connection Made<br /><br />";

		$sql = "SELECT id, first_name, last_name, badge, approved, activated
				FROM users
				WHERE first_name = 'River'";
		$res = $connection->query($sql);
    }

	while ($obj = mysqli_fetch_object($res)) {
		array_push($return_array, $obj);
	}
	echo count($return_array);
	echo "<br/>";
	print_r($return_array);
	echo "<br/>";
	//echo $return_array[0]->id;

	for($i = 0; $i < count($return_array); $i++) {
		echo "id: ".$return_array[$i]->id."<br />";
		echo "First Name: ".$return_array[$i]->first_name."<br />";
		echo "Last Name: ".$return_array[$i]->last_name."<br />";
		echo "badge: ".$return_array[$i]->badge."<br />";
		echo "approved: ".(int) $return_array[$i]->approved."<br />";
		echo "activated: ".(int) $return_array[$i]->activated."<br />";

		if($return_array[$i]->badge == 'DQS99998') {
			echo "That's Professor River Song thank you!";
		}
	}
	
?>