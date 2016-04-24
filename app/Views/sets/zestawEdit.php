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
<h2 class="form-heading">Edycja zestawu</h2>
<div class="input-group"> 
	<span class="input-group-addon">Nazwa zestawu</span>
	<?php echo Form::input(array('name' => 'Nazwa_zestawu', 'placeholder' => 'Nazwa zestawu', 'class' => 'form-control', 'required' => true, 'value' => $data['zestaw'][0]->{'Nazwa zestawu'}, 'type' => 'text')); ?>
</div>
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

<?php echo "<div class='input-group'>
   		<span class='input-group-addon'>Widocznosc</span>
 	 <select name='widocznosc' class='form-control' required>";

  foreach ($data['widocznosc'] as $value) { 
    $ten='';
    if ($value==1) {$odp='tak';}else{$odp='nie';}
    if ($value==$data[zestaw][0]->widocznosc) {$ten='selected';}    
    echo "<option value='".$value."' ".$ten.">".$odp."</option> "; 
  }

  echo "</select></div>";?>

<div class="input-group"> 
	<span class="input-group-addon">Zawartosc zestawu</span>
	<?php echo Form::textarea(array('style' => 'height: 150px;','name' => 'Zawartosc_zestawu1', 'placeholder' => 'Zawartosc zestawu', 'class' => 'form-control', 'required' => true, 'value' => $data['zestaw'][0]->{'Zawartosc zestawu'}, 'type' => 'text' )); ?>
</div>



<div class="btn-group btn-group-justified">
<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Zapisz', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'delete', 'value' => 'Usun', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
</div>

<?php echo Form::close();?>

