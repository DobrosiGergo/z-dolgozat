<?php
require_once './lib/autoload.php';

new App\Template('Felhasználók');

$users = new App\Models\User;
?>

<h1>Felhasználók</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">username</th>
            <th scope="col">fullname</th>
            <th scope="col">Kedvenc kategória</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users->all() as $user) {
        ?>
            <tr>
                <th scope="row">1</th>
                <td><?= $user['username'] ?></td>
                <td><?= $user['id'] ?></td>
                <td><?= $user['fullname'] ?></td>
                <td><?= $user['favorite_categories'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>