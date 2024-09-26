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
    <?php include 'menu.php' ?>

    <div class="file-manager">
        <!-- Ici s'affichera le contenu de la sous-catégorie sélectionnée -->
         <!-- Conteneur principal de l'accueil -->
        <div id="file-list">
            <h1>Bienvenue dans l'espace Cybersécurité</h1>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <div class="circuit-line"></div>
            <!-- // menu setting -->
        </div>
    </div>


    </div>
    <!-- // SAVE last saveInnerHTML -->
    <div id="saveInnerHTML" style="display: none;"></div>
    <div id="myModalSetting" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="myModalSetting-body">
            <!-- Le contenu chargé via AJAX apparaîtra ici -->
        </div>
    </div>
</div>


<!-- //script    -->
    <script src="cssEtScript\script.js"></script>
</body>
</html>
