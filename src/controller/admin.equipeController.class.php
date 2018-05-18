<?php

require_once('src/model/equipe.class.php');
require_once('src/model/categories.class.php');
require_once('src/model/adherent.class.php');

class adminEquipeController{
    
    public function __construct($smarty) {
        
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "list":
                $title = "Gestion équipe" . SITE_TITLE;
                
                $listeEquipes = equipe::findAll();
                
                $smarty->assign("title", $title);
                $smarty->assign('equipes', $listeEquipes);
                $smarty->Display('admin.equipe.liste.html');
            break;
        
            case "get":
                $this->chargerEquipe($smarty);
            break;
        
            case "add":
                $this->ajouterJoueur();
            break;
        
            case "delpla":
                $this->supprimerJoueur();
            break;
        
            case "addmat":
                $this->ajouterMatch();
            break;
        
            case "printAdd":
                $title = "Ajout équipe" . SITE_TITLE;
                
                $equipe = new equipe();
                
                $smarty->assign("title", $title);
                $smarty->assign("subtitle", 'Ajouter');
                $smarty->assign("equipe", $equipe);
                $smarty->Display('admin.equipe.add.html');
            break;
        
            case "process":
                $this->processEquipe($smarty);
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
    private function chargerEquipe($smarty){
        getParam('id_equipe', $id_equipe);
        $equipe = equipe::find($id_equipe);
        
        $categorie = categories::find($equipe->get_id_categorie());
        
        $adherents = adherent::findAllBetweenAge($categorie->get_age_debut(), $categorie->get_age_fin());
        
        $adherentsDansEquipe = adherent::findAllInTeam($id_equipe);
        
        $smarty->assign("equipe", $equipe);
        $smarty->assign("adherents", $adherents);
        $smarty->assign("adherentsDansEquipe", $adherentsDansEquipe);
        $smarty->Display('admin.equipe.form.html');
    }
    
    
    private function processEquipe($smarty){
        
    }
    
    private function ajouterJoueur(){
        
        getParam('id_equipe', $id_equipe);
        getParam('id_adherent', $id_adherent);
        
        $query = "INSERT INTO joue(id_adherent, id_equipe) VALUES(:id_adherent, :id_equipe)";
        $params = array(
            'id_adherent'=> $id_adherent,
            ':id_equipe' => $id_equipe
        );
        
        $bdd = postgresDAO::getInstance();
        $bdd->exec($query, $params);
        
        echo "isok " . $id_equipe . " "  . $id_adherent;
    }
    
    private function supprimerJoueur(){
        getParam('id_equipe', $id_equipe);
        getParam('id_adherent', $id_adherent);
        
        $query = "DELETE FROM joue WHERE id_adherent = :id_adherent AND id_equipe = :id_equipe";
        $params = array(
            'id_adherent'=> $id_adherent,
            ':id_equipe' => $id_equipe
        );
        
        $bdd = postgresDAO::getInstance();
        $bdd->exec($query, $params);
        
        echo "isok ";
    }
    
    private function ajouterMatch(){

        getParam('id_equipe', $id_equipe);
        getParam('eq_date', $eq_date);
        getParam('eq_hour', $eq_hour);
        
        $debut = $eq_date . " " . $eq_hour . ":00:00";
        $fin   = $eq_date . " " . ($eq_hour+2) . ":00:00";
        
        //Ajout dans table creneaux
        $query = "INSERT INTO creneaux(id_salle, debut, fin) VALUES('1', :debut, :fin)";
        $params = array(
            ':debut'=> $debut,
            ':fin' => $fin
        );
        
        $bdd = postgresDAO::getInstance();
        $bdd->exec($query, $params);
        
        //Ajout dans table matchs
        $id_creneau = $bdd->lastInsertId();
       
        $query = "INSERT INTO matchs(id_equipe_a, id_creneau, nom_equipe_b) VALUES(:id_equipe, :id_creneau, 'Adversaire')";
        $params = array(
            ':id_equipe'=> $id_equipe,
            ':id_creneau' => $id_creneau
        );

        $bdd->exec($query, $params);
        
        echo "isok";
    }
    
}


?>