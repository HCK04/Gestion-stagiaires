<?php 
session_start();
require('database.php');


if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['dateNaissance']) || empty($_POST['filiere'])) {
    echo '<script>alert("Veuillez remplir tous les champs.")</script>';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $statement = $pdo->prepare("INSERT INTO stagiaire (nom, prenom, dateNaissance, idFiliere) 
    VALUES (:nom, :prenom, :dateNaissance, :idFiliere)");
    
    $statement->execute([
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':dateNaissance' => $_POST['dateNaissance'],
        ':idFiliere' => $_POST['filiere']
    
    ]);
    $_SESSION["success_save"] = "Ajouté avec success";
    header('Location: espaceprivee.php');
    

}
