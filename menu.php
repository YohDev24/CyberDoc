<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Fichiers</title>
    <link rel="stylesheet" href="cssEtScript/style.css">
</head>
<body>
    <?php
    // récupération des catégorie et sub-category 

    $directory = __DIR__ . '/AllFiles'; // Assurez-vous que ce chemin est correct
    if (file_exists($directory) && is_dir($directory)) {
        // Utiliser scandir pour lister les fichiers et dossiers
        $categorys = scandir($directory);
   ?>

   <!-- Menu -->
<div class="menu-container">
        <div class="menu">
            <?php foreach ( $categorys as $category): ?>
                <?php if($category != ".." && $category != "."): ?>
                <div class="menu-item">
                    <?php echo $category; ?>
                    <?php $subcategories = scandir( __DIR__ . '/AllFiles/'.$category);	?>
                    <?php if (!empty($subcategories)): ?>
                        <div class="submenu">
                            <?php foreach ($subcategories as $subcategory): ?>
                                <?php if($subcategory != ".." && $subcategory != "."): ?>
                                <div onclick="loadFileJS(this)" id="<?php echo ($category."-".$subcategory);?>"  class="submenu-item" data-subcategory="<?php echo $subcategory; ?>">
                                    <?php echo $subcategory; ?>
                                </div>
                                <?php endif; ?> 
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endif;?>
            <?php endforeach; ?>

            <div class="menu-right">
            <img id="infoIcon" src="https://cdn-icons-png.flaticon.com/512/3524/3524636.png" alt="info" onclick="toggleTextArea()" class="small-icon"/>
            </div>


        </div>
     
    </div>

    
   <?php
    }
   ?>
    

</body>
</html>
