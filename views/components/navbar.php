    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex justify-content-end"><img src="/files/toggler/rows.png" alt="">
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand" href="/"><img src="/files/toggler/home.png" style="width: 25px; height:25px;"></a>
                <ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="/artist/">Alkotók</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="/music/">Kották</a>
                    </li>
                </ul>
                <form id="navSearchForm" class="form-inline d-flex" action="/search" method="GET">
                    <input class="form-control mr-sm-2" type="search" aria-label="Search" placeholder="Keresés..." name="q" <?php if (isset($_GET['q'])) echo 'value="' . $_GET['q'] . '"'; ?>>
                    <a href="#" class="search material-icons" onclick="document.getElementById('navSearchForm').submit();" name="search">search</a>
                </form>
                <ul class="navbar-nav">
                    
                    <?php
                    if (!App\Helper::isAuth()) {

                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../Userhandler/login">
                                Bejelentkezés
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cta" href="/Userhandler/register">
                                Regisztráció
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <a class="nav-link" href="/createflow">
                            <i class="material-icons">cloud_upload</i>
                            Feltöltés
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/user/profile">
                                <?= App\Helper::user()->username ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/Userhandler/logout">
                                Kijelentkezés
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        </div>
    </nav>