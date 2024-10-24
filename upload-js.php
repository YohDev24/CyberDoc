<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le chemin de dossier envoyé via le champ caché
    $dossier = $_POST['dossier'];
    
    // Vérification de l'existence du tableau de fichiers
    if (isset($_FILES['file'])) {
        // Création du dossier si nécessaire
        if (!is_dir($dossier)) {
            mkdir($dossier, 0777, true);
        }

        // Parcours des fichiers uploadés
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['file']['name'][$key]);
            $uploadDir = __DIR__ . '/AllFiles/'.rtrim($dossier, '/') . '/'; // Utilise le chemin du dossier
            $uploadFile = $uploadDir . $fileName;

            // Déplacer le fichier uploadé dans le dossier spécifié
            if (move_uploaded_file($tmp_name, $uploadFile)) {
                echo "Le fichier " . htmlspecialchars($fileName) . " a été téléchargé ($dossier).<br>";
            } else {
                echo "Erreur lors du téléchargement du fichier " . htmlspecialchars($fileName) . ".<br>";
            }
        }
    } else {
        echo "Aucun fichier n'a été sélectionné.";
    }

        // Redirige vers la page précédente

        // echo '<meta http-equiv="refresh" content="0;url= '.$_SERVER['HTTP_REFERER'].'">';
    
}
?>
