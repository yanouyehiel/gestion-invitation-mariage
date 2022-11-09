<?php

    include('phpqrcode/qrlib.php');
    include('connectDB.php');

    if (isset($_POST['generate'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $type_billet = htmlspecialchars(trim($_POST['type_billet']));
        $nom_table = htmlspecialchars(trim($_POST['nom_table']));

        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT *, COUNT(*) As numrows FROM invites WHERE nom=:nom And prenom=:prenom");
        $stmt->execute(['nom' => $nom, 'prenom' => $prenom]);
        $row = $stmt->fetch();

        if ($row['numrows'] > 0) {
            echo '<div class="alert alert-danger" role="alert">
                Cette personne fait déjà partie des invités !
            </div>';
        } else {
            $stmt = $conn->prepare("INSERT INTO invites (nom, prenom, type_billet, nom_table) VALUES (:nom, :prenom, :type, :table)");
            $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'type' => $type_billet, 'table' => $nom_table]);

            $infos = '
                Nom : '.$nom.'
                Prénom : '.$prenom.'
                Type de billet : '.$type_billet.'
                Nom de la table : '.$nom_table.'
            ';
            QRcode::png($infos, 'images/'.$nom.'-'.$prenom.'.png');
            echo '<div class="alert alert-success" role="alert">
                    Félicitations, code QR crée !
                </div>
            ';   
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
            Remplissez d\'abord tous les champs !
        </div>';
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <style>
        .qr-code{
            align-items: center;
            justify-content: center;
            margin-left: 200px !important;
        }
    </style>
    <title>Génération QR Code invités</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>GENERER UN QR CODE</h3>
                    </div>
                    <div class="panel-body">
                        <p>Entrer les informations du billet</p>
                        <form method="post">
                            <div class="form-group">
                                <?php
                                    if (isset($nom)) {
                                        ?>
                                        <input type="text" class="form-control" name="nom" placeholder="<?= $nom ?>" required>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    if (isset($prenom)) {
                                        ?>
                                        <input type="text" class="form-control" name="prenom" placeholder="<?= $prenom ?>" required>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="type_billet" required>
                                    <option>Veuillez choisir le type du billet</option>
                                    <option value="Célibataire">Célibataire</option>
                                    <option value="Couple">Couple</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="nom_table" required>
                                    <option>Veuillez choisir le nom de la table</option>
                                    <option value="Limonade">Limonade</option>
                                    <option value="Pamplemousse">Pamplemousse</option>
                                    <option value="Ananas">Ananas</option>
                                    <option value="Citron">Citron</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="Generate" value="Générer le QRCode" name="generate" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer" style="align-items: center; justify-content: center">                       
                        <img class="qr-code" src="<?= 'images/'.$nom.'-'.$prenom.'.png' ?>" width="150px" height="150px">
                        <div class="form-group">
                            <a href="<?= 'images/'.$nom.'-'.$prenom.'.png' ?>" class="btn btn-primary">Télécharger l'image</a>
                        </div>
                        <div class="panel-footer">Voulez-vous indentifier un invité ? <a href="check.php">Indentifier</a></div>                         
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <center> 
                    <div class="copyright py-sm-5 py-4 text-center">
                        <div class="container">
                            <p class="copy-footer-29">© 2022 All rights reserved | Design by <a
                                href="https://www.oncheckcm.com/Yehiel%20Yanou/index" target="_blank">Yehiel Yanou</a></p>
                        </div>
                    </div>
                </center>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script>
        function htmlEncode(value) {
            return $('<div>').text(value).html();
        }

        $(function (){
            $('#Generate').click(function (){
                let urlImage = "<?= 'images/'.$nom.'-'.$prenom.'.png' ?>"
                $('.qr-code').attr('src', urlImage);
            });
        });
    </script>
</body>
</html>