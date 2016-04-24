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

label input[type=radio] {
    opacity: 0;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    


<h2 class="form-heading">Edytowanie kategorii</h2>
<?php echo "<form method='post' class='form-signin' enctype='multipart/form-data'>";?>
<div class="input-group"> 
  <span class="input-group-addon">Nazwa</span>
<?php echo Form::input(array('name' => 'nazwa', 'placeholder' => 'Nazwa', 'class' => 'form-control','required' => true, 'value' => $data[aktualne][0]->nazwa));?>  
</div>
<div class="input-group"> 
  <span class="input-group-addon">Opis</span>
<?php echo Form::input(array('name' =>'opis', 'placeholder' => 'Opis', 'class' => 'form-control','required' => true, 'value' => $data[aktualne][0]->opis));?>  
</div>

      
<?php echo "<div class='input-group'>
    <span class='input-group-addon'>Widocznosc</span>
  <select name='widocznosc' class='form-control' required>";

  foreach ($data['widocznosc'] as $value) { 
    $ten='';
    if ($value==1) {$odp='tak';}else{$odp='nie';}
    if ($value==$data[aktualne][0]->widocznosc) {$ten='selected';}    
    echo "<option value='".$value."' ".$ten.">".$odp."</option> "; 
  }

  echo "</select></div>";?>
    
<div class="input-group input-group-custom"> 
  <span class="input-group-addon input-group-custom2">Obraz</span>
  <div class="radio col-xs-12 btn-group btn-group-justified">
    <label class=" btn-primary btn btn-group">
        <input type="radio" name="radios" class="track-order-change" id="firstRadio" value="1">
        Aktualne
    </label>
    <label class=" btn-primary btn btn-group">
        <input type="radio" name="radios" class="track-order-change" id="secondRadio" value="2">
        Dodaj Nowy
    </label>
  </div>

  <div class="col-xs-12 panel-collapse collapse" id="firstAccordion">
      <div>
<?php echo "
       <div class='input-group'>
       <span class='input-group-addon'>Istniejace</span>
       <select name='obrazek1' class='form-control' required>"; 

       foreach ($data['obrazki'] as $key => $value) {  
         if ($value==$data['aktualne'][0]->obrazek) {
           echo "
           <option value='".$value."' selected>".$value."</option> "; 
         }else{
           echo "<option value='".$value."'>".$value."</option> 
          "; 
         }
       } 
       echo "</select></div>";?>
      </div>
  </div>    
  <div class="col-xs-12 panel-collapse collapse" id="secondAccordion">
    <div>
       <?php echo "<input name=\"obrazek[]\" type=\"file\" class=\"form-control\" style=\"padding-bottom: 40px;\"/>";?>  
    </div>
  </div>

</div>
<script>
    firstRadio.checked=true;

    $('#firstAccordion').collapse('show');

    $('input[name="radios"]').change( function() {
        
        if ($('#firstRadio').is(":checked")){
            $('#secondAccordion').collapse('hide');
            $('#firstAccordion').collapse('show');
        }

        if ($('#secondRadio').is(":checked")){
            $('#firstAccordion').collapse('hide');
            $('#secondAccordion').collapse('show');
        }

  });

</script>







<div class="btn-group btn-group-justified">
  <div class="btn-group">
    <?php echo Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Edytuj', 'class' => 'btn btn-lg btn-primary btn-block' ));?>
  </div>
  <div class="btn-group">
    <?php echo Form::input(array('type' => 'submit', 'name' => 'delete', 'value' => 'Usun', 'class' => 'btn btn-lg btn-primary btn-block' ));?>
  </div>
</div>
<?php echo "</form>";?>

