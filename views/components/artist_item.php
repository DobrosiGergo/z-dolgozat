<?php



function artist_item(array $params)
{

?>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card card-item artist" onclick="document.navigateTo('<?= $params['url'] ?>')">
            <figure class="image card-img-top">
                <img class="" src="<?=$params['img_url'] ?>" alt="<?= $params['name'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $params['url'] ?>"><?= $params['name'] ?></a></h4>

            </div>
            <?php if ($params['auth']) : ?>
                <div class="card-footer edit">
                    <a class="btn btn-primary" href="<?= $params['url'] ?>/edit" class="card-link"><i class="material-icons">edit</i> Szerkesztés</a>
                    <a class="btn btn-delete" href="<?= $params['url'] ?>/delete" class="card-link">Törlés</a>
                </div>              
            <?php endif; ?>

        </div>

    </div>
<?php

}
