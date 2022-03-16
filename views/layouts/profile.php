<?php
global $user;
?>

<!DOCTYPE html>
<html lang="hu">
<?php
global $user;
?>

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->include('components/head') ?>

</head>

<body class="profile">
    <header>
        <?php $this->include('components/navbar') ?>
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="profile ">
                            <div class="profile-image">
                                <img src="../files/users/<?=$user->img?>" alt="">
                            </div>
                            <h2 class="fullname"><?= $user->fullname ?></h2>
                            <h5 class="fullname">@<?= $user->username ?></h5>
                        </div>
                    </div>
                    <div class="col" style="text-align: right;">
                        <a href="edit" class="">Profil szerkesztés</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <?php $this->include('components/flashMessage') ?>
        <?php echo $content ?>
    </main>

    <?php $this->include('components/footer') ?>

</body>

</html>