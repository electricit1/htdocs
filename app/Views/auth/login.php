<?php use \helpers\form; ?>

<div class="signin">
<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin'));?>
<h2 class="form-signin-heading">Zaloguj się</h2>
<?php echo Form::input(array('name' => 'username', 'placeholder' => 'Nazwa użytkownika', 'class' => 'form-control', 'style' => 'margin-bottom: 15px;'));?>
<?php echo Form::input(array('type' => 'password', 'name' => 'password', 'placeholder' => 'Hasło', 'class' => 'form-control', 'style' => 'margin-bottom: 15px;'));?>

<?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Zaloguj', 'class' => 'btn btn-lg btn-primary btn-block' ));?>

<?php echo Form::close();?>

</div>
