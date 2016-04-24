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
.input-group-custom{padding-bottom: 85px;height: 50px;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  

<?php echo Form::open(array('method' => 'post', 'class' => 'form-signin'));?>
<h3 class="form-heading">Wybier jezyk w jakim maja byc slowka do przetlumaczenia</h3>

<div class="input-group input-group-custom"> 
  <span class="input-group-addon input-group-custom2">Jezyk</span>
  <div class="radio col-xs-12 btn-group btn-group-justified">
    <label class=" btn-primary btn btn-group" id="l1">
      <input type="radio" name="radios1" class="track-order-change" id="firstRadio1" value="0">
      <?php echo $data[jezyki][0]->jez1;?>
    </label>
    <label class=" btn-primary btn btn-group" id="l2">
      <input type="radio" name="radios1" class="track-order-change" id="secondRadio1" value="1">
      <?php echo $data[jezyki][0]->jez2;?>
    </label>
  </div>
</div>

<script>
$('input[name="radios1"]').change(function() {    
    
    if($(this).val() == "0"){   
        $("[id=l1]").removeClass("btn-primary").addClass("btn-success");
        $("[id=l2]").removeClass("btn-success").addClass("btn-primary");
    }else if($(this).val() == "1"){
        $("[id=l1]").removeClass("btn-success").addClass("btn-primary");
        $("[id=l2]").removeClass("btn-primary").addClass("btn-success");
    }
});

</script>

<div class="btn-group btn-group-justified">
<?php echo "<div class=\"btn-group\">".Form::input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Gotowy !' , 'class' => 'btn btn-lg btn-primary' ))."</div>";?>
</div>


<?php echo Form::close();?>

