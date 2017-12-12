<html>
    <head>
              <script type="text/javascript" src="Cookie.js"></script>
              <script type="text/javascript" src="getSite.js"></script>
        <meta charset="UTF-8">
        <title>Your Receipt</title>
    </head>
    <body>
      <h1>Receipt</h1>
        <?php
            //echo "Gotta Read the cookie </br>";
            $text=$_COOKIE["object"];
          // echo $text."</br>";
            $myObj = json_decode($text);
          //  echo '<pre>' . var_export($myObj, true) . '</pre>';







        ?>
        <script>

        listCart();


        </script>
        <br></br>
        <button onclick="window.location.assign('logout.php')">Log out</button>
        <button onclick="window.location.assign('getSite.html')">Main Page</button>
    </body>
</html>
