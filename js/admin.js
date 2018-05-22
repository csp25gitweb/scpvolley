//listeners
(function( $ ) {
    
    $('#ad_id_nouveau').on('click', function(){
        nouvelAdherent();
    });

    $('#id_adherent').on('change', function(){
        chargerAdherent();
    });
    
    $('#contact_id_adherent').on('change', function(){
        listeContacts(); 
    });
    
    $('#id_equipe').on('change', function(){
        chargerEquipe();
    });
    
    $('#eq_match_valider').on('click', function(){
        ajouterMatch();
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
                
                $('#ad_delete').on('click', function(){
                    $.showModal("Supprimer adhérent", "Êtes-vous sur(e) de vouloir supprimer cet adhérent ?", "Annuler", "deleteAdherent");
                });
            }
        };

        $('#ad_modification').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#ad_modification').show();

        xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=get&id_adherent="+ $('#id_adherent').val(), true);
        xhttp.send();
    }
}

function nouvelAdherent(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            $('#ad_modification').html(this.responseText);
            $('#ad_valider').on('click', function(){
                recapAjoutAdherent();
            });
            
            $('#id_adherent').val('-1');
        }
    };

    $('#ad_modification').html("<img src='images/loading_spinner.gif' alt='chargement'>");
    $('#ad_modification').show();

    xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=get&id_adherent=-1", true);
    xhttp.send();
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
    
    
    $.showModal("Ajouter adhérent", recap, "Modifier", "processAdherent");
}


function deleteAdherent(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText.indexOf("isok") != -1){
                $.hideModal();
                $.showNotify('success', 'Adhérent supprimé avec succès.');
                
                setTimeout(location.reload.bind(location), 2000);
            }
        }
    };
    
    xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=delete&id_adherent="+$('#id_adherent').val(), true);
    xhttp.send();
}

function processAdherent(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {

            $.hideModal();
            $.showNotify('success', 'Adhérent ajouté/modifié avec succès.');
            
            setTimeout(location.reload.bind(location), 2000);
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
                $('#contact_id_nouveau').on('click', function(){
                    nouveauContact();
                });
            }
        };

        $('#id_listeContacts').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#id_listeContacts').show();

        xhttp.open("POST", "index.php?controller=admin&action=contact&entry=getListeContacts&id_adherent="+$('#contact_id_adherent').val(), true);
        xhttp.send();
    }
}


 function nouveauContact(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            $('#div_contact').html(this.responseText);
            
            $('#contact_id_id_adherent').val($('#contact_id_adherent').val());

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

    xhttp.open("POST",  "index.php?controller=admin&action=contact&entry=getContact&id_contact=-1", true);
    xhttp.send();
    
    $('#contact_id_contact').val('-1');
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
                
                $('#contact_delete').on('click', function(){
                    $.showModal("Supprimer contact", "Êtes-vous sur(e) de vouloir supprimer ce contact ?", "Annuler", "deleteContact");
                });
                
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

function deleteContact(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText.indexOf("isok") != -1){
                $.hideModal();
                $.showNotify('success', 'Contact supprimé avec succès.');
                
                document.getElementById('contact_form').reset();
                listeContacts();
            }
        }
    };
    
    xhttp.open("POST", "index.php?controller=admin&action=contact&entry=delete&id_contact="+$('#contact_id_contact').val(), true);
    xhttp.send();
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
    
    
    $.showModal("Ajouter contact", recap, "Modifier", "processContact");
}


function processContact(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText.indexOf("isok") != -1){
                $.hideModal();
                $.showNotify('success', 'Contact ajouté/modifié avec succès.');
                
                document.getElementById('contact_form').reset();
                listeContacts();
            }
        }
    };
    
    var formulaire = new FormData( document.getElementById('contact_form') );
    
    xhttp.open("POST", "index.php?controller=admin&action=contact&entry=process", true);
    xhttp.send(formulaire);
}



