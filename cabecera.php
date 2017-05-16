<?php
  require_once("modelo/mensajeDAO.php");
  $menDAO = new mensajeDAO();
 ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Melomania</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Inicio</a></li>
      <li><a href="./mensajes.php">Mensajes</a></li>
      <li><a href="./md.php">MD <span class="badge"><?php echo $menDAO->getCountNoReadMessages(); ?></span></a></li>
      <li><a href="./grupos.php">Grupos</a></li>
      <?php
      if(isset($_SESSION["type"]) && $_SESSION["type"] == "admin"){ ?>
        <li><a href="./grupos.php">Admin</a></li> <?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if(isset($_SESSION["login"])){
      ?>
        <li><a ><spam class="glyphicon glyphicon-user"></spam> <?php echo $_SESSION["name"];?></a></li>
        <li><a href="logout.php"><spam class="glyphicon glyphicon-log-out"></spam> Log out</a></li>
      <?php
      }else{
      ?>
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <?php
      }
      ?>
    </ul>
  </div>
</nav>
