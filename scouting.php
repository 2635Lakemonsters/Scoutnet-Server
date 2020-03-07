<html>
<head>
</head>
<body>
<?php
$user = 'root';
$pass = 'Unicorns2635';
$db   = 'wilsonville_data_2020';
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


if($dataType) {
  echo " succ";
}

if ($dataType == "matchData") {
echo " Match Data";
$teamNum = $json['TEAMNUM'];
$matchNum = $json['MATCHNUM'];
$teamScore = $json['TEAMSCORE'];
$defenseRating = $json['DEFENSERATING'];

$crossesLine = $json['CROSSESLINE'];
$collectsCells = $json['COLLECTSCELLS'];
$doesAuto = $json['DOESAUTO'];
$shootsCells = $json['SHOOTSCELLS'];
$autoUpperCells = $json['AUTOUPPERCELLS'];
$autoLowerCells = $json['AUTOLOWERCELLS'];

$teleUpperCells = $json['TELEUPPERCELLS'];
$teleLowerCells = $json['TELELOWERCELLS'];
$malfunction = $json['MALFUNCTION'];
$usesPanel = $json['USESPANEL'];

$teleNotes = $json['TELENOTES'];

$specialNotes = $json['SPECIALNOTES'];
$endgame = $json['ENDGAME'];
$isLevel = $json['ISLEVEL'];

$query = "INSERT INTO match_data (  Scout_Name, Team_Number, Match_Number,   Team_Score,   Defense_Rating,   Does_Auto,  Crosses_Line,  Collects_Cells,   Shoots_Cells,  Auto_Upper_Cells,  Auto_Lower_Cells,  Tele_Upper_Cells,  Tele_Lower_cells,    Malfunction,   Uses_Panel,   Tele_Notes,   Special_Notes,    Endgame,   Is_Level)
                          VALUES ('$scoutName', '$teamNum' , '$matchNum' , '$teamScore', '$defenseRating', '$doesAuto','$crossesLine', '$collectCells', '$shootsCells', '$autoUpperCells', '$autoLowerCells', '$teleUpperCells', '$teleLowerCells', '$malfunction', '$usesPanel', '$teleNotes', '$specialNotes', '$endgame', '$isLevel')";

		
		
		
		
		
} elseif ($dataType == "pitData") {
echo " Pit Data";
		


$teamNum = $json['TEAMNUMBER'];
$teamName = $json['TEAMNAME'];
$numOfWheel = $json['NUMOFWHEELS'];
$locomotion = $json['LOCOMOTION'];
$vision = $json['VISION'];
$visionUse = $json['VISIONUSAGE'];
$driveTrain = $json['DRIVETRAIN'];
$doesAuto = $json['AUTO'];
$autoFor = $json['AUTOUSAGE'];

$canShootHigh = $json['CANSHOOTHIGH'];
$canShootLow = $json['CANSHOOTLOW'];
$canControlPanel = $json['CANCONTROLPANEL'];
$canCollectGround = $json['CANCOLLECTGROUND'];
$canCollectLoading = $json['CANCOLLECTLOADING'];
$canClimb = $json['CANCLIMB']

$doesAutomaticAim = $json['DOESAUTOMATICAIM'];
$doesAutoShoot = $json['DOESAUTOSHOOT'];
$doesAutoPickup = $json['DOESAUTOPICKUP'];
$doesShootFromOpposite = $json['DOESSHOOTFROMOPPOSITE'];

$generalNotes = $json['GENERALNOTES'];


$query = "INSERT INTO pit_data (  Scout_Name, Team_Number,   Team_Name, Number_Of_Wheels,    Locomotion,    Vision,   Vision_For,   Drive_Train,   Does_Auto,   Auto_For,   Can_Shoot_High,  Can_Shoot_Low,  Can_Control_Panel,  Can_Collect_Ground,  Can_Collect_Loading,  Can_Climb,   Does_Automatic_Aim,  Does_Auto_Shoot, Does_Shoot_From_Opposite,   General_Notes) 
		                VALUES (    '$scoutName',  '$teamNum', '$teamName',    '$numOfWheel', '$locomotion', '$vision', '$visionUse', '$driveTrain', '$doesAuto', '$autoFor', ' $canShootHigh', '$canShootLow', '$canControlPanel', '$canCollectGround',' $canCollectLoading', '$canClimb', '$doesAutomaticAim', '$doesAutoShoot', '$doesShootFromOpposite', '$generalNotes')";

		
		
} else {
	echo " faulty data structure - datatype";
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