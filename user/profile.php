<?php

use App\Helper;

require_once __DIR__ . '/../lib/autoload.php';

new App\Template();

if (!Helper::isAuth()) header('Location: /');

?>

<h1>Profil</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col">username</th>
            <th scope="col">fullname</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $user->email ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->fullname ?></td>
        </tr>

    </tbody>
</table>