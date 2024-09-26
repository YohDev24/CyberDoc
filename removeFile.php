<?php


if (isset($_POST['fileToRemove'])) {
    $fileToDelete = $_POST['fileToRemove'];
    $host = $_SERVER['DOCUMENT_ROOT'];
    $path = $_SERVER['REQUEST_URI'];
    $directoryPath = dirname($path);

    $relativePath = "$host$directoryPath/AllFiles/$fileToDelete";


        echo("<p>Key : $relativePath</p>");
 
        
    // Vérifier si le fichier existe
    if (file_exists($relativePath)) {
        // Supprimer le fichier
        if (unlink($relativePath)) {
            echo "<p>Fichier '$relativePath' supprimé avec succès.</p>";
        } else {
            echo "<p>Erreur : impossible de supprimer le fichier.</p>";
        }
    } else {
        echo "<p>Erreur : fichier '$relativePath' introuvable.</p>";
    }
} else {
    echo "<p>Erreur : aucun fichier spécifié.</p>";
}
?>