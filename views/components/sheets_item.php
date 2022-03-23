<?php


function sheet_item(array $card)
{

?>
    <div class="col-sm-12 col-md-6 col-lg-3" style="margin-top:10px;">
        <div class="card card-item sheet" onclick="document.navigateTo('<?= $card['url'] ?>')">
            <figure class=" image card-img-top">
                <img class="" src="<?= $card['img_url'] ?>" alt="<?= $card['title'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $card['url'] ?>"><?= $card['title'] ?></a></h4>
                <h5 class="author"><a href="<?= $card['author_url'] ?>"><?= $card['author_name'] ?></a></h5>
            </div>

            <?php if ($card['auth']) : ?>
                <div class="card-footer edit">
                    <a class="btn btn-primary" href="<?= $card['url'] ?>/edit" class="card-link"><i class="material-icons">edit</i> Szerkesztés</a>
                    <a class="btn btn-delete" href="<?= $card['url'] ?>/delete" class="card-link">Törlés</a>
                </div>
            <?php else : ?>
                <div class="card-footer">
                    <a class="card-link"><?= $card['genre'] ?></a>
                </div>
            <?php endif; ?>

        </div>

    </div>
<?php

}
