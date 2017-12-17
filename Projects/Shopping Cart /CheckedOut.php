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
      include ('sql/connect_mysql.php');
      //$_COOKIE['balance'] = 2000;



      //echo "HELLO";
      if(isset($_COOKIE['username']) && isset($_COOKIE['amountspent']))
      {

      $username = $_COOKIE['username'];
      $amountspent = $_COOKIE['amountspent'];



      $result = $mysqli->query("SELECT * FROM users WHERE username='$username'");
      $sql = "UPDATE users SET amountspent = '" . $amountspent . " 'WHERE username = '" . $username . "'";

      if ($mysqli->query($sql) === TRUE ){

      }
      else {
      echo "Error loading spent money in database. " . $mysqli->error;

      }



      }
      //echo "HELLOMOTO";

       ?>
        <script>

        listCart();


        </script>
        <br></br>
        <button onclick="window.location.assign('logout.php')">Log out</button>
        <button onclick="window.location.assign('getSite.html')">Main Page</button>
    </body>
</html>
