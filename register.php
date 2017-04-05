<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style/styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Melomania</title>
  </head>
  <body>
    <?php include_once ('cabecera.php');?>

    <?php
    include_once('configDB.php');
      $con = mysqli_connect(HOST, USER, PASS, DB);
      mysqli_close($con);
      ?>

    <div class="wrapper">
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Register</h2>
        <input id="first" type="text" class="form-control" name="name" placeholder="Name" required="true" autofocus="" />
        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="true" />
        <input type="text" class="form-control" name="email" placeholder="Email" required="true" />
        <input id="last" type="password" class="form-control" name="password" placeholder="Password" required="true"/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
    </div>
  </body>
</html>
