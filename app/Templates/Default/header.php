
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $title.' - '.SITETITLE;?></title>
    <?php
    echo $meta;//place to pass data / plugable hook zone
    Assets::css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        //Url::templatePath().'css/style.css'
        STYLE.'style.css' 
        // pierdole, teraz wszystko na stalych zmiennych i na sztywno,a nie ja sie pierdole 2h czemu nie mam jebanego szareego tla >.>
        // bo ktos zostawil dwie kropki ..
    ]);
    echo $css; //place to pass data / plugable hook zone
    ?> 
</head>
<body>
<!--<?php echo $afterBody; //place to pass data / plugable hook zone?>-->


<div class="container-fluid" >
  <div class="row">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Rozwiń menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Zajebista</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php foreach ($data['menu'] as $value){ 
            echo '<li><a href='.$value['link'].'>'.$value['val'].'</a></li>';
        }?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php 
        if($data['sessionSet']){
          echo "<li><a href='/user/edit/$data[userID]'><span class=\"glyphicon glyphicon-user\"></span> $data[fullname]</a></li>";
          echo "<li><a href=\"/logout\"><span class=\"glyphicon glyphicon-log-out\"></span> Wyloguj się </a></li>";
        }
        else{
          echo '<li><a href="/signup" "><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>';
          echo '<li><a href="/login" "><span class="glyphicon glyphicon-log-in"></span> Zaloguj się</a></li>';
        } ?>
      </ul>
    </div>
  </div>
</nav>
</div>

<div class="row" style="padding:10px;">
  <?php if($data['error'] != '') echo \core\Error::display($data['error']); ?>




