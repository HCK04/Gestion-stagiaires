<?php
session_start();
require('database.php');
if (!isset($_SESSION['loginAdmin'])) {
    header("Location: authentifier.php");
    exit;
}else{


// remplir la liste deroulante (categories)
$statement = $pdo->prepare('SELECT idFiliere, intitule FROM filiere');
$statement->execute();
$filieres = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $statement = $pdo -> prepare('SELECT * FROM stagiaire WHERE idStagiaire = :idStagiaire');
    $statement -> execute([
        'idStagiaire' =>  $id
    ]);
    $stagiaire = $statement ->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
    <div class="heading text-center font-bold text-3xl m-5 text-yellow-500">Modifier un stagiaire</div>
    <div class="heading text-center text-l m-5 text-black-400">Veuillez remplir tous les champs</div>

    <style>
        body {background:white !important;}
    </style>

    <form action="traitement_modifier.php" method="POST">
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <input type="hidden" name="idStagiaire" value="<?php echo $stagiaire['idStagiaire']; ?>">

            <div>
                <label for="nom" class="mb-2 block text-base font-medium text-[#07074D]"> Nom </label>
                <input type="text" name="nom" id="nom" value="<?php echo $stagiaire['nom']; ?>" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div>
                <label for="prenom" class="mb-2 block text-base font-medium text-[#07074D]"> Prénom </label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $stagiaire['prenom']; ?>" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div>
                <label for="dateNaissance" class="mb-2 block text-base font-medium text-[#07074D]"> Date Naissance </label>
                <input type="date" name="dateNaissance" id="dateNaissance" value="<?php echo $stagiaire['dateNaissance']; ?>" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div>
                <label for="photoProfil" class="mb-2 block text-base font-medium text-[#07074D]"> Photo profil </label>
                <input type="file" name="photoProfil" id="photoProfil" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                <?php if ($stagiaire['photoProfil']): ?>
                    <img src="<?php echo $stagiaire['photoProfil']; ?>" alt="Photo de Profil" width="50" height="50">
                <?php endif; ?>
            </div>
            <div>
                <label for="filiere" class="mb-2 block text-base font-medium text-[#07074D]"> Filière </label>
                <select name="idFiliere" id="filiere" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="<?= $stagiaire['idFiliere'] ?>">
                    <option value="" disabled>Selectionnez votre filière</option>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?php echo $filiere['idFiliere']; ?>" <?php echo $stagiaire['idFiliere'] == $filiere['idFiliere'] ? 'selected' : ''; ?>>
                            <?php echo $filiere['intitule']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="buttons flex">
                <input class="btn border border-yellow-500 p-1 px-4 font-semibold cursor-pointer text-gray-100 ml-2 bg-yellow-500 hover:bg-yellow-600" type="submit" value="Save">
            </div>
        </div>
    </form>
</body>
</html>
<?php }?>