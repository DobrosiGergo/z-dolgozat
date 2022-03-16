<?php
function artist_item(array $params)
{
    global $user;

    $user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
    $sheet = [
        'img_url'       => $params['img_url'],
        'name'         => $params['name'],
        'url'           => $params['url'],
        'user_id'       => $user_id
    ];

?>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card card-item artist" onclick="document.navigateTo('<?= $sheet['url'] ?>')">
            <figure class="image card-img-top">
                <img class="" src="<?= $sheet['img_url'] ?>" alt="<?= $sheet['name'] ?>">
            </figure>
            <div class="card-body text-center">
                <h4 class="card-title"><a href="<?= $sheet['url'] ?>"><?= $sheet['name'] ?></a></h4>
               
            </div>
            <?php if ($user_id && $user->id == $sheet['user_id']) : ?>
                <div class="card-footer edit">
                    <a href="<?= $sheet['url'] ?>" class="card-link">Szerkesztés</a>
                    <a href="#" class="card-link">Törlés</a>
                </div>
                <?php else :?>
             <div class="card-footer">
                 <a href="<?= $sheet['url'] ?>" class="card-link">Megtekintés</a>
             </div>
            <?php endif; ?>
        </div>

    </div>
<?php

}
