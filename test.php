<html>
<head>
</head>
<body>
<?php

$user = 'root';
$pass = 'root';
$db   = 'scouting_data';
$host = 'localhost';
$port = 3306;
$link = mysqli_init();
if (!$link) {
    die('mysqli_init failed');
}

if (!$link->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
    die('Setting MYSQLI_INIT_COMMAND failed');
}

if (!$link->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
    die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
}

if (!$link->real_connect(
  $host,
  $user,
  $pass,
  $db
)) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

// Quick test
// echo 'Success... ' . $link->host_info . "\n";

$connection = $link->real_connect(
  $host,
  $user,
  $pass,
  $db
);

/**
  * More testing
*/
// echo '$link: '; print_r($link); echo "\n";
// echo '$connection: '; print($connection); echo "\n";
// echo '$connection _r: '; print_r($connection); echo "\n";

if (!$connection) {
  die('Database connection failed.');
}

/**
  * Insert data into table
*/
$name = "billybob";
$query  = "INSERT INTO match_data (Scout_Name, Team_Number) VALUES ('$name', '1234')";

// $result = mysqli_query($connection, $query);
$result = mysqli_query($link, $query);

if (!$result) {
  die('Error: ' . mysqli_error($link));
}

/**
  * Close connection
*/
$link->close();
?>
</body>
</html>