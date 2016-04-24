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
<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin', 'style'=> 'max-width:600px;'));?>
<h2 class="form-heading">Przetlumacz slowko</h2>
<h3 class="form-heading"><?php echo explode(';',$_SESSION['tab'][0])[$data['wybor']];?></h3>
<div class="input-group"> 
	<span class="input-group-addon">Twoje tlumaczenie</span>
	<?php echo Form::input(array('name' => 'slowo', 'placeholder' => 'Podaj slowo', 'class' => 'form-control', 'required' => true, 'type' => 'text')); ?>
</div>


<div style="width: 80px;margin:auto;">
<div class="btn-group" style="margin:auto;">
<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Wyslij', 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
</div>
</div>
</div>
<?php echo Form::close();?>

