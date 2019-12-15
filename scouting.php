<html>
<head>
</head>
<body>
<?php
$user = 'root';
$pass = 'Unicorns2635';
$db   = 'bunnybots_data_2019';
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
echo($dataType);
if ($dataType == "matchData") {

$teamNum = $json['TEAMNUM'];
$matchNum = $json['MATCHNUM'];
$teamScore = $json['TEAMSCORE'];
$defenseRating = $json['DEFENSERATING'];

$SupportsTub = $json['SUPPORTSTUB'];
$autoBunniesSupported = $json['AUTOBUNNIESSUPORTED'];
$doesAuto = $json['DOESAUTO'];
$autoTubsContacted = $json['AUTOTUBSCONTACTED'];

$teleBedCubes = $json['TELEBEDCUBES'];
$doesGive = $json['DOESGIVE'];
$malfunction = $json['MALFUNCTION'];
$teleNotes = $json['TELENOTES'];

$specialNotes = $json['SPECIALNOTES'];





$query = "INSERT INTO match_data (  Scout_Name, Team_Number, Match_Number,   Team_Score,   Defense_Rating,   Does_Auto,  Supports_Tub,  Auto_Tubs_Contacted,  Tele_Bed_Cubes,  Does_Give,    Malfunction,    Tele_Notes,   Special_Notes)
                          VALUES ('$scoutName', '$teamNum' , '$matchNum' , '$teamScore', '$defenseRating', '$doesAuto','$supportsTub', '$autoTubsContacted', '$teleBedCubes', '$doesGive', '$malfunction', '$teleNotes', '$specialNotes')";

		
		
		
		
		
} elseif ($dataType == "pitData") {
		


$teamNum = $json['TEAMNUMBER'];
$teamName = $json['TEAMNAME'];
$numOfWheel = $json['NUMOFWHEELS'];
$locomotion = $json['LOCOMOTION'];
$vision = $json['VISION'];
$visionUse = $json['VISIONUSAGE'];
$driveTrain = $json['DRIVETRAIN'];
$doesAuto = $json['AUTO'];
$autoFor = $json['AUTOUSAGE'];

$canTubs = $json['CANTUBS'];
$canCubes = $json['CANCUBES'];
$canBunnies = $json['CANBUNNIES'];
$canDumb = $json['CANDUMP'];

$doesAutoContactTubs = $json['DOESAUTOCONTACTTUBS'];
$doesAutoSupportTubs = $json['DOESAUTOSUPPORTTUBS'];
$doesAutoSupportBunnies = $json['DOESAUTOSUPPORTBUNNIES'];
$doesGiveCubes = $json['DOESGIVECUBES'];
$doesPutBunnies = $json['DOESPUTBUNNIES'];
$doesRemoveBunnies = $json['DOESREMOVEBUNNIES'];

$generalNotes = $json['GENERALNOTES'];


$query = "INSERT INTO pit_data (  Scout_Name, Team_Number,   Team_Name, Number_of_Wheels,    Locomotion,    Vision,   Vision_For,   Drive_Train,     Do_Auto,   Auto_For,   Can_Tubs,   Can_Cubes,   Can_Bunnies,   Can_Dump, Does_Auto_Contact_Tubs, Does_Auto_Support_Tubs,  Does_Auto_SupportBunnies,  Does_Give_Cubes,  Does_Put_Bunnies,  Does_Remove_Bunnies,   General_Notes) 
		                VALUES (    '$scoutName',  '$teamNum', '$teamName',    '$numOfWheel', '$locomotion', '$vision', '$visionUse', '$driveTrain', '$doesAuto', '$autoFor', '$canTubs', '$canCubes', '$canBunnies', '$canDump', '$doesAutoContactTubs', '$doesAutoSupportTubs', '$doesAutoSupportBunnies', '$doesGiveCubes', '$doesPutBunnies', '$doesRemoveBunnies', '$generalNotes')";

		
		
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