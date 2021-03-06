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

<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin'));?>
<h2 class="form-heading">Edycja uprawnien</h2>
<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Uzytkownik</span>
	<select name='login' class='form-control' required>";

	foreach ($data['login'] as $value => $key) {	
			echo "<option value='".$key->id."'>".$key->login."</option> ";	
	}
	echo "</select></div>";?>

<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Podkategoria</span>
	<select name='podkategoria' class='form-control' required>";
	
	foreach ($data['subcategories'] as $value => $key) {	
			echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
	}
	echo "</select></div>";?>



<div class="btn-group btn-group-justified">

<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Dodaj', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
</div>
</div>
<?php echo Form::close();?>

