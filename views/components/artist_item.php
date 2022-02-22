<?php

function artist_item(array $params)
{
    $sheet = [
        'img_url'       => $params['img_url'],
        'name'         => $params['name'],
        'genre'         => $params['genre'],
        'url'           => $params['url']
    ];

?>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card sheet-item" onclick="document.navigateTo('<?= $sheet['url'] ?>')">
            <figure class="image card-img-top">
                <img class="" src="<?= $sheet['img_url'] ?>" alt="<?= $sheet['name'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $sheet['url'] ?>"><?= $sheet['name'] ?></a></h4>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link"><u><?= $sheet['genre'] ?></u></a>
            </div>
        </div>

    </div>
<?php

}
