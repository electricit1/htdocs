<?php 
use \helpers\form,
	\core\error; ?>
<style>

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-heading {
  text-align:center;
  margin-bottom: 30px;
}
.input-group{
	margin-bottom: 15px;
}
</style>
<?php echo Error::display($error); ?>

<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin'));?>
<h2 class="form-heading">Edycja</h2>
<div class="input-group">
	<span class="input-group-addon">Imię</span>
	<?php echo Form::input(array('name' => 'imie', 'placeholder' => 'Imię', 'class' => 'form-control','required' => true, 'value' => $data['user']->imie));?>
</div>
<div class="input-group">
	<span class="input-group-addon">Nazwisko</span>
	<?php echo Form::input(array('name' =>'nazwisko', 'placeholder' => 'Nazwisko', 'class' => 'form-control','required' => true, 'value' => $data['user']->nazwisko));?>
</div>
<div class="input-group">
	<span class="input-group-addon">Login</span>
	<?php echo Form::input(array('name' => 'login', 'placeholder' => 'Login', 'class' => 'form-control','required' => true, 'value' => $data['user']->login));?>
</div>
<div class="input-group">
	<span class="input-group-addon">E-mail</span>
	<?php echo Form::input(array('name' => 'email', 'type' => 'email', 'placeholder' => 'email', 'class' => 'form-control', 'required' => true, 'value' => $data['user']->email));?>
</div>
<?php if(isset($data['roles'])){
	echo "<div class='input-group'>
	<span class='input-group-addon'>Rola</span>
	<select name='rola' class='form-control'>";
	foreach($data['roles'] as $option)
	{
		if($data['user']->id_rola == $option->id)
			echo "<option value=$option->id selected='selected'>$option->nazwa</option>";
		else
			echo "<option value=$option->id>$option->nazwa</option>";
	}
	echo "</select>
</div>";
}?>


<?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Zapisz i zakończ', 'class' => 'btn btn-lg btn-primary btn-block' ));?>

<?php echo Form::close();?>