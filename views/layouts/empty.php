<!DOCTYPE html>
<html lang="hu">

<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/components/head.php') ?>

</head>

<body>
    <header>
        <?php include('views/components/navbar.php') ?>
    </header>
    <main class="container">
        <?php echo $content ?>
    </main>

    <?php include('views/components/footer.php') ?>
</body>

</html>