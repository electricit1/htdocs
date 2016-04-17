<div class="container">
     <div class="row text-center">
        <?php foreach ($data['kategorie'] as $value){  ?>
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img class="obrazek" src="<?=OBRAZKI.'/kategorie/'.$value->obrazek?>" alt="">
                    <div class="caption">
                        <h3><?=$value->nazwa?></h3>
                        <p><?=$value->opis?></p>
                        <p> <a href="kategorie/<?=$value->id?>" class="btn btn-primary"><?=$data['buttonCategory']?></a></p>
                    </div>
                </div>
            </div> 
        <?php }?>     
    </div>
    <?php if ($data['userrole']==4) {
    echo "    
    <div class=\"text-center\">
        <a href=\"kategorie/add\" class=\"btn btn-primary active\">Dodaj kategorie</a>    
    </div>";
    }?>
</div>
