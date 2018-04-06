
var compteurTel = 0;
var compteurEmail = 0;


function processAdherent(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('ad_recap').innerHTML = this.responseText;
            document.getElementById('ad_recap').style.display = 'block';
            var top = document.getElementById('ad_recap').offsetTop;
            window.scrollTo(0, top);
            document.getElementById('ad_form').reset();
        }
    };
    
    var formulaire = new FormData( document.getElementById('ad_form') );
    
    xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=process", true);
    xhttp.send(formulaire);
 }
 
 function chargerAdherent(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('ad_modification').innerHTML = this.responseText;
            document.getElementById('ad_modification').style.display = 'block';
        }
    };
    
    if(document.getElementById('id_adherent').value == -1){
        document.getElementById('ad_modification').style.display = 'none';
    }
    else{
        xhttp.open("POST", "index.php?controller=admin&action=adherent&entry=get&id_adherent="+document.getElementById('id_adherent').value, true);
        xhttp.send();
    }
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