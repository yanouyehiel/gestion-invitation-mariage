<?php
    include('connectDB.php');

    if (isset($_POST['verifier'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);

        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM invites WHERE nom=:nom And prenom=:prenom");
        $stmt->execute(['nom'=>$nom, 'prenom'=>$prenom]);
        $row = $stmt->fetch();
    }else {
        echo '<div class="alert alert-danger" role="alert">
            Remplissez d\'abord tous les champs !
        </div>';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Rechercher un invité</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <br><br><br>
           <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>IDENTIFICATION</h3>
                            </div>
                            <div class="panel-body">
                                <p>Vérifier la présence d'un invité sur la liste.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Vérifier" name="verifier" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <?php
                                if (isset($row['numrows']) > 0) {
                                    ?>
                                    <div class="modal-body">
                                        <p>Nom : <?= $row['nom'] ?>.</p>
                                        <p>Prénom : <?= $row['prenom'] ?>.</p>
                                        <p>Type de billet : <?= $row['type_billet'] ?>.</p>
                                        <p>Nom de la table : <?= $row['nom_table'] ?>.</p>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="modal-body">
                                        <p>Aucun invité trouvé. Cette personne n'est pas invitée.</p>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="panel-footer">Voulez-vous générer un code ? <a href="Qrcode.php">Générer</a></div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <br><br>
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
    </body>
</html>
