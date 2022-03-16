<?php

function sheet_item(array $params)
{
    global $user;
    $user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
    $card = [
        'img_url'       => $params['img_url'],
        'title'         => $params['title'],
        'author_name'   => $params['author_name'],
        'author_url'    => $params['author_url'],
        'genre'         => $params['genre'],
        'page_number'   => $params['page_number'],
        'url'           => $params['url'],
        'user_id'       => $user_id
    ];

?>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card card-item sheet" onclick="document.navigateTo('<?= $card['url'] ?>')">
            <figure class=" image card-img-top">
                <img class="" src="<?= $card['img_url'] ?>" alt="<?= $card['title'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $card['url'] ?>"><?= $card['title'] ?></a></h4>
                <h5 class="author"><a href="<?= $card['author_url'] ?>"><?= $card['author_name'] ?></a></h5>
            </div>

            <?php if ($user_id && $user->id == $card['user_id']) : ?>
                <div class="card-footer edit">
                    <a href="<?= $card['url'] ?>" class="card-link">Szerkesztés</a>
                    <a href="#" class="card-link">Törlés</a>
                </div>
                <?php else :?>
             <div class="card-footer">
                 <a href="<?= $card['url'] ?>" class="card-link">Megtekintés</a>
             </div>
            <?php endif; ?>

        </div>

    </div>
<?php

}