function contactAjoutChamp(nom, suffixe){
    
    compteur = document.getElementById('contact_'+suffixe+'Nb').value
    
    var span_1 = document.createElement('span');
    span_1.setAttribute('class', 'col-lg-6');
    
    var inputText = document.createElement('input');
    inputText.setAttribute('name', 'contact_'+suffixe+'_'+compteur);
    inputText.setAttribute('id', 'contact_'+suffixe+'_'+compteur);
    inputText.setAttribute('class', 'form-control');
    
    span_1.appendChild(inputText);
    
    
    var span_2 = document.createElement('span');
    span_2.setAttribute('class', 'col-lg-3');
    
    var inputButton = document.createElement('input');
    inputButton.setAttribute('type', 'button');
    inputButton.setAttribute('value', 'Supprimer');
    inputButton.setAttribute('class', 'btn btn-primary');
    inputButton.setAttribute('onclick', 'contactSupprDiv("contact_div_'+suffixe+'_'+compteur+'");return;');

    span_2.appendChild(inputButton);
    
    var parent = document.getElementById('contact_liste_'+suffixe);
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id', 'contact_div_'+suffixe+'_'+compteur);
    
    //newdiv.appendChild(span_1);
    newdiv.appendChild(span_1);
    newdiv.appendChild(span_2);
    parent.appendChild(newdiv);
    
    compteur++;
    document.getElementById('contact_'+suffixe+'Nb').value = compteur;
}

    function contactSupprDiv(div){
    var child = document.getElementById(div);
    
    if(child.children[0].type == 'hidden'){
        var xhttp = new XMLHttpRequest();
        if(child.children[0].name.indexOf("courriel") != -1 ){
            xhttp.open("POST", "index.php?controller=admin&action=contact&entry=delEma&delid="+child.children[0].value, true);
        }
        else{
            xhttp.open("POST", "index.php?controller=admin&action=contact&entry=delTel&delid="+child.children[0].value, true); 
        }
    
        xhttp.send();
    }
    
    child.parentNode.removeChild(child);
}


/******************************************************************/
function chargerEquipe(){
     
    if($('#id_equipe').val() == -1){
        $('#div_listeEquipe').hide();
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                $('#div_listeEquipe').html(this.responseText);
                
                $('#eq_add_player').on('click', function(){
                    ajouterJoueur();
                });
                
                $('#eq_valider').on('click', function(){
                    //TODO
                });
            }
        };

        $('#div_listeEquipe').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#div_listeEquipe').show();

        xhttp.open("POST", "index.php?controller=admin&action=equipe&entry=get&id_equipe="+ $('#id_equipe').val(), true);
        xhttp.send();
    }
}

function ajouterJoueur(){
    
    if( $('#eq_id_equipe').val() > 0 && $('#id_adherent').val() > 0){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                $.showNotify('success', "Joueur(se) ajouté à l'équipe avec succès.");
                chargerEquipe();
            }
        };

        xhttp.open("POST", "index.php?controller=admin&action=equipe&entry=add&id_equipe="+ $('#eq_id_equipe').val()+"&id_adherent="+$('#id_adherent').val(), true);
        xhttp.send();
        
        $('#div_listeEquipe').html("<img src='images/loading_spinner.gif' alt='chargement'>");
        $('#div_listeEquipe').show();
    }
}

function supprimerJoueur(id_adherent){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            $.showNotify('success', "Joueur(se) retiré de l'équipe avec succès.");
            chargerEquipe();
        }
    };

    xhttp.open("POST", "index.php?controller=admin&action=equipe&entry=delpla&id_equipe="+ $('#eq_id_equipe').val()+"&id_adherent="+id_adherent, true);
    xhttp.send();

    $('#div_listeEquipe').html("<img src='images/loading_spinner.gif' alt='chargement'>");
    $('#div_listeEquipe').show();
}


function ajouterMatch(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            $.showNotify('success', "Match ajouté au calendrier avec succès.");
        }
    };

    xhttp.open("POST", "index.php?controller=admin&action=equipe&entry=addmat&id_equipe="+ $('#eq_id_equipe').val()+"&eq_date="+$('#eq_match_date').val()+"&eq_hour="+$('#eq_match_heure').val(), true);
    xhttp.send();
}