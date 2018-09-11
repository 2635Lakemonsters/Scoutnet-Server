<html>
<head>
</head>
<body>
<?php
$user = 'root';
$pass = 'root';
$db   = 'scouting_data_2018';
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
//echo 'Success... ' . $link->host_info . "\n";

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


$dataArray = $_POST["DATA"];
$json = (array) json_decode($dataArray, true);
$dataType = $json['DATATYPE'];
$scoutName = $json['SCOUTNAME'];

if ($dataType == "matchData") {

$teamNum = $json['TEAMNUM'];

$matchNum = $json['MATCHNUM'];
$teamScore = $json['TEAMSCORE'];
$defenseRating = $json['DEFENSERATING'];
$autoHighScores = $json['AUTOHIGHSCORES'];
$autoLowScores = $json['AUTOLOWSCORES'];
$doesAuto = $json['DOESAUTO'];
$defenseCrossed = $json['DEFENSECROSSED'];
$linesUp = $json['LINESUP'];
$autoBroke = $json['AUTOBROKE'];

$teleOSwitchScores = $json['TELEOSWITCHSCORES'];
$teleScaleScores = $json['TELESCALESCORES'];
$teleESwitchScores = $json['TELEESWITCHSCORES'];
$malfunction = $json['MALFUNCTION'];
$doesClimb = $json['DOESCLIMB'];
$doesDefend = $json['DOESDEFEND'];
$teleNotes = $json['TELENOTES'];

$specialNotes = $json['SPECIALNOTES'];


$query = "INSERT INTO match_data (Scout_Name, Team_Number, Match_Number, Team_Score, Defense_Rating, Does_Auto, Auto_High_Scores, Auto_Low_Scores, Defense_Crossed, Lines_Up, Auto_Broke, Tele_OSwitch_Scores, Tele_Scale_Scores, Tele_ESwitch_Scores, Malfunction, Does_Climb, Does_Defend, Tele_Notes, Special_Notes)
        VALUES ('$scoutName', '$teamNum', '$matchNum', '$teamScore', '$defenseRating', '$doesAuto', $autoHighScores, $autoLowScores,'$defenseCrossed', '$linesUp', '$autoBroke', '$teleOSwitchScores', '$teleScaleScores', '$teleESwitchScores', '$malfunction', '$doesClimb', '$doesDefend', '$teleNotes', '$specialNotes')";

		
		
		
		
		
} elseif ($dataType == "pitData") {
		


$teamNum = $json['TEAMNUMBER'];
$teamName = $json['TEAMNAME'];
$robotName = $json['ROBOTNAME'];
$numOfWheel = $json['NUMOFWHEELS'];
$locomotion = $json['LOCOMOTION'];
$vision = $json['VISION'];
$visionUse = $json['VISIONUSAGE'];
$driveTrain = $json['DRIVETRAIN'];
$doesAuto = $json['AUTO'];
$autoFor = $json['AUTOUSAGE'];

$canGrab = $json['R1'];
$canLaunch = $json['R2'];
$canBulldoze = $json['R3'];
$canHelpClimb = $json['R4'];

$doesSwitch = $json['S1'];
$doesScale = $json['S2'];
$doesLiftCubes = $json['S3'];
$doesShootCubes = $json['S4'];
$doesVault = $json['S5'];
$doesClimb = $json['S6'];
$defensive = $json['S7'];
$offensive = $json['S8'];

$specialNotes = $json['SPECIALNOTES'];


$query = "INSERT INTO pit_data (Scout_Name, Team_Number, Team_Name, Robot_Name, Number_of_Wheels, Locomotion, Vision, Vision_For, Drive_Train, Do_Auto, Auto_For, Can_Grab, Can_Launch, Can_Bulldoze, Can_Help_Climb, Does_Switch, Does_Scale, Does_Lift_Cubes, Does_Shoot_Cubes, Does_Vault, Does_Climb, Defensive, Offensive, Special_Notes) 
		VALUES ('$scoutName', '$teamNum', '$teamName', '$robotName', '$numOfWheel', '$locomotion', '$vision', '$visionUse', '$driveTrain', '$doesAuto', '$autoFor', '$canGrab', '$canLaunch', '$canBulldoze', '$canHelpClimb', '$doesSwitch', '$doesScale', '$doesLiftCubes', '$doesShootCubes', '$doesVault', '$doesClimb', '$defensive', '$offensive', '$specialNotes')";

		
		
} else {
	echo "faulty data structure - datatype";
}

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