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

        <div class="section home mb-4" style="padding-top: 210px;">
            <div class="container">
                <div class="row">
                    <div class="col section-body">
                        <h1>Az oldalon megtalálhatóak a kották</h1>
                        <p>Amet, consectetur adipiscing elit. Convallis in odio erat vitae. Auctor cras ut viverra nullam feugiat vulputate.</p>
                    </div>
                    <div class="col">

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