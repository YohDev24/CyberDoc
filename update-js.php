<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Fichiers</title>
    <link rel="stylesheet" href="cssEtScript/style.css">
    <link rel="stylesheet" href="cssEtScript/styleTab.css">
    <link rel="stylesheet" href="cssEtScript/styleModal.css">
    <link rel="stylesheet" href="cssEtScript/styleMenu.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <title>Accueil - Cybersécurité</title>


</head>

<body>
    <!-- menu personnaliser pour return -->
    <div class="menu-container">
        <div class="menu">
        </div>
    </div>



<?php 
$action = $_POST["action"]; 
$directory = __DIR__ . '/AllFiles'; // Assurez-vous que ce chemin est correct
$destdirectory = __DIR__ . '/[Arch]';
if (strpos($action, "ADD") === 0) {
    // partie ajout 
    

    // diff entre sub et caté 
    if($action == "ADD_SUBCATE")
    {
        var_dump("ON ES T ICI");
        $cate = $_POST["textboxSub"];
        $srcChanel = $_POST["srcCate"];
        $source = $directory."/".$srcChanel."/".$cate;        // récupértion de la 
    }
    else{
        $cate = $_POST["textbox"];
        $source = $directory."/".$cate;        // récupértion de la 
    }

    if (mkdir($source, 0755, true)) {
        echo "Le dossier a été créé avec succès.";
    } else {
        echo "Échec de la création du dossier.";
    }

} else {

    $cate = $_POST["cate"];

    // diff entre sub caté et caté 
    if($action == "DEL_SUBCATE")
    {
        $srcChanel = $_POST["srcCate"];
        $source = $directory."/".$srcChanel."/".$cate;
        var_dump($source);
    }
    else
    {
        $source = $directory."/".$cate;   
    }

    if (is_dir($source) && is_dir($destdirectory)) 
        {
            if(is_dir($destdirectory.'/'.$cate))
            {
                $cate = $cate . date('dmYHis');
            }

            var_dump("dossier trouvé ".$cate);
            rename($source, $destdirectory.'/'.$cate);
        }
        else
        {
            var_dump("aucun dossier trouvé " . $cate);
        }
}

header("Location: editCategorie.php");


function supprimerDossierRecursif($dossier) {
    // Vérifie si le dossier existe et si c'est bien un répertoire
    if (is_dir($dossier)) {
        // Utilise un RecursiveDirectoryIterator pour parcourir le dossier de manière récursive
        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dossier, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        // Supprime chaque objet (fichier ou dossier) trouvé
        foreach ($objects as $object) {
            if ($object->isDir()) {
                rmdir($object->getPathname());
            } else {
                unlink($object->getPathname());
            }
        }

        // Supprime le dossier une fois qu'il est vide
        rmdir($dossier);
        echo "Le dossier '$dossier' a été supprimé avec succès.";
    } else {
        echo "Le chemin spécifié n'est pas un dossier ou n'existe pas.";
    }
}


?>
