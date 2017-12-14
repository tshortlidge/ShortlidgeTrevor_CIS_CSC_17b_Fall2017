
<!DOCTYPE html>
<html>
<head>
	<title>Displaying the Survey</title>
    <script type="text/javascript" src="cookieFunction.js"></script>


<?php

include "setSrvQstnAnswr.php";

?>


</head>
<body>


	<script type="text/javascript">
		document.getElementById('username').innerHTML = getCookie('username');
	</script>
	<p id='redirect'></p>
	<script>function Redirect(){
            window.location="viewSurvey.php";}
            setTimeout("Redirect()",0);
            </script>

</body>
</html>
