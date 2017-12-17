<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Survey Results</title>
    </head>


    <?php

    include "sql/connect_mysql.php";

    if(isset($_COOKIE['username'])){
	$username = $_COOKIE['username'];
}


	//get the id from the users table
	$sql = "SELECT id_user FROM users WHERE username = '" . $username . "'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	$id_user = $row['id_user'];

	//get the survey title from url
	$url = urldecode($_SERVER['REQUEST_URI']);
	$title = parse_url($url, PHP_URL_QUERY);

// selects the id of the survey from the survey_entity
	$sql = "SELECT id_survey FROM survey_entity WHERE title = '" . $title . "'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	$id_survey = $row['id_survey'];

	echo '<h1><p>'.$title.'<br></h1>';
  echo '<h5><p>Created by: '.$username.'<br></h5>';

	echo '<p>Survey Results: <br></p>';



	$sql = "SELECT id_question, count(*) FROM result_entity
	WHERE id_survey = $id_survey GROUP BY id_question";



    //display results
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {

		$i = 1;
		while($row = $result->fetch_assoc() ){

            echo "*************<br>";
            echo "Question ".$i.": <br>";
            echo "Answers Selected: <br>";
			$ques = $row['id_question'];
            $sql = "SELECT answer, COUNT(*) FROM result_entity WHERE id_question= $ques GROUP BY answer";
            $result_ans = $mysqli->query($sql);
            if ($result_ans->num_rows > 0) {
				while($row_ans = $result_ans->fetch_assoc() ){
					echo $row_ans['answer'].": ";

					$ans_percent = ($row_ans['COUNT(*)'] / $row['count(*)']) * 100;
					$format = number_format($ans_percent, 0);
					echo $format."% (# of people chosen this answer)<br>";
				}
			}

            echo "*************<br><br>";
            			++$i;

	}
}



    ?>


    </head>

<body>

  <br><br>
	<p><button onclick="signout()">Sign Out</button><button onclick="main_Page()">Main Page</button></p>

<script type="text/javascript">

    function signout(){

        window.location.assign("logout.php");

    }


    function main_Page(){

        window.location.assign("mainPage.html");

    }
    </script>
</body>
</html>
