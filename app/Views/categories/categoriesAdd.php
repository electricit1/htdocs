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


<h2 class="form-heading">Dodawanie kategorii</h2>
<?php echo "<form method='post' class='form-signin' enctype='multipart/form-data'>";?>
<div class="input-group"> 
  <span class="input-group-addon">Nazwa</span>
<?php echo Form::input(array('name' => 'nazwa', 'placeholder' => 'Nazwa', 'class' => 'form-control','required' => true));?>  
</div>
<div class="input-group"> 
  <span class="input-group-addon">Opis</span>
<?php echo Form::input(array('name' =>'opis', 'placeholder' => 'Opis', 'class' => 'form-control','required' => true));?>  
</div>
<div class="input-group"> 
  <span class="input-group-addon">Obraz</span>
<?php echo "<input name=\"obrazek[]\" type=\"file\" class=\"form-control\" style=\"padding-bottom: 40px;\" required/>";?>  
</div>

<div class="btn-group btn-group-justified">
  <div class="btn-group">
<?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Dodaj', 'class' => 'btn btn-lg btn-primary btn-block' ));?>
  </div>
</div>
<?php echo "</form>";?>

