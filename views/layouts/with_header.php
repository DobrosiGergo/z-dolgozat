<!DOCTYPE html>
<html lang="hu">

<head>
    <title><?= $title . ' sheetstack' ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->include('components/head') ?>

</head>

<body>
    <header>
        <?php $this->include('components/navbar') ?>
        <div class="page-header">
            <div class="container">
                <h3><?= $title ?></h3>
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