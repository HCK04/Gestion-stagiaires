<?php
session_start();
require('database.php');

if (!isset($_SESSION['loginAdmin'])) {
    header("Location: authentifier.php");
    exit;
}


$statement = $pdo->prepare("SELECT nom, prenom FROM compteadministrateur WHERE loginAdmin = :loginAdmin");
$statement->execute([
    ':loginAdmin' => $_SESSION['loginAdmin']
]);

$admin = $statement->fetch(PDO::FETCH_ASSOC);
if (!$admin) {
    echo "Erreur: impossible de récupérer les informations de l'administrateur.";
    exit;
}


$heure_actuelle = date("H");
if ($heure_actuelle < 18) {
    $message = "Bonjour";
} else {
    $message = "Bonsoir";
}


$statement_stagiaires = $pdo->prepare("SELECT s.idStagiaire, s.nom, s.prenom, s.dateNaissance, f.intitule, s.photoProfil FROM stagiaire s JOIN filiere f ON s.idFiliere = f.idFiliere");
$statement_stagiaires->execute();
$stagiaires = $statement_stagiaires->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Espace Privé</title>
</head>
<body class="bg-gray-100">
    <header class="bg-gray-800 container mx-auto flex items-center justify-between h-24 rounded-b-lg shadow-lg">
        <h1 class="font-bold text-4xl m-5 text-white">Espace Privé</h1>
        <form action="deconnecter.php" method="post">
            <button class="border border-white rounded-full font-bold px-8 py-2 text-white bg-red-500 hover:bg-red-700" type="submit">Se Déconnecter</button>
        </form>
    </header>

    <?php if (isset($_SESSION["success_save"])): ?>
    <div class="flex justify-center items-center m-4 font-medium py-2 px-4 rounded-lg text-green-700 bg-green-200 border border-green-300">
        <div class="flex-initial">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <div class="flex-auto"><?= $_SESSION["success_save"] ?></div>
        <div class="flex flex-row-reverse ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer hover:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </div>
    </div>
    <?php unset($_SESSION['success_save']); endif; ?>

    <div class="text-center font-bold text-3xl m-5 text-blue-500"><?= $message . ", " . htmlspecialchars($admin['prenom']) . " " . htmlspecialchars($admin['nom']); ?></div>
    <div class="text-center text-xl m-5 text-black">Liste des stagiaires</div>
    <div class="text-center">
        <a href="insererStagiaire.php" class="btn bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-700">Ajouter</a>
    </div>
    <table class="min-w-full border-collapse block md:table mt-5 mx-auto w-11/12">
        <thead class="block md:table-header-group">
            <tr class="bg-gray-600 md:border-none block md:table-row text-white text-left">
                <th class="p-2 font-bold md:border md:border-gray-500 block md:table-cell rounded-t-lg">Nom</th>
                <th class="p-2 font-bold md:border md:border-gray-500 block md:table-cell">Prénom</th>
                <th class="p-2 font-bold md:border md:border-gray-500 block md:table-cell">Date de naissance</th>
                <th class="p-2 font-bold md:border md:border-gray-500 block md:table-cell">Filière</th>
                <th class="p-2 font-bold md:border md:border-gray-500 block md:table-cell">Photo profil</th>
                <th class="p-2 font-bold md:border md:border-gray-500 block md:table-cell rounded-tr-lg">Actions</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            <?php foreach ($stagiaires as $stagiaire): ?>
            <tr class="bg-white border border-gray-200 md:border-none block md:table-row rounded-lg mb-4 md:mb-0">
                <td class="p-2 md:border md:border-gray-200 block md:table-cell"><?= htmlspecialchars($stagiaire['nom']); ?></td>
                <td class="p-2 md:border md:border-gray-200 block md:table-cell"><?= htmlspecialchars($stagiaire['prenom']); ?></td>
                <td class="p-2 md:border md:border-gray-200 block md:table-cell"><?= htmlspecialchars($stagiaire['dateNaissance']); ?></td>
                <td class="p-2 md:border md:border-gray-200 block md:table-cell"><?= htmlspecialchars($stagiaire['intitule']); ?></td>
                <td class="p-2 md:border md:border-gray-200 block md:table-cell"><img src="<?= htmlspecialchars($stagiaire['photoProfil']); ?>" alt="Photo de Profil" width="50" height="50" class="rounded-full"></td>
                <td class="p-2 md:border md:border-gray-200 block md:table-cell">
                    <a href="modifier.php?id=<?= $stagiaire['idStagiaire'] ?>"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-lg">Modifier</button></a>
                    <form action="supprimer.php" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire ?');">
                        <input type="hidden" name="id" value="<?= $stagiaire['idStagiaire']; ?>">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-lg">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
