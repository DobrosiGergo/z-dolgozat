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

        <div class="section home mb-4">
            <div class="container">
                <div class="row">
                    <div class="col section-body">
                        <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
                        <p>Amet, consectetur adipiscing elit. Convallis in odio erat vitae. Auctor cras ut viverra nullam feugiat vulputate.</p>
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
    </header>

    <main class="container">
        <?php echo $content ?>
    </main>

    <?php include('views/components/footer.php') ?>

</body>

</html>