<?php

function sheet_item(array $params)
{
    $sheet = [
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
        <div class="card sheet-item" onclick="document.navigateTo('<?= $sheet['url'] ?>')">
            <figure class=" image card-img-top">
                <img class="" src="<?= $sheet['img_url'] ?>" alt="<?= $sheet['title'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $sheet['url'] ?>"><?= $sheet['title'] ?></a></h4>
                <h5 class="author"><a href="<?= $sheet['author_url'] ?>"><?= $sheet['author_name'] ?></a></h5>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link"><u><?= $sheet['genre'] ?></u></a>
                <a href="#" class="card-link"><?= $sheet['page_number'] ?> oldal</a>
            </div>
        </div>

    </div>
<?php

}
