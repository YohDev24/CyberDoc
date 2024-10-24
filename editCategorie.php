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
            <div class="menu-item" onclick="redirection()";>retour</div>
        </div>
    </div>

    <div>

        <?php
        // récupération des catégorie et sub-category 
        $directory = __DIR__ . '/AllFiles'; // Assurez-vous que ce chemin est correct
        if (file_exists($directory) && is_dir($directory)) {
            // Utiliser scandir pour lister les fichiers et dossiers
            $categorys = scandir($directory);
        }

        ?>

        <h1>Catégorie :</h1>
        <table border='1' style='width:50%; border-collapse:collapse; margin:auto;'>
            <thead>
                <tr>
                    <th>categorie</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Boucle pour remplir le tableau des catégories
                foreach ($categorys as $categorie) {
                    if ($categorie != ".." && $categorie != "."):
                        $subCates = scandir($directory . '/' . $categorie);

                        

                        foreach ($subCates as $subCate) {
                            if ($subCate != ".." && $subCate != "."):
                                $subCategory[] = ["category" => $categorie, "subcategory" => $subCate];
                            endif;
                        } ?>


                        <tr>
                            <td><?php echo $categorie; ?></td>
                            <td>
                                <form action='update-js.php' method='POST' id='form_DelCate_<?php  echo $categorie;  ?>' style='display:inline;' onsubmit="veriform(event)">
                                    <input type='hidden' require='required' name="cate" id="cate" value='<?php echo $categorie;  ?>'>
                                    <input type="hidden" require='required' name="action" id="action" value="DEL_CATE" >
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    endif;
                } ?>

                <tr>
                    <form action='update-js.php' method='POST' id="form_AddCate" style='display:inline;' onsubmit="veriform(event)" >
                        <td><input type='text' id='textbox' name='textbox' value=''></td>
                        <input type="hidden" require='required' name="action" id="action" value="ADD_CATE" >

                        <td><button type='submit'> nouveau</bouton>
                        </td>
                    </form>

                </tr>

            </tbody>
        </table>

        <h1>Sous-catégorie :</h1>
        <table border='1' style='width:50%; border-collapse:collapse; margin:auto;'>
            <thead>
                <tr>
                    <th>Dossier Racine</th>
                    <th>sous-categorie</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!isset($subCategory)) {
                    $subCategory = null;
                }
                
                if($subCategory != null ) {
                foreach ($subCategory as $sous_categorie) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sous_categorie['category']) ?></td>
                        <td><?php echo  htmlspecialchars($sous_categorie['subcategory']) ?></td>
                        <td>
                            <form action='update-js.php'  method='POST' id='form_DelSubCate_<?php  echo $sous_categorie['subcategory'];  ?>'  style='display:inline;' onsubmit="veriform(event)">
                            <input type='hidden' require='required' name="cate" id="cate" value='<?php echo $sous_categorie['subcategory']; ?>'>
                            <input type="hidden" require='required' name="srcCate" id="srcCate" value="<?php echo $sous_categorie['category']; ?>" >

                            <input type="hidden" require='required' name="action" id="action" value="DEL_SUBCATE" >
                            <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php }
                } ?>
                <tr>
                <form action='update-js.php' method='POST' id="form_AddSubCate" style='display:inline;' onsubmit="veriform(event)" >

                    <td>
                        <select id='srcCate' name='srcCate'>
                            <?php
                            foreach ($categorys as $key => $categorie) {
                                if ($categorie != ".." && $categorie != "."):
                                    echo "<option value='" .  htmlspecialchars($categorie) . "'>" . htmlspecialchars($categorie) . "</option>";
                                endif;
                            } ?>

                        </select>
                    </td>
                        <td><input type='text' id='textboxSub' name='textboxSub' value=''></td>
                        <input type="hidden" require='required' name="action" id="action" value="ADD_SUBCATE" >
                        <td><button type='submit'> nouveau</bouton>
                        </td>
                    </form>

                </tr>

            </tbody>
        </table>
    </div>


    <script src=" cssEtScript\script.js"></script>

</body>

</html>