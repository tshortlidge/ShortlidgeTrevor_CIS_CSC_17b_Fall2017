<!DOCTYPE html>
<html>
<head>
	<title>View Your Survey!</title>


<?php

include "sql/connect_mysql.php";
//include "header.html";

if(isset($_COOKIE['username'])){
	$username = $_COOKIE['username'];
	echo '<h3><p>Survey Creator: '.$username.'<br></h3>';}


//select id
$sql = "SELECT id_user FROM users WHERE username = '" . $username . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$id_user = $row['id_user'];

//get the survey title from url
$url = urldecode($_SERVER['REQUEST_URI']);
$title = parse_url($url, PHP_URL_QUERY);

//select id_survey
$sql = "SELECT id_survey FROM survey_entity WHERE title = '" . $title . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$id_survey = $row['id_survey'];


echo "<h3>Survey Title: " . $title.'</h3>';

//select question and answer from the database

$row = array();
$row_ans = "";
$sql = "SELECT question, id_question FROM question_entity WHERE id_survey = '" . $id_survey . "'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc() ){
	echo "<div class='questions' style = 'border: dotted 1px grey'>";
	echo '<form method="POST">';
	echo "<p>Q: ". $row['question']."</p>";

		$sql_ans= "SELECT answer FROM answer_entity WHERE id_question = '" . $row['id_question'] . "'";
		$result_ans = $mysqli->query($sql_ans);
		if ($result_ans->num_rows > 0) {
			while($row_ans = $result_ans->fetch_assoc() ){
			echo '<p><input type ="radio" name="' .$row['id_question'] .'" value="' .$row_ans['answer'].'">'.$row_ans['answer']."</p>";
			}

    		$x = $row['id_question'];
    		$y = $row_ans['answer'];

			if( isset($_POST[$x])){
				$sql = "INSERT INTO result_entity (id_question, answer, id_survey) VALUES ('$x', '$_POST[$x]', '$id_survey')";
    			if ($mysqli->query($sql) === TRUE) {
    				}else{
      				echo 'Error:' . $sql . '<br/>' . $mysqli->error;
    			}

			}

		}

    echo '<form>';
    echo "</div>";

	}
}

echo "<button type='submit'>Submit Survey</button><br>";
echo "<a href='result.php?".$title."'>View Survey Result!</p>";


?>

</head>

<body>
	<br><br>
	<p><button onclick="signout()">Sign Out</button><button onclick="signin()">Sign In</button></p>

<script type="text/javascript">

    function signout(){

        window.location.assign("logout.php");

    }


    function signin(){

        window.location.assign("Access.php");

    }


</body>
</html>
