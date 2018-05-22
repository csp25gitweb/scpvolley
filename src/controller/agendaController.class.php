<?php

class agendaController extends AbstractController {
	
    public function __construct() {
        parent::__construct();
        
        $action = null;
        getParam("action", $action);
        
        switch($action){
        
            case "getAll":
                $this->getAll();
            break;
        
            case "get":
                $this->get();
            break;
        
            default:
                $this->smarty->Display('agenda.index.html');
            break;
        }
    }
   
    
    function get(){
      
    $id_equipe = null;
    getParam("id_equipe", $id_equipe);
        
      //equipe, adversaire, couleur, debut, fin
      $query = "SELECT e.nom, m.nom_equipe_b, e.couleur, c.debut, c.fin FROM creneaux c LEFT JOIN matchs m ON c.id_creneau = m.id_creneau LEFT JOIN equipes e ON m.id_equipe_a = e.id_equipe WHERE e.id_equipe = :id_equipe";
      $bdd = postgresDAO::getInstance();
      
      $params = array(':id_equipe' => $id_equipe);
      
      $bdd->exec($query, $params);
      
      $resultat = $bdd->fetchAll();
      $arrayJson = array();
      foreach ($resultat as $ligne){
          $array = array();
          $array["title"] = $ligne['nom'] . ' - ' . $ligne['nom_equipe_b'];
          $array["start"] = str_replace(' ', 'T', $ligne['debut']);
          $array["end"] = str_replace(' ', 'T', $ligne['fin']);
          $array["color"] = '#' . $ligne['couleur'];
          
          array_push($arrayJson, $array);
      }
      
      $json = json_encode($arrayJson);
      
      echo $json;
    }
    
    function getAll(){
      
      //equipe, adversaire, couleur, debut, fin
      $query = "SELECT e.nom, m.nom_equipe_b, e.couleur, c.debut, c.fin FROM creneaux c LEFT JOIN matchs m ON c.id_creneau = m.id_creneau LEFT JOIN equipes e ON m.id_equipe_a = e.id_equipe";
      $bdd = postgresDAO::getInstance();
      
      $bdd->exec($query);
      
      $resultat = $bdd->fetchAll();
      $arrayJson = array();
      foreach ($resultat as $ligne){
          $array = array();
          $array["title"] = $ligne['nom'] . ' - ' . $ligne['nom_equipe_b'];
          $array["start"] = str_replace(' ', 'T', $ligne['debut']);
          $array["end"] = str_replace(' ', 'T', $ligne['fin']);
          $array["color"] = '#' . $ligne['couleur'];
          
          array_push($arrayJson, $array);
      }
      
      $json = json_encode($arrayJson);
      
      echo $json;
    }
    
}