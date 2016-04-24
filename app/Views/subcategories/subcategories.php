<div class="container">
     <div class="row text-center">
        <?php foreach ($data['podkategorie'] as $value){  ?>
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img class="obrazek" src="<?= OBRAZKI.'/podkategorie/'.$value->obrazek;?>" alt="">
                    <div class="caption">
                        <h3><?=$value->nazwa?></h3>
                        <p><?=$value->opis?></p>
                        <p class="btn-group btn-group-justified"> 
                            <a href="/zestaw/<?=$value->id?>" class="btn btn-primary"><?=$data['buttonSubCategory']?></a>
                            <?php 
                            if ($data['userrole']==4) {
                                echo "<a href='/podkategorie/$value->id/edit' class='btn btn-primary'>Edytuj</a>";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div> 
        <?php }?>
    </div>
    <?php if ($data['userrole']==4) {
    echo " 
    <div class=\"text-center\">
            <a href=\"/podkategorie/".$value->id_kategoria."/add\" class=\"btn btn-primary active\">Dodaj Podkategorie</a>    
    </div>";
    }?> 
</div>
