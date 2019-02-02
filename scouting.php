<html>
<head>
</head>
<body>
<?php
$user = 'root';
$pass = 'password';
$db   = 'bunnybots_data_2018';
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
$autoCargoDelivered = $json['AUTOCARGODELIVERED'];
$autoPanelsAttached = $json['AUTOPANELSATTACHED'];
$doesAuto = $json['DOESAUTO'];
$centerCrossed = $json['CENTERCROSSED'];
$autoBroke = $json['AUTOBROKE'];

$teleCargoDelivered = $json['TELECARGODELIVERED'];
$telePanelsAttached = $json['TELEPANELSATTACHED'];
$malfunction = $json['MALFUNCTION'];
$doesDefend = $json['DOESDEFEND'];
$teleNotes = $json['TELENOTES'];

$specialNotes = $json['SPECIALNOTES'];
$climbLevel = $json['CLIMBLEVEL'];
$helpsOthers = $json['HELPSOTHERS'];




$query = "INSERT INTO match_data (  Scout_Name, Team_Number, Match_Number,   Team_Score,   Defense_Rating,   Does_Auto, Auto_Cargo_Delivered, Auto_Panels_Attached ,  Center_Crossed,   Auto_Broke,  Tele_Cargo_Delivered,  Tele_Panels_Attached,    Malfunction,   Does_Defend,   Tele_Notes,   Special_Notes,   Climb_Level,   Helps_Others)
                          VALUES ('$scoutName', '$teamNum' , '$matchNum' , '$teamScore', '$defenseRating', '$doesAuto','$autoCargoDelivered', '$autoPanelsAttached','$centerCrossed', '$autoBroke', '$teleCargoDelivered', '$telePanelsAttached', '$malfunction', '$doesDefend', '$teleNotes', '$specialNotes', '$climbLevel', '$helpsOthers')";

		
		
		
		
		
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

$canCollect = $json['CANCOLLECT'];
$canFill = $json['CANFILL'];
$canBunny = $json['CANBUNNY'];
$canSort = $json['CANSORT'];

$doesMove = $json['DOESMOVE'];
$doesBunny = $json['DOESBUNNY'];
$doesAutoFill = $json['DOESAUTOFILL'];
$doesRemove = $json['DOESREMOVE'];
$doesDefensive = $json['DOESDEFENSIVE'];
$doesOffensive = $json['DOESOFFENSIVE'];

$generalNotes = $json['GENERALNOTES'];


$query = "INSERT INTO pit_data (  Scout_Name, Team_Number,   Team_Name,   Robot_Name, Number_of_Wheels,    Locomotion,    Vision,   Vision_For,   Drive_Train,     Do_Auto,   Auto_For,   Can_Collect,   Can_Fill,   Can_Bunny,   Can_Sort,   Does_Move,   Does_Bunny,  Does_Auto_Fill,   Does_Remove,   Does_Defensive,   Does_Offensive,   General_Notes) 
		                VALUES ('$scoutName',  '$teamNum', '$teamName', '$robotName',    '$numOfWheel', '$locomotion', '$vision', '$visionUse', '$driveTrain', '$doesAuto', '$autoFor', '$canCollect', '$canFill', '$canBunny', '$canSort', '$doesMove', '$doesBunny', '$doesAutoFill', '$doesRemove', '$doesDefensive', '$doesOffensive', '$generalNotes')";

		
		
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