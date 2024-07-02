<?php 
require 'database.php';
if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $statement = $pdo -> prepare('UPDATE stagiaire SET nom = :nom , prenom = :prenom , dateNaissance = :dateNaissance , idFiliere = :idFiliere WHERE idStagiaire = :idStagiaire');
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance'];
    $idFiliere = $_POST['idFiliere'];
    $idStagiaire = $_POST['idStagiaire'];
    $statement -> execute([
        ':idStagiaire' => $idStagiaire,
        ":nom" => $nom,
        ':prenom' => $prenom,
        ':dateNaissance' => $dateNaissance,
        ':idFiliere' => $idFiliere
    ]);
    header('Location:espaceprivee.php');
}






?>