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
<h2 class="form-heading">Dodawanie zestawu</h2>
<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Jezyk 1</span>
	<select name='Jezyk_1' class='form-control' required>";

	foreach ($data['lang'] as $value => $key) {	
		echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
	}
	echo "</select></div>";?>

<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Jezyk 2</span>
	<select name='Jezyk_2' class='form-control' required>";
	
	foreach ($data['lang'] as $value => $key) {	
		echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
	}
	echo "</select></div>";?>

<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Nazwa podkategorii</span>
	<select name='Nazwa_podkategorii' class='form-control' required>";
	
	foreach ($data['subcategories'] as $value => $key) {	
		echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
	}
	echo "</select></div>";?>
<div class="input-group"> 
	<span class="input-group-addon">Nazwa zestawu</span>
	<?php echo Form::input(array('name' => 'Nazwa_zestawu', 'placeholder' => 'Nazwa zestawu', 'class' => 'form-control', 'required' => true, 'type' => 'text')); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Zawartosc zestawu I</span>
	<?php echo Form::input(array('name' => 'Zawartosc_zestawu1', 'placeholder' => 'Zawartosc zestawu', 'class' => 'form-control', 'required' => true, 'type' => 'text' )); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Zawartosc zestawu II</span>
	<?php echo Form::input(array('name' => 'Zawartosc_zestawu2', 'placeholder' => 'Zawartosc zestawu', 'class' => 'form-control', 'required' => true, 'type' => 'text' )); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Ilosc slowek</span>
	<?php echo Form::input(array('name' => 'Ilosc_slowek', 'placeholder' => 'Ilosc slowek', 'class' => 'form-control', 'required' => true, 'type' => 'text' )); ?>
</div>


<div class="btn-group btn-group-justified">
<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'add', 'value' => 'Dodaj', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
</div>
</div>
<?php echo Form::close();?>

