<?php
require "login-class.php";
$user = new Users();
$uid = $_SESSION['uid'];
if (!$user->get_session()) {
    header('location:login.php');
}
?>
<html>
    <head>
        <title>Modules</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/jquery/jquery-ui.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/iconic-bootstrap.css">
        <script src="../assets/jquery/jquery-3.4.1.js"></script>
        <script src="../assets/jquery/jquery-ui.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <style>
            body {
                background:url("images/25101.jpg") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            .card:hover{
                box-shadow: 2px 3px 15px gray;
                transform: translateY(-1px);
            }
        </style>
    </head>
    <body>
    <div class="d-flex">
        <div class="p-2 mr-auto">
            <a class="" href="#"><img src="images/logo naya holding.png" width="200" height="100" /></a>
        </div>
        <div class="p-2">
            <a href="myaccount.php" class=""><img src="icons/person.svg" width="50" class="rounded-circle mr-3 "></a>
        </div>
        <div class="p-2">
            <a href="" class="nav-link" data-toggle="modal" data-target="#sign-out"><img src="icons/box-arrow-right.svg" width="35" class="text-danger"/></a>
        </div>
    </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-4">
                <div class="text-center">
                    <h1>Bienvenue, <?php $user->get_fullname($uid);?></h1>
                    <p>Veuillez choisir un module</p>
                </div>
                <br>
                <div class="card-deck">
                    <div class="card" style="background-color:#e3614d;">
                        <div class="card-body text-center">
                        <img src="icons/cash-stack.svg" width="50" class=""/>
                        <h2 class="">Gestion des Prospects</h2>
                        <p class="card-text">G&eacute;rez tout ce qui concerne les prospects et obtenez un suivi d&eacute;taill&eacute;</p>
                        <a href="prospect/index-prospect.php?page=tableau" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card" style="background-color:#1ab4b6;">
                        <div class="card-body text-center">
                        <img src="icons/people-fill.svg" width="50" class="text-white"/>
                        <h2 class="">Gestion des Clients</h2>
                        <p class="card-text">G&eacute;rez les clients existants et obtenez un historique des achats</p>
                        <a href="client/index-client.php?page=clients" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card" style="background-color:#8ac063;">
                        <div class="card-body text-center">
                        <img src="icons/box-seam.svg" width="50" class="text-white"/>
                        <h2 class="">Gestion de Stock</h2>
                        <p class="card-text">G&eacute;rer le stock et cr&eacute;er des bons d&apos;entr&eacute;e et de sortie</p>
                        <a href="stock/index-stock.php?page=tableau" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="card-deck">
                        <div class="card" style="background-color:#9370DB;">
                            <div class="card-body text-center">
                                <img src="icons/person-lines-fill.svg" width="50" class="text-white"/>
                                <h2 class="">Liste des Contacts</h2>
                                <p class="card-text">Trouverez ici les coordonnées des couturi&egrave;r, fournisseurs, livreurs, etc.</p>
                                <a href="contacts.php" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="card" style="background-color:#f9d31e;">
                            <div class="card-body text-center">
                                <img src="icons/person-fill.svg" width="50" class="text-white"/>
                                <h2 class="">Mon Compte</h2>
                                <p class="card-text">Détails du compte utilisateur</p>
                                <a href="myaccount.php" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                            
        </div>
        <!--Signout Modal-->
<div class="modal fade" id="sign-out">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Déconnexion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Voulez-vous vous d&eacute;connecter?
            </div>
            <div class="modal-footer">
                <a href="signout.php"><button type="button" class="btn btn-success">D&eacute;connexion</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- End of SignOut modal -->
    </body>
</html>
