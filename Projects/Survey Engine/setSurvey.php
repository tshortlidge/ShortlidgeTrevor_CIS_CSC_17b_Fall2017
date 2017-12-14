<!DOCTYPE html>
<html>
<head>
	<title>Survey Creator</title>
	<script type="text/javascript" src="Question.js" ></script>
    <script type="text/javascript" src="getForm.js"></script>
    <script type="text/javascript" src="cookieFunction.js"></script>


    <?php

    ?>
</head>

<body>
<br><br><br><br>
<h4 id='username'></h4>
<p><button onclick="signin()">Sign In</button><button onclick="signout()">Sign Out</button></p>

<script type="text/javascript">

    function signout(){

        window.location.assign("logout.php");

    }

    function signin(){

        window.location.assign("Access.php");

    }


</script>



<!-- get username from cookies  -->
<script type="text/javascript">

            var x = getCookie("username");
            document.getElementById('username').innerHTML = x + "";


</script>



<h5>Create a Survey</h5>

<!-- <form name="getTitle" method="post" onsubmit="getTitle()">
<p>Please enter your survey title:<input name="Title" type = "text"/></p>
<input value ="Add Title" type="submit" />
</form> -->

<p>Survey Title: <input id="title" type="text" /></p>
<button onclick="getTitle()">Submit title</button>
<p><span id="titlename"></span></p>

 <form action = "setSurvey.php" method ="get">
            <label>Question Number: </label><input name="Number" type="text" pattern="^[0-9]*$" size='50' /><br></br>
            <label>Question:</label><input name="Question" type="text" size='80'/><br></br>
            <label>Answer1:</label><input name="Answer1" type="text" size='80'/><br></br>
            <label>Answer2:</label><input name="Answer2" type="text" size='80'/><br></br>
            <label>Answer3:</label><input name="Answer3" type="text" size='80'/><br></br>
            <label>Answer4:</label><input name="Answer4" type="text" size='80'/><br></br>
            <label>Answer5:</label><input name="Answer5" type="text" size='80'/><br></br>
            <input name="submit" value ="add Question to Survey" type="submit" />
        </form>

<button name="setSurvey" value='Create New Survey' type="button" onclick="setSurvey()">Submit Survey</button>
<p id="error"></p>

<script type="text/javascript">

    //keep survey name shown on the page through stored in the localstorage
	// var test_title = localStorage.getItem("title");
	// if(test_title) {
 //        document.getElementById("titlename").innerHTML = "Survey Name: " + test_title;
	// }
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
            function getTitle() {
            	title = document.getElementById("title").value;
            	localStorage.setItem("title", title);
            	document.getElementById("titlename").innerHTML = "Survey Name: " + title;

            }

			// var title = document.getElementById('title').value;
            var newQuestion = new Question($_GET["Number"], $_GET["Question"], answers);
            length = $_GET["Number"];
            localStorage.setItem(length, JSON.stringify(newQuestion));
            localStorage.setItem("length", length);
            for (var i = 1; i <= length; i++) {
                var temp = localStorage.getItem(i);
                var question = new Question(JSON.parse(temp));
                question.display();
                document.write('<button id="btn'+i+ '"' + 'onclick="deleteFunction(\''  + i + '\')">Delete</button>');
            }

            if(length>0) {
                document.getElementById("titlename").innerHTML = "Survey Name: " + localStorage.getItem("title");
            }


            function deleteFunction(num){
                localStorage.removeItem(num);
//                    document.getElementById("btn"+num).innerHTML = "Already deleted!";
//                    document.getElementById("btn"+num).style.color = "red";

            }


         	// store information in the cookies
            function setSurvey(){

                if(getCookie("username")){
                var newlength = 0;
                for (var i = 1; i <= length; i++) {
                    var string_question = localStorage.getItem(i);
                    if(string_question == null) {
                        continue;
                    } else {
                        newlength++;
                        localStorage.setItem(newlength, string_question);
                    }
                }
                localStorage.setItem("length", newlength);
                length = newlength;
                for (var i = 1; i <= length; i++) {
                    var string_question = localStorage.getItem(i);
                    setCookie("question" + i, string_question, 1);
                }
                var string_title = localStorage.getItem("title");
                setCookie("title",string_title, 1);

              	setCookie("length", length, 1);

                window.location.assign("displaySurvey.php");
            }else{
                document.getElementById("error").innerHTML = "You have to sign in before creating any survey";
            }



            }


 </script>

<a href='viewSurvey.php'>View Surveys</a>
</body>
</html>
