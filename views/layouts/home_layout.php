<!DOCTYPE html>
<html lang="hu">

<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->include('components/head') ?>

</head>

<body>
    <header>

        <?php $this->include('components/navbar') ?>

    </header>

    <?php if (!App\Helper::isAuth()) : ?>
        <div class="container home-container">
            <?php $this->include('components/flashMessage') ?>


            <div class=" split left">
                <h1>Alkotók</h1>
                <a href="artist" class="button1">Nézze meg</a>
            </div>
            <div class="split right">
                <h1 class="white">Elérhető kották</h1>
                <a href="music/index.php" class="button1 white">Nézze meg</a>
            </div>
        </div>
    <?php else : ?>


        <?php $this->include('components/flashMessage') ?>
        <?= $content ?>


    <?php endif; ?>

    <?php $this->include('components/footer') ?>

</body>

</html>