<?php

  include "sql/connect_mysql.php";


    if(isset($_COOKIE['username']) && isset($_COOKIE['title'])){

        // get the id from users
      $username = $_COOKIE['username'];
      $sql = "SELECT id_user, username, email, password FROM users WHERE username = '" . $username . "'";
      $result = $mysqli->query($sql);
      $row = $result->fetch_assoc();
      $id_user = $row['id_user'];            // get id throungh the cookies[username]

    //insert data into survey entity
    $title = mysqli_real_escape_string($mysqli, $_COOKIE['title']);
    $sql = "INSERT INTO survey_entity (title, id_user) VALUES ('$title', '$id_user')";

    if ($mysqli->query($sql) === TRUE) {

    }else{
      echo 'Error:' . $sql . '<br/>' . $mysqli->error;
    }


    $sql = "SELECT id_survey, title, id_user FROM survey_entity WHERE title = '" . $title . "'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $id_survey = $row['id_survey'];


    if(isset($_COOKIE['length'])){
      $length = $_COOKIE['length'];
      for($i=1; $i <= $length; $i++) {

        if(isset($_COOKIE['question'.$i])){

          // get the user questions through cookies
          $questions = $_COOKIE['question'.$i];
          $qstn_array = json_decode($questions, true);
          $question = $qstn_array['qstn'];

                //insert into the question_entity table
          $sql = "INSERT INTO question_entity (question, id_survey, id_user) VALUES ('$question', '$id_survey', '$id_user')";
          if ($mysqli->query($sql) === TRUE) {

          }else{
              echo 'Error:' . $sql . '<br/>' . $mysqli->error;
          }

        //insert into the answer_entity table
        $sql = "SELECT id_question FROM question_entity WHERE question = '" . $question . "'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $id_question = $row['id_question'];

        $answers_length = count($qstn_array['ans']);
          for($j=0; $j < $answers_length; $j++){
              $answer = $qstn_array['ans'][$j];
              $choice = 0;
              $sql = "INSERT INTO answer_entity (answer,choice, id_question, id_survey, id_user) VALUES ('$answer', '$choice', '$id_question',
              '$id_survey', '$id_user')";
              if ($mysqli->query($sql) === TRUE) {

                }else{
                echo 'Error:' . $sql . '<br/>' . $mysqli->error;
              }
            }
          }
      }
    }

}

?>
