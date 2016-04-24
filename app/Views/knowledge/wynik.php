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
<div class="form-signin">
<h2 class="form-heading">Twoj wynik</h2>
<h3 class="text-center"><?php echo $data['wynik'][0]."/".$data['wynik'][1]." = " .($data['wynik'][0]/$data['wynik'][1])*100 ."%";?></h3>
</br>
<div class="text-center">
  <a href="/zestaw/all" class="btn btn-lg btn-primary">powrot do zestawow</a>
  </div>
</div>
  

