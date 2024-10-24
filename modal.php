<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $action = $_GET['action'];
    echo ("<h1> $file et $action </H1>");
    // foreach($_SERVER as $key => $value)
    // {
    //     echo "<p>$key  valeur : $value <P>";
    // }
    // Chargez et affichez le contenu approprié basé sur le fichier

    if (strpos($action, "-")) {
        $strSetting = explode('-', $action);
        if (isset($strSetting[0]) && isset($strSetting[1])) {
            $action = strtoupper($strSetting[0]);
            $strSetting = strtoupper($strSetting[1]);
        }
    }

    switch (strtoupper($action)) {
        case 'VISU':
            getVisu($file);
            break;
        case 'LINK':
            echo "<p>en cours de création </p>";
            break;
        case 'DEL':
            echo("<p>ceci est un test de morts sa se trouve </p>");
            break;
        case 'SETTING':
            getSetting($strSetting);
            break;
        default:
            echo "<p>une erreur est survenue</p>";
            break;
    }
    // Génération du tableau HTML

}


function getVisu($file)
{


    $host = $_SERVER['HTTP_REFERER'];
    $relativePath = "$host/AllFiles/$file";
    $extention = pathinfo($file);
    $extention = strtolower($extention['extension']);

    switch ($extention) {
        case 'pdf':
        case 'txt':
            echo ' <iframe src="' . $relativePath . '" width="100%" height="600px">
                Votre navigateur ne peut pas afficher les PDF. <a href="image.pdf">Téléchargez le PDF</a>.
            </iframe>';
            break;
        case 'doc':
        case 'docx':
            echo ('<h1>Impossible de visionné les documents Words <h1>');
            break;
        case 'jpg':
            echo ' <div class="image-container">
            <img src="' . $relativePath . '" alt="Image description">
            </div>';
            break;

        default:
            echo ("<h1> '$extention' non pris en compte, Contact Dev<h1>");
            break;
    }
}

function getSetting($action)
{
    // config pour modifier le menu s
  
    if($action == "HELP")
    {

    }
    if($action == "projet")
    {

    }
    //config pour affiche le calendrier 

    // voir si j'en fait un pour les notes 
}
