
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $title.' - '.SITETITLE;?></title>
    <?php
    echo $meta;//place to pass data / plugable hook zone
    Assets::css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        Url::templatePath().'css/style.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
        '../Templates/Default/Assets/css/style.css'
    ]);
    echo $css; //place to pass data / plugable hook zone
    ?>
</head>
<body>
<!--<?php echo $afterBody; //place to pass data / plugable hook zone?>-->



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Zajebista</a>
    </div>
    <ul class="nav navbar-nav">
      <?php foreach ($data['menu'] as $value){ 
          echo '<li><a href='.$value['link'].'>'.$value['val'].'</a></li>';
      }?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php 
      if($data['sessionSet']){
        echo "<li><a href=\"/logout\"><span class=\"glyphicon glyphicon-log-in\"></span> $data[fullname]</a></li>";
      }
      else{
        echo '<li><a href="/signup" "><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>';
        echo '<li><a href="/login" "><span class="glyphicon glyphicon-user"></span> Zaloguj się</a></li>';
      } ?>

    </ul>
  </div>
</nav>


<div class="container-fluid">
