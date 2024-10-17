<?php 

$category = $_POST["subCate"];
$path = __DIR__ . '/AllFiles/'.$category;
$files = scandir($path);
// faire genre un petit b   outtotn a droit ou autre qui fiare prense bêtre ou mettre les différents site a consultaer genre tools 
https://www.bestcours.com/programmation/
// Exemple de données à afficher dans la table (peut être récupéré d'une base de données)   
// Début de la table HTML


echo '   <div class="tableau">';
echo '     <button class="btn-add-file" onclick="ajouterFichier()">Ajouter un Fichier</button>';
echo '       </div>';
echo '<table border="1" cellpadding="10" cellspacing="0">';
echo '<thead>';
echo '<tr>';
echo '<th>Titre</th>';
echo '<th>Date de création</th>';
echo '<th>Type</th>';
echo '<th>Visualisation</th>';
echo '<th>Suppression</th>';
echo '<th>Partage</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Boucle pour afficher chaque ligne du tableau de fichiers
foreach ($files as $file) {
 if($file != ".." && $file != "."): 
    $timestamp = filemtime($path ."/".$file);
    echo '<tr>';
    echo '<td>' . htmlspecialchars($file).'</td>';
    echo '<td>' . htmlspecialchars(date("d-m-Y H:i:s", $timestamp)) .'</td>';
    echo '<td>' . htmlspecialchars( getFileType($file)). '</td>';
    
    // Colonne de visualisation (par exemple, un lien vers la page de visualisation)
    echo '<td style="text-align: center; vertical-align: middle;">
    <a href='.$path.'/'.$file.' onclick="openModal(\''. urlencode($category.'/'.$file) .'\',\'visu\')">
        <img src="https://cdn-icons-png.flaticon.com/512/159/159604.png" alt="Voir" style="width: 20px; height: 20px;">
    </a>
</td>';

    // Bouton de suppression
    echo '<td style="text-align: center; vertical-align: middle;">
    <a href='.$path.'/'.$file.' onclick="openModal(\''. urlencode($category.'/'.$file) .'\',\'del\')">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828774.png" alt="Voir" style="width: 20px; height: 20px;">
    </a>
</td>';    
    // Bouton de partage
    // echo '<td><a href="share.php?file=' . urlencode($file['titre']) . '">Partager</a></td>';
    echo '<td style="text-align: center; vertical-align: middle;">
    <a href='.$path.'/'.$file.' onclick="openModal(\''. urlencode($category.'/'.$file) .'\',\'link\')">
        <img src="https://cdn-icons-png.flaticon.com/512/929/929539.png" alt="Voir" style="width: 20px; height: 20px;">
    </a>
</td>';    

endif;
}

echo '</tbody>';
echo '</table>';





function getFileType($file) {
    // Récupérer l'extension du fichier
    $fileInfo = pathinfo($file);
    $extension = strtolower($fileInfo['extension']); // Extension en minuscule pour uniformiser

    // Associer les extensions aux types de documents
    $types = [
        // Documents texte
        'txt'  => 'Fichier Texte',
        'doc'  => 'Document Word',
        'docx' => 'Document Word',
        'pdf'  => 'Document PDF',
        'odt'  => 'Document OpenDocument',
        'rtf'  => 'Rich Text Format',
        'tex'  => 'Document LaTeX',
        'wpd'  => 'Document WordPerfect',
    
        // Feuilles de calcul
        'xls'  => 'Feuille de calcul Excel',
        'xlsx' => 'Feuille de calcul Excel',
        'ods'  => 'Feuille de calcul OpenDocument',
    
        // Présentations
        'ppt'  => 'Présentation PowerPoint',
        'pptx' => 'Présentation PowerPoint',
        'odp'  => 'Présentation OpenDocument',
    
        // Images
        'jpg'  => 'Image JPEG',
        'jpeg' => 'Image JPEG',
        'png'  => 'Image PNG',
        'gif'  => 'Image GIF',
        'bmp'  => 'Image Bitmap',
        'tiff' => 'Image TIFF',
        'svg'  => 'Image SVG',
    
        // Archives
        'zip'  => 'Archive ZIP',
        'rar'  => 'Archive RAR',
        '7z'   => 'Archive 7-Zip',
        'tar'  => 'Archive TAR',
        'gz'   => 'Archive Gzip',
    
        // Fichiers audio
        'mp3'  => 'Fichier audio MP3',
        'wav'  => 'Fichier audio WAV',
        'ogg'  => 'Fichier audio Ogg',
        'flac' => 'Fichier audio FLAC',
        'aac'  => 'Fichier audio AAC',
        'm4a'  => 'Fichier audio M4A',
    
        // Fichiers vidéo
        'mp4'  => 'Fichier vidéo MP4',
        'avi'  => 'Fichier vidéo AVI',
        'mkv'  => 'Fichier vidéo MKV',
        'mov'  => 'Fichier vidéo QuickTime',
        'wmv'  => 'Fichier vidéo Windows Media',
        'flv'  => 'Fichier vidéo Flash',
        'webm' => 'Fichier vidéo WebM',
    
        // Fichiers de code source
        'php'  => 'Fichier PHP',
        'html' => 'Fichier HTML',
        'css'  => 'Fichier CSS',
        'js'   => 'Fichier JavaScript',
        'py'   => 'Fichier Python',
        'java' => 'Fichier Java',
        'cpp'  => 'Fichier C++',
        'c'    => 'Fichier C',
        'rb'   => 'Fichier Ruby',
        'swift'=> 'Fichier Swift',
        'go'   => 'Fichier Go',
    
        // Fichiers de bases de données
        'sql'  => 'Fichier SQL',
        'db'   => 'Fichier Base de données',
        'mdb'  => 'Fichier Access Database',
        'sqlite'=> 'Fichier SQLite',
    
        // Fichiers de configuration
        'ini'  => 'Fichier de configuration INI',
        'cfg'  => 'Fichier de configuration',
        'json' => 'Fichier JSON',
        'xml'  => 'Fichier XML',
        'yaml' => 'Fichier YAML',
    
        // Fichiers systèmes
        'exe'  => 'Fichier exécutable Windows',
        'bat'  => 'Fichier batch Windows',
        'sh'   => 'Fichier script shell',
        'dll'  => 'Bibliothèque dynamique Windows',
        'sys'  => 'Fichier système Windows',
    
        // Autres
        'iso'  => 'Image ISO',
        'dmg'  => 'Image disque macOS',
        'torrent' => 'Fichier torrent',
    ];

    // Retourner le type de fichier ou "Inconnu" si l'extension n'est pas dans la liste
    return $types[$extension] ?? 'Type de fichier inconnu';
}

?>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modal-body">
            <!-- Le contenu chargé via AJAX apparaîtra ici -->
        </div>
    </div>
</div>


