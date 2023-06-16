<?php
session_start();

$serveur = 'localhost';
$nomUtilisateur = 'root';
$motDePasse = 'Clement2203$';
$nomBaseDeDonnees = 'livreor';

$bdd = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees;charset=utf8", $nomUtilisateur, $motDePasse);

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requser->execute(array($getid));
    $userinfos = $requser->fetch();
    if (isset($_POST['submitcomm'])) {
        if (isset($_POST['comm']) && !empty($_POST['comm'])) {
            $commentaire = htmlspecialchars($_POST['comm']);
            /*$time = date('Y-m-d H:i:s', time());*/
            $ins = $bdd->prepare('INSERT INTO commentaires (commentaire, id_utilisateur /*date*/) VALUES (?,?)');
        $ins->execute(array($commentaire, $getid /*$time*/));
        } else {
            $erreur = "Erreur: Tous les champs doivent être complétés";
        }
    }
}
else {
    $erreur = "no get id";
}

$commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_utilisateur = :id_utilisateur ORDER BY id DESC');
$commentaires->bindParam(':id_utilisateur', $getid, PDO::PARAM_INT);
$commentaires->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/commentaire.css" media="screen">

    <title>Commentaire</title>
</head>
<body>
    <div class="commentaire">
        <h2>Commentaire</h2>
        <br /><br />
        <form method="post" action="">
            <table>
                <tr>
                    <td>
                        <label for="comm">Commentaire :</label>
                    </td>
                    <td>
                        <textarea type="text" id="comm" name="comm" placeholder="Commentaire"></textarea>
                    </td>
                </tr>
            </table>
            <input type="submit" id="submitcomm" name="submitcomm" value="Post Commentaire">
        </form>
    </div>
    <div class="profil2">
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
    </div>
    <a href="profil.php?id=<?php echo $userinfos['id']; ?>">profil</a><br>
    <a href="deconnexion.php">deconnexion</a>
</body>
</html>
