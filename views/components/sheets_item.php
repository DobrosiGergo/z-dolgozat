<?php

function sheet_item(array $params)
{
    $card = [
        'img_url'       => $params['img_url'],
        'title'         => $params['title'],
        'author_name'   => $params['author_name'],
        'author_url'    => $params['author_url'],
        'genre'         => $params['genre'],
        'page_number'   => $params['page_number'],
        'url'           => $params['url']
    ];

?>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card card-item" onclick="document.navigateTo('<?= $card['url'] ?>')">
            <figure class=" image card-img-top">
                <img class="" src="<?= $card['img_url'] ?>" alt="<?= $card['title'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $card['url'] ?>"><?= $card['title'] ?></a></h4>
                <h5 class="author"><a href="<?= $card['author_url'] ?>"><?= $card['author_name'] ?></a></h5>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link"><u><?= $card['genre'] ?></u></a>
                <a href="#" class="card-link"><?= $card['page_number'] ?> oldal</a>
            </div>
        </div>

    </div>
<?php

}