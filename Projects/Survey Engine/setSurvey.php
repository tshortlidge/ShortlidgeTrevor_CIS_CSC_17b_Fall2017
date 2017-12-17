<!DOCTYPE html>
<html>
<head>
	<title>Survey Creator</title>
	<script type="text/javascript" src="Question.js" ></script>
    <script type="text/javascript" src="getForm.js"></script>
    <script type="text/javascript" src="cookieFunction.js"></script>
		<script type ="text/javascript" src="title.js"></script>


    <?php

    ?>
</head>

<body>
<h1>Create a Survey</h1>

<h4 id='username'></h4>

</script>



<!-- get username from cookies  -->
<script type="text/javascript">

            var x = getCookie("username");
            document.getElementById("username").innerHTML = "Welcome, " + x + "!!";

</script>





<button type="button" onclick="inTitle()">Input Title</button>
<form action = "setSurvey.php" method ="get">
            <label>Question Number: </label><input name="Number" type="text" pattern="^[0-9]*$" size='5' /><br></br>
            <label>Question:</label><input name="Question" type="text" size='100'/><br></br>
            <label>Answer1:</label><input name="Answer1" type="text" size='40'/><br></br>
            <label>Answer2:</label><input name="Answer2" type="text" size='40'/><br></br>
            <label>Answer3:</label><input name="Answer3" type="text" size='40'/><br></br>
            <label>Answer4:</label><input name="Answer4" type="text" size='40'/><br></br>
            <label>Answer5:</label><input name="Answer5" type="text" size='40'/><br></br>
            <input name="submit" value ="ADD Question" type="submit" />

</form>

<button name="setSurvey" value='Create New Survey' type="button" onclick="setSurvey()">Submit Survey</button>
<p id="error"></p>

<script type="text/javascript">

    var title = null;


           // get and display user added new questions
            var url = document.location.href;
            $_GET = getForm(url);
            var counter = 0;
            var answers = [];
            for (property in $_GET) {
                var str = $_GET[property]; //Place property value in string
                var dec = decodeURIComponent(str); //Convert to ascii
                var clean = dec.replace(/\++/g, ' '); //Remove + and replace by space
                $_GET[property] = clean; //Cleaned values
                counter++;
                if (counter > 2 && clean !== "")
                    answers.push(clean); //Place answers int their own array
            }

            //get the survey name by input by user
            function inTitle() {

							var getTitle = prompt("Enter Title: ");
							localStorage.setItem("title", getTitle);

            }

            var qstn = new Question($_GET["Number"], $_GET["Question"], answers);
            length = $_GET["Number"];
            localStorage.setItem(length, JSON.stringify(qstn));
            localStorage.setItem("length", length);
            for (var i = 1; i <= length; i++) {
                var temp = localStorage.getItem(i);
                var question = new Question(JSON.parse(temp));
								question.display();
            }

            if(length>0) {
                document.getElementById("titlename").innerHTML = "Survey Name: " + localStorage.getItem("title");
            }



         	// stores information in the cookies
            function setSurvey(){

                if(getCookie("username")){
                var newlength = 0;
                for (var i = 1; i <= length; i++) {
                    var qstnString = localStorage.getItem(i);
                    if(qstnString == null) {
                        continue;
                    } else {
                        newlength++;
                        localStorage.setItem(newlength, qstnString);
                    }
                }
                localStorage.setItem("length", newlength);
                length = newlength;
                for (var i = 1; i <= length; i++) {
                    var qstnString = localStorage.getItem(i);
                    setCookie("question" + i, qstnString, 1);
                }
                var titString = localStorage.getItem("title");
                setCookie("title",titString, 1);

              	setCookie("length", length, 1);

                window.location.assign("viewSurvey.php");
            }else{
                document.getElementById("error").innerHTML = "You have to sign in before creating any survey";
								window.location.assign("login.php");

            }



            }


 </script>


</body>
</html>
