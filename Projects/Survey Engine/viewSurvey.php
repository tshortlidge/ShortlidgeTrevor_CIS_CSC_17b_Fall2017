<!DOCTYPE html>
<html>
<head>
	<title>Direct to Your Survey!</title>
    <script type="text/javascript" src="cookieFunction.js"></script>


<?php

include "sql/connect_mysql.php";
include "setSrvQstnAnswr.php";


if(isset($_COOKIE['username'])){
	$username = $_COOKIE['username'];
	echo '<p>Survey Author: '.$username.'<br>';
}

$sql = "SELECT id_user FROM users WHERE username = '" . $username . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$id_user = $row['id_user'];



$sql = "SELECT title,id_survey
FROM survey_entity
WHERE id_user = '".$id_user."'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	echo "<br> List of Surveys: <br>";
	while($row = $result->fetch_assoc() ){
	echo "<a href='survey.php?".$row['title']."'>".$row['title']. "</p>";

	}
}

?>

</head>
<body>

</body>
</html>
