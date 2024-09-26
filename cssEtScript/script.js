function loadFileJS(htmlelement){
    var subcategory = htmlelement.getAttribute('data-subcategory');
    var parentCategoryElement = htmlelement.closest('.menu-item');
    var parentCategory = parentCategoryElement.childNodes[0].textContent.trim();



    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'loadFile.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  // Spécifie le type de contenu
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('file-list').innerHTML = xhr.responseText;
        } else {
            console.error('Erreur: ' + xhr.status);
        }
    };

    // Envoyer des données sous forme d'une chaîne encodée en URL
    xhr.send('subCate='+parentCategory+"/"+subcategory);

}

function removeFileJS(fileToDelete)
{
// récupéré les fichier et replace le / en - 
var pathParts = fileToDelete.split('/');
pathParts = pathParts.slice(0, 2).join('-');
let docHtml = document.getElementById(pathParts);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'removeFile.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  // Spécifie le type de contenu
    xhr.onload = function() {
        if (xhr.status === 200) {
            
            document.getElementById('modal-body').innerHTML = xhr.responseText;
            loadFileJS(docHtml);

        } else {
            console.error('Erreur: ' + xhr.status);
        }
    };


    // Envoyer des données sous forme d'une chaîne encodée en URL
    xhr.send('fileToRemove='+fileToDelete);

}

//#region  partie Modal
let currentElement = null;

// Fonction pour ouvrir la modale et charger le contenu via AJAX
function openModal(file,action) {

    
    var modal = document.getElementById("myModal");
    var modalBody = document.getElementById("modal-body");

    if(action.includes("setting-"))
    {
        
        modal = document.getElementById('myModalSetting');
        modalBody = document.getElementById("myModalSetting-body");
    }
    // Affiche la modale
    modal.style.display = "block";

    // Charge le contenu via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "modal.php?file=" + file+"&action="+action, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            modalBody.innerHTML = xhr.responseText;
        }
    };
    xhr.send();

      // Ajoute un écouteur pour la touche "Escape"
      document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });

    
}

// Fonction pour fermer la modale
function closeModal() {
    var modal = document.getElementById("myModal");
    if(!modal)
    {
        modal = document.getElementById('myModalSetting');
    }
    modal.style.display = "none";

  
}

// Ferme la modale si on clique à l'extérieur
window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.addEventListener('keydown', function(event) {
    if (event.key.toUpperCase() === "F" && event.ctrlKey && event.shiftKey) {
        toggleTextArea();
    }
});

// affiche checkbox Setting 
function toggleTextArea() {
    var textAreaDiv = document.getElementById("textAreaDiv");

    if (textAreaDiv) {
        // Si la div existe déjà, la réinitialiser
        
        document.getElementById('file-list').innerHTML = document.getElementById('saveInnerHTML').innerText; 
    } else {
        // Sauvegarder l'ancien contenu avant de remplacer
        
        document.getElementById('saveInnerHTML').innerText = document.getElementById('file-list').innerHTML;

        // Injecter le nouveau contenu avec le textarea
        document.getElementById('file-list').innerHTML = `
        <div id="textAreaDiv">
            <textarea id="myTextArea" rows="4" cols="50" placeholder="Écrivez ici..."></textarea>
        </div>`;

        // Ajouter l'event listener au textarea après qu'il soit ajouté au DOM
        var textArea = document.getElementById('myTextArea');
        textArea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const text = textArea.value;

                if (text.trim() !== "") {
                    // configuration
                        openModal("","setting-"+text);
                        toggleTextArea(); 
                } else {
                    alert('Le texte est vide. Veuillez entrer quelque chose.');
                }
            }
        });

        // Utiliser setTimeout pour garantir que l'élément est bien rendu avant le focus
        setTimeout(function() {
            textArea.focus();
        }, 100); // Petite attente de 100 ms pour s'assurer que l'élément est bien dans le DOM
    }
}

