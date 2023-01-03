<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-quiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <title>Admin</title>
        <!--bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
              crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container-fluid p-0 ">
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">Pocetna</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
            <div class="bg-light">
                <h3 class="text-center p-2">
                    Manipulacija podataka
                </h3>
            </div>
            <div class="row">
                <div class="col-md-12 bg-secondary p-1 d- align-items-center">
                    <div class="p-2">
                        <p class="text-light text-center">Admin</p>
                    </div>
                    <div class="button text-center">
                        <button class="my-3"><a href="index.php?svi-proizvodi" class="nav-link text-light bg-info ">Svi proizvodi</a></button>
                        <button><a  href="index.php?dodaj-proizvod" class="nav-link text-light bg-info ">Dodaj proizvod</a></button>
                        <button><a class="nav-link text-light bg-info ">Updatejtuj proizvod</a></button>
                        <button><a class="nav-link text-light bg-info ">Obrisi proizvod</a></button>
                        <button><a class="nav-link text-light bg-info ">Porudzbine</a></button>
                        <button><a class="nav-link text-light bg-info ">Korisnici</a></button>
                        <button><a class="nav-link text-light bg-info ">Odjavite se</a></button>
                    </div>
                </div>
            </div>
            <div class="container my-5">
                <?php
                    if(isset($_GET["dodaj-proizvod"])){
                        include('new-item/dodaj-proizvod.php');
                    }
                    if(isset($_GET["svi-proizvodi"])){
                        include('all-items/all-items.php');
                    }
                ?>
            </div>
        </div>
    <!--js link for bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    </body>
</html>