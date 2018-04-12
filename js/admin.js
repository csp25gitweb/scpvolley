//listeners
(function( $ ) {

    $('#ad_valider').on('click', function(){
        recapAjoutAdherent();
    });

    $('#id_adherent').on('change', function(){
        chargerAdherent();
    });
    
    $('#contact_id_adherent').on('change', function(){
        listeContacts(); 
    });
    
})( jQuery );


/******************************************************************/
var compteurTel = 0;
var compteurEmail = 0;

 function chargerAdherent(){
     
    if($('#id_adherent').val() == -1){
        $('#ad_modification').hide();
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                $('#ad_modification').html(this.responseText);
                $('#ad_valider').on('click', function(){
                    recapAjoutAdherent();
                });
            }
        };

        $('#ad_modification').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#ad_modification').show();

        xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=get&id_adherent="+ $('#id_adherent').val(), true);
        xhttp.send();
    }
}

function recapAjoutAdherent(){
    
    var recap = "<fieldset>";
    recap += "<legend>Récapitulatif</legend>";

    recap += "<h4>Rappel des informations</h4>";
    recap += "<br/>Nom : " + $("#ad_nom").val();
    recap += "<br/>Prénom : " + $("#ad_prenom").val();
    recap += "<br/>Date de naissance : " + $("#ad_naissance").val();
    recap += "<br/>Genre : " + $("#ad_genre").val();
    recap += "<br/>Numéro de licence : " + $("#ad_licence").val();
    recap += "</fieldset>";
    
    
    $.showModal("Ajouter adhérent", recap, "Modifier", "processAdherent()");
}

function processAdherent(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('ad_form').reset();
        }
    };
    
    var formulaire = new FormData( document.getElementById('ad_form') );
    
    xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=process", true);
    xhttp.send(formulaire);
 }



/******************************************************************/
 function listeContacts(){
     
    if($('#contact_id_adherent').val() == -1){
        $('#id_listeContacts').hide();
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                $('#id_listeContacts').html(this.responseText);
                $('#contact_id_contact').on('change', function(){
                    chargerContact();
                });
            }
        };

        $('#id_listeContacts').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#id_listeContacts').show();

        xhttp.open("POST", "index.php?controller=admin&action=contact&entry=getListeContacts&id_adherent="+$('#contact_id_adherent').val(), true);
        xhttp.send();
     }
 }


function chargerContact(){
    
    if($('#contact_id_contact').val() == -1){
        $('#div_contact').hide();
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                $('#div_contact').html(this.responseText);
                
                $('#contact_ajoutTel').on('click', function(){
                    contactAjoutChamp('Téléphone', 'tel');
                });

                $('#contact_ajoutEmail').on('click', function(){
                    contactAjoutChamp('Email', 'email');
                });
                
                $('#contact_valider').on('click', function(){
                    recapAjoutContact();
                });
            }
        };

        $('#div_contact').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#div_contact').show();

        xhttp.open("POST",  "index.php?controller=admin&action=contact&entry=getContact&id_contact="+$('#contact_id_contact').val(), true);
        xhttp.send();
    }
}


function recapAjoutContact(){
    
    var recap = "<fieldset>";
    recap += "<legend>Récapitulatif</legend>";

    recap += "<h4>Rappel des informations</h4>";
    recap += "<br/>Nom : " + $("#contact_nom").val();
    recap += "<br/>Prénom : " + $("#contact_prenom").val();
    recap += "<br/>Adresse : " + $("#contact_adresse").val();
    recap += "<br/>Code postal : " + $("#contact_cp").val();
    recap += "<br/>Ville : " + $("#contact_ville").val();
    recap += "</fieldset>";
    
    
    $.showModal("Ajouter contact", recap, "Modifier", "processContact()");
}


function processContact(){
    alert("Not yet implemented");
}






function contactAjoutChamp(nom, suffixe){
    var compteur = 1;
    if(suffixe == 'tel'){
        compteur = compteurTel++;
    }
    else if(suffixe == 'email'){
        compteur = compteurEmail++;
    }
    
    document.getElementById('contact_'+suffixe+'Nb').value = compteur+1;
    
    var label = document.createElement('label');
    label.setAttribute('name', 'contact_'+suffixe+'_'+compteur);
    
    var p = document.createElement('p');
    p.innerHTML = nom;
    
    var inputText = document.createElement('input');
    inputText.setAttribute('name', 'contact_'+suffixe+'_'+compteur);
    inputText.setAttribute('id', 'contact_'+suffixe+'_'+compteur);
    
    var inputButton = document.createElement('input');
    inputButton.setAttribute('type', 'button');
    inputButton.setAttribute('value', 'Supprimer');
    inputButton.setAttribute('onclick', 'contactSupprDiv("contact_div_'+suffixe+'_'+compteur+'");return;');

    label.appendChild(p);
    label.appendChild(inputText);
    label.appendChild(inputButton);
    
    var parent = document.getElementById('contact_liste_'+suffixe);
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id', 'contact_div_'+suffixe+'_'+compteur);
    newdiv.appendChild(label);
    parent.appendChild(newdiv);
}

function contactSupprDiv(div){
    var child = document.getElementById(div);
    child.parentNode.removeChild(child);
}