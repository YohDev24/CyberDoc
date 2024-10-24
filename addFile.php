<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload avec Drag & Drop</title>
    <link rel="stylesheet" href="cssEtScript/addfile.css">
    <link rel="stylesheet" href="cssEtScript/style.css">
    <link rel="stylesheet" href="cssEtScript/styleTab.css">
    <link rel="stylesheet" href="cssEtScript/styleModal.css">
    <link rel="stylesheet" href="cssEtScript/styleMenu.css">
</head>
<body>
<?php 
$path = $_POST["dossier"];
?>

    <!-- menu personnaliser pour return -->
    <div class="menu-container drop-area">
        <div class="menu">
            <div class="menu-item" onclick="redirection()" ;="">retour</div>
        </div>
    </div>
    <div class="container">

        <h1 id="idpath"><?php echo $path;?></h1>
        <form action="upload-js.php" method="POST" enctype="multipart/form-data">
        <div class="drop-zone" id="drop-zone">
            Glissez et déposez vos fichiers ici ou <span style="color: blue; text-decoration: underline;">cliquez pour choisir</span>.
            <input type="file" id="fileInput" name="file[]" multiple style="display: none;">
        </div>
        <ul class="file-list" id="fileList"></ul>

        <!-- Champ caché pour envoyer la valeur de $path -->
        <input type="hidden" id="dossier" name="dossier" value="<?php echo htmlspecialchars($path); ?>">
        <input type="submit" id="uploadBtn" class="btn-add-file" value="Uploader les fichiers">
    </form>

        <!-- Barre de progression -->
        <div class="progress-bar-container">
        <div id="progress-bar" class="progress-bar"></div>
    </div>

    <!-- Affichage de la réponse du serveur -->
    <div id="response"></div>

        <br>

    </div>


<script src=" cssEtScript\script.js"></script>

<script>
        // Récupération des éléments du DOM
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        // Empêcher le comportement par défaut de drag & drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => e.preventDefault());
            dropZone.addEventListener(eventName, (e) => e.stopPropagation());
        });

        // Ajouter des classes visuelles lorsque les fichiers survolent la zone
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('drop-zone--over'));
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('drop-zone--over'));
        });

        // Clique sur la zone déclenche l'ouverture de l'input file
        dropZone.addEventListener('click', () => fileInput.click());

        // Ajout des fichiers via l'input file
        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        // Ajout des fichiers via le drag and drop
        dropZone.addEventListener('drop', (e) => {
            let files = e.dataTransfer.files;
            fileInput.files = files; // Remplacer les fichiers du champ input
            handleFiles(files);
        });

        // Fonction pour gérer et afficher les fichiers
        function handleFiles(files) {
            fileList.innerHTML = ''; // On réinitialise la liste
            Array.from(files).forEach(file => {
                const li = document.createElement('li');
                li.textContent = `${file.name} (${Math.round(file.size / 1024)} KB)`;
                fileList.appendChild(li);
            });
        }


        document.getElementById('uploadBtn').addEventListener('click', function(e) {
    e.preventDefault(); // Empêche le formulaire de se soumettre normalement

    let form = document.querySelector('form');
    let formData = new FormData(form);

    // Envoie des données via AJAX avec XMLHttpRequest
    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'upload-js.php', true);

    // On écoute les changements d'état de la requête
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Affiche la réponse du serveur
            const regex = /\(([^)]+)\)/;  // Regex pour capturer ce qui est entre parenthèses
            let result = xhr.responseText.match(regex);
            result = result[1].replace(/\//g, "-");
            sessionStorage.setItem('message', result);
         
            setTimeout(() => {
                window.location.href = "index.php";
            }, 2000);


        }
    };

    // Gestion de la progression du fichier
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            let percentComplete = (e.loaded / e.total) * 100;
            document.getElementById('progress-bar').style.width = percentComplete + '%';
        }
    };

    // Envoie les données du formulaire
    xhr.send(formData);
});
    </script>
</body>
</html>
