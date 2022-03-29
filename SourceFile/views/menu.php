<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flexs justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
            Zay
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=about&action=aboutUs">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=shop&action=listAllProducts">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=contact&action=contact">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex divTest">
                <?php
                if(isset($_SESSION['username'])){
                ?>
                    <div class="ContentLogout">
                        <a class="nav-icon position-relative text-decoration-none" href="#">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark numberCart">99+</span>
                        </a>
                        <span class="nameUserConnected"><?=/*$_SESSION['name'];*/"emilien"?></span>
                        <button class="btn btn-primary" onclick="window.location.href = 'index.php?controller=logUsers&action=logout';">Se déconnecter</button>
                    </div>
                <?php
                }else{
                ?>
                    <div class="contentLogin">
                        <button class="btn btn-third" onclick="window.location.href = 'index.php?controller=logUsers&action=login';">Se connecter</button>
                        <button class="btn btn-primary" onclick="window.location.href = 'index.php?controller=logUsers&action=signin';">S'inscrire</button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
</nav>
<body>