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

	$dbHost = 'localhost';
	//$dbHost = '127.0.0.1';
	// localhost due to SSH tunnel

	//$dbPort = '';
	$dbPort = '3306';
	// the local port you specified in the SSH tunnel script

	$dbName = 'detroit';
	$dbUser = 'root';
	$dbPass = 'Rkakfsus97313';
	//$dsn = "mysql:host = $dbHost;dbname = $dbName";
	$dsn = "mysql:host = $dbHost;port = $dbPort;dbname = $dbName";

	echo "<br /><br />dbHost: ".$dbHost."<br />";
	echo "dbPort: ".$dbPort."<br />";
	echo "dbName: ".$dbName."<br />";
	echo "dbUser: ".$dbUser."<br />";
	echo "dbPass: ".$dbPass."<br />";
	echo "dsn: ".$dsn."<br /><br />";

	try {
		$pdo = new PDO($dsn, $dbUser, $dbPass);
		if($pdo) {
			echo "<br />Connected to the $dbName database successfully!";
		}
	} catch(PDOException $e) {
		echo "<br />".$e->getMessage();
	}

	/*$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    } else {
        echo "Connection Made";
    }*/
	
?>