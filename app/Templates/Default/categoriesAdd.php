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

<div class="container">
<?php echo Form::open(array('method' => 'post', 'class' => 'form-horizontal', enctype => "multipart/form-data"));?>
<?php echo Form::input(array('name' => 'nazwa', 'placeholder' => 'Nazwa', 'class' => 'form-control','required' => true));?>
<?php echo Form::input(array('name' =>'opis', 'placeholder' => 'Opis', 'class' => 'form-control','required' => true));?>

<?php echo "<input name=\"MAX_FILE_SIZE\" type=\"hidden\" value=\"10M\"/>";?>
<?php echo "<input name=\"obrazek[]\" type=\"file\" class=\"form-control\" required/>";?>


<?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Dodaj', 'class' => 'btn btn-lg btn-primary btn-block' ));?>

<?php echo Form::close();?>
</div>
