<?php
session_start();
require('database.php');

$idStagiaire = $_POST['id'];

$statement = $pdo->prepare("DELETE FROM stagiaire WHERE idStagiaire = :idStagiaire");
$statement->execute([
    ':idStagiaire' => $idStagiaire
]);


header("Location: espaceprivee.php");



?>
