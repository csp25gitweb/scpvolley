
var compteurTel = 0;

function ad_sameInfoContact(){
    if(document.getElementById('ad_sameInfo').checked){
        document.getElementById('ad_contact_nom').value = document.getElementById('ad_nom').value;
        document.getElementById('ad_contact_prenom').value = document.getElementById('ad_prenom').value;
    }
    else{
        document.getElementById('ad_contact_nom').value = "";
        document.getElementById('ad_contact_prenom').value = "";
    }
}


function ad_contact_ajoutTel(){
    compteurTel++;
    
    var label = document.createElement('label');
    label.setAttribute('name', 'contact_numero_tel_'+compteurTel);
    
    var p = document.createElement('p');
    p.innerHTML = 'Téléphone';
    
    var inputText = document.createElement('input');
    inputText.setAttribute('name', 'ad_contact_tel_'+compteurTel);
    inputText.setAttribute('id', 'ad_contact_tel_'+compteurTel);
    
    var inputButton = document.createElement('input');
    inputButton.setAttribute('type', 'button');
    inputButton.setAttribute('value', 'Supprimer');
    inputButton.setAttribute('onclick', 'ad_contact_supprTel("contact_div_tel_'+compteurTel+'");return;');

    label.appendChild(p);
    label.appendChild(inputText);
    label.appendChild(inputButton);
    
    var parent = document.getElementById('contact_liste_tel');
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id', 'contact_div_tel_'+compteurTel);
    newdiv.appendChild(label);
    parent.appendChild(newdiv);
}

function ad_contact_supprTel(div){
    var child = document.getElementById(div);
    child.parentNode.removeChild(child);
}