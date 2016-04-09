<?php use \helpers\form; ?>

<h1>Logowanie</h1>

<?php echo Form::open(array('method' => 'post'));?>

<p>Nazwa użytkownika: <?php echo Form::input(array('name' => 'username', 'placeholder' => 'Użytkownik'));?></p>

<p>Hasło: <?php echo Form::input(array('type' => 'password', 'name' => 'password', 'placeholder' => 'Hasło'));?></p>

<p><?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Zaloguj' ));?></p>

<?php echo Form::close();?>