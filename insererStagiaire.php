<?php
session_start();
if (!isset($_SESSION['loginAdmin'])) {
    header("Location: authentifier.php");
    exit;
} else {
    // Remplir la liste déroulante (catégories)
    require('database.php');
    $statement = $pdo->prepare('SELECT idFiliere, intitule FROM filiere');
    $statement->execute();
    $filieres = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ajouter un Nouveau Stagiaire</title>
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .form-heading {
            color: #2c3e50;
        }
        .form-subheading {
            color: #34495e;
        }
        .form-label {
            color: #2980b9;
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            border-color: #3498db;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
        }
        .form-button {
            background-color: #3498db;
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .form-button:hover {
            background-color: #2980b9;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.4);
        }
        .icon {
            transition: color 0.3s ease;
        }
        .icon:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container mx-auto my-10">
        <div class="text-center mb-10">
            <h1 class="form-heading text-4xl font-bold mb-2">Ajouter un nouveau stagiaire</h1>
            <p class="form-subheading text-lg">Veuillez remplir tous les champs</p>
        </div>
        <form action="traitement.php" method="POST" enctype="multipart/form-data" class="form-container mx-auto max-w-lg">
            <div class="mb-4">
                <label for="nom" class="form-label mb-2 block text-lg font-medium">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" class="form-input w-full p-2 border rounded-md focus:outline-none" />
            </div>
            <div class="mb-4">
                <label for="prenom" class="form-label mb-2 block text-lg font-medium">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prénom" class="form-input w-full p-2 border rounded-md focus:outline-none" />
            </div>
            <div class="mb-4">
                <label for="dateNaissance" class="form-label mb-2 block text-lg font-medium">Date de Naissance</label>
                <input type="date" name="dateNaissance" id="dateNaissance" class="form-input w-full p-2 border rounded-md focus:outline-none" />
            </div>
            <div class="mb-4">
                <label for="photoProfil" class="form-label mb-2 block text-lg font-medium">Photo de profil</label>
                <input type="file" name="photoProfil" id="photoProfil" class="form-input w-full p-2 border rounded-md focus:outline-none" />
            </div>
            <div class="mb-4">
                <label for="filiere" class="form-label mb-2 block text-lg font-medium">Filière</label>
                <select name="filiere" id="filiere" class="form-input w-full p-2 border rounded-md focus:outline-none">
                    <option value="" selected disabled>Sélectionnez votre filière</option>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?= htmlspecialchars($filiere['idFiliere']); ?>"><?= htmlspecialchars($filiere['intitule']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Icons -->
            <div class="icons flex text-gray-500 mb-4">
                <svg class="icon mr-2 cursor-pointer border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg class="icon mr-2 cursor-pointer border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg class="icon mr-2 cursor-pointer border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
            </div>
            <!-- Buttons -->
            <div class="buttons flex justify-end">
                <input class="form-button p-2 px-4 font-semibold cursor-pointer rounded-md" type="submit" value="Ajouter">
            </div>
        </form>
    </div>
</body>
</html>
<?php } ?>
