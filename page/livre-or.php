

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_profil.css" media="screen">

    <title>Livre-or</title>
</head>
<body>
<div class="admin">
<?php
$serveur = 'localhost';
$nomUtilisateur = 'root';
$motDePasse = 'Clement2203$';
$nomBaseDeDonnees = 'livreor';

try {
    // Connexion à la base de données avec PDO
    $bdd = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees;charset=utf8", $nomUtilisateur, $motDePasse);

    // Requête SQL pour récupérer les informations de la table étudiants
    $requete = "SELECT commentaires.commentaire, utilisateurs.login, commentaires.date FROM utilisateurs JOIN commentaires ON commentaires.id_utilisateur = utilisateurs.id";
    $resultat = $bdd->query($requete);
// Affichage du résultat dans un tableau HTML
    echo "<table>";
    echo"<table border = '1'>";
    echo "<thead>";
    echo "<tr>";

    echo "<th>commentaire</th>";
    echo "<th>id_utilisateur</th>";
    echo "<th>date</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";

        echo "<td>" . $ligne['commentaire'] . "</td>";
        echo "<td>" . $ligne['login'] . "</td>";
        echo "<td>" . $ligne['date'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Fermeture de la connexion à la base de données
    $resultat->closeCursor();
    $bdd = null;
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur
    echo "Erreur : " . $e->getMessage();
}
?>
<a href="commentaire.php">commentaire</a>
<a href="deconnexion.php">se déconnecter</a>
</div>
</body>