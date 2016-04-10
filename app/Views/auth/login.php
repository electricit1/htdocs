<?php 
use \helpers\form,
	\core\error; ?>
<style>
.wrapper {    
	margin-top: 80px;
	margin-bottom: 20px;
}

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-signin-heading {
  text-align:center;
  margin-bottom: 30px;
}
</style>
<?php echo Error::display($error); ?>

<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin'));?>
<h2 class="form-signin-heading">Zaloguj się</h2>
<?php echo Form::input(array('name' => 'username', 'placeholder' => 'Nazwa użytkownika', 'class' => 'form-control', 'style' => 'margin-bottom: 15px;'));?>
<?php echo Form::input(array('type' => 'password', 'name' => 'password', 'placeholder' => 'Hasło', 'class' => 'form-control', 'style' => 'margin-bottom: 15px;'));?>

<?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Zaloguj', 'class' => 'btn btn-lg btn-primary btn-block' ));?>

<?php echo Form::close();?>


