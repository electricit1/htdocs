<div class="container">
     <div class="row text-center">
        <?php foreach ($data['podkategorie'] as $value){  ?>
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img class="obrazek" src="<?= OBRAZKI.'/podkategorie/'.$value->obrazek?>" alt="">
                    <div class="caption">
                        <h3><?=$value->nazwa?></h3>
                        <p><?=$value->opis?></p>
                        <p> <a href="/kategorie/<?=$value->id_kategoria?>/<?=$value->id?>" class="btn btn-primary">To nie nasza broszkaaa!</a></p>
                    </div>
                </div>
            </div> 
        <?php }?>     
    </div>
</div>
