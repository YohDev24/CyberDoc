<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $action = $_GET['action'];
    echo("<h1> $file et $action </H1>");
    // foreach($_SERVER as $key => $value)
    // {
    //     echo "<p>$key  valeur : $value <P>";
    // }
    // Chargez et affichez le contenu approprié basé sur le fichier

    if(strpos($action,"-"))
    {
        $strSetting = explode('-',$action);
        if (isset($strSetting[0]) && isset($strSetting[1])) {
            $action = strtoupper($strSetting[0]);
            $strSetting = strtoupper($strSetting[1]);
        }
    }

switch(strtoupper($action)){
case 'VISU':
getVisu($file);
break;

case 'DEL':
getsup($file);
break;

case 'LINK':
    echo "<p>en cours de création </p>";
break;

case 'SETTING':
    getSetting($strSetting);
    break;
default:
echo"<p>une erreur est survenue</p>";
break;
}
    // Génération du tableau HTML

}


function getVisu($file){

   
    $host = $_SERVER['HTTP_REFERER'];
    $relativePath = "$host/AllFiles/$file";
    $extention = pathinfo($file);
    $extention = strtolower($extention['extension']);

    switch ($extention){
            case 'pdf':
            case 'txt':
                echo ' <iframe src="'.$relativePath.'" width="100%" height="600px">
                Votre navigateur ne peut pas afficher les PDF. <a href="image.pdf">Téléchargez le PDF</a>.
            </iframe>'; 
            break;
            case 'doc':
            case 'docx':
                echo ( '<h1>Impossible de visionné les documents Words <h1>');
                break;
        case 'jpg':
            echo ' <div class="image-container">
            <img src="'.$relativePath.'" alt="Image description">
            </div>';
            break;

            default:
            echo("<h1> '$extention' non pris en compte, Contact Dev<h1>") ;
            break;
    } 
}

function getsup($fileToDelete)
{
    // <!-- Boutons Oui/Non -->

   echo "<h2>Êtes-vous sûr de vouloir supprimer le fichier $fileToDelete </h2>
    <div class='modal-buttons'>";
    echo "<a onclick='removeFileJS(\"$fileToDelete\")'>Oui</a>";
    echo "<a onclick='closeModal()' class='no'>Non</a></div>";
    
}

function getSetting($action){
        // config pour modifier le menu s
    if($action == "MENU"){
    $subCategory = [];

// Tableau pour les sous-catégories
$sous_categories = [
    ['id' => 1, 'titre' => 'Sous-catégorie 1'],
    ['id' => 2, 'titre' => 'Sous-catégorie 2'],
    ['id' => 3, 'titre' => 'Sous-catégorie 3']
];

    
    // récupération des catégorie et sub-category 
    $directory = __DIR__ . '/AllFiles'; // Assurez-vous que ce chemin est correct
    if (file_exists($directory) && is_dir($directory)) 
    {
        // Utiliser scandir pour lister les fichiers et dossiers
        $categorys = scandir($directory);
    }

echo "<h1>Catégorie :</h1>";
echo "<table border='1' style='width:50%; border-collapse:collapse; margin:auto;'>
        <thead>
            <tr>
                <th>categorie</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>";

// Boucle pour remplir le tableau des catégories
foreach ($categorys as $categorie) {
    if($categorie != ".." && $categorie != "."):
    $subCates = scandir($directory.'/'.$categorie);
        foreach($subCates as $subCate)
        {
            if($subCate != ".." && $subCate != "."):
                $subCategory[] = ["category" => $categorie, "subcategory" => $subCate] ;
            endif;
        }
    echo "<tr>
            <td>" . htmlspecialchars($categorie) . "</td>
            <td>
                <form action='delete.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $categorie . "'>
                    <button type='submit'>Supprimer</button>
                </form>
            </td>
          </tr>";
    endif;
}
// button nouveau a GERR
echo"<tr> 
<td><input type='text' id='textbox' name='textbox' value=''><td>
<button> nouveau</bouton>
</tr>";


echo "</tbody>
    </table>";

echo "<h1>Sous-catégorie :</h1>";
echo "<table border='1' style='width:50%; border-collapse:collapse; margin:auto;'>
        <thead>
            <tr>
                <th>Dossier Racine</th>
                <th>sous-categorie</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>";

// Boucle pour remplir le tableau des sous-catégories
foreach ($subCategory as $sous_categorie) {
    echo "<tr>
            <td>" . htmlspecialchars($sous_categorie['category']) . "</td>
            <td>" . htmlspecialchars($sous_categorie['subcategory']) . "</td>
            <td>
                <form action='delete.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $sous_categorie['category'] . "'>
                    <button type='submit'>Supprimer</button>
                </form>
            </td>
          </tr>";
}

// button nouveau a GERR
echo"<tr> 
<td>";
echo "<select id='comboBox' name='comboBox'>";

foreach ($categorys as $key => $categorie) {
    if($categorie != ".." && $categorie != "."):
    echo "<option value='" . htmlspecialchars($key) . "'>" . htmlspecialchars($categorie) . "</option>";
    endif;
}

echo "</select>";   
echo"</td>
<td><input type='text' id='textbox' name='textbox' value=''></td>
<td><button> nouveau</bouton></td>
</tr>"; 

echo "</tbody>
    </table>";
    }

    //config pour affiche le calendrier 

    // voir si j'en fait un pour les notes 
}