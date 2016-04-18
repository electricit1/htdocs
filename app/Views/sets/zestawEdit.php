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
<?php 
$zestaw=explode(';', $data['zestaw'][0]->{'Zawartosc zestawu'});
?>

<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin'));?>
<h2 class="form-heading">Edycja zestawu</h2>
<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Jezyk 1</span>
	<select name='Jezyk_1' class='form-control' required>";

	foreach ($data['lang'] as $value => $key) {	
		if ($key->id==$data[zestaw][0]->id_jezyk1) {
			echo "<option value='".$key->id."' selected>".$key->nazwa."</option> ";	
		}else{
			echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
		}
	}
	echo "</select></div>";?>

<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Jezyk 2</span>
	<select name='Jezyk_2' class='form-control' required>";
	
	foreach ($data['lang'] as $value => $key) {	
		if ($key->id==$data[zestaw][0]->id_jezyk2) {
			echo "<option value='".$key->id."' selected>".$key->nazwa."</option> ";	
		}else{
			echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
		}
	}
	echo "</select></div>";?>

<?php echo "<div class='input-group'>
		<span class='input-group-addon'>Nazwa podkategorii</span>
	<select name='Nazwa_podkategorii' class='form-control' required>";
	
	foreach ($data['subcategories'] as $value => $key) {	
		if ($key->id==$data[zestaw][0]->{'id_podkategoria'}) {
			echo "<option value='".$key->id."' selected>".$key->nazwa."</option> ";	
		}else{
			echo "<option value='".$key->id."'>".$key->nazwa."</option> ";	
		}
	}
	echo "</select></div>";?>
<div class="input-group"> 
	<span class="input-group-addon">Nazwa zestawu</span>
	<?php echo Form::input(array('name' => 'Nazwa_zestawu', 'placeholder' => 'Nazwa zestawu', 'class' => 'form-control', 'required' => true, 'value' => $data['zestaw'][0]->{'Nazwa zestawu'}, 'type' => 'text')); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Zawartosc zestawu I</span>
	<?php echo Form::input(array('name' => 'Zawartosc_zestawu1', 'placeholder' => 'Zawartosc zestawu', 'class' => 'form-control', 'required' => true, 'value' => $zestaw[0], 'type' => 'text' )); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Zawartosc zestawu II</span>
	<?php echo Form::input(array('name' => 'Zawartosc_zestawu2', 'placeholder' => 'Zawartosc zestawu', 'class' => 'form-control', 'required' => true, 'value' => $zestaw[1], 'type' => 'text' )); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Ilosc slowek</span>
	<?php echo Form::input(array('name' => 'Ilosc_slowek', 'placeholder' => 'Ilosc slowek', 'class' => 'form-control', 'required' => true, 'value' => $data['zestaw'][0]->{'Ilosc slowek'}, 'type' => 'text' )); ?>
</div>
<div class="input-group"> 
	<span class="input-group-addon">Data edycji</span>
	<?php echo Form::input(array('name' => 'Data_edycji', 'placeholder' => 'Data edycji', 'class' => 'form-control', 'required' => true, 'value' => $data['zestaw'][0]->{'Data edycji'}, 'type' => 'text', 'pattern' => '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' )); ?>
</div>




<div class="btn-group btn-group-justified">

<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Zapisz', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'delete', 'value' => 'Usun', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
</div>
</div>
<?php echo Form::close();?>

