<?php

require_once('controleur/ControleurAccueil.php');
require_once('controleur/ControleurAdmin.php');
require_once('controleur/ControleurBillet.php');

// définition de la classe Routeur qui gère l'affichage des pages en fonction des paramètres transmis par l'url ou affiche des messages d'erreur
class Routeur
{
    private $ctrlAccueil;
    private $ctrlBillet;
    private $ctrlAdmin;
    
    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil;
        $this->ctrlBillet = new ControleurBillet;
        $this->ctrlAdmin = new ControleurAdmin;
    }
    
    // rechercher un paramètre dans un tableau
    private function getParametre($tableau, $nom)
    {
        if (isset($tableau[$nom]))
        {
            return $tableau[$nom];
        }
        else 
        {
            throw new Exception ("Paramètre '$nom' absent");
        }
    }
    
    
    // gestion par les contrôleurs en fonction des paramètres passés par l'URL
    public function routerRequete()
    {  
        try
        {
            if (isset($_GET['action']))
            {
                switch($_GET['action'])
                {
                    case 'billet':
                        if (isset($_GET['id'])) 
                        {
                            $idBillet = intval($_GET['id']);
                            if ($idBillet > 0) 
                            {
                                $this->ctrlBillet->billet($idBillet);
                                if(isset($_GET['page']))
                                {
                                    $page = intval($_GET['page']);
                                }
                                else
                                {
                                    $page = intval($_GET['page']);
                                    $page = 1;
                                }
                            } 
                            else 
                            {
                                throw new Exception("Identifiant de billet non valide");
                            }
                        }
                        else
                        {
                            throw new Exception("Pas d'id en paramètre");
                        }
                    break;
                    case 'commenter':
                        if (isset($_POST['idBillet']))
                        {
                            $idBillet = $this->getParametre($_POST, 'idBillet');
                            $idBillet = (int)$idBillet;
                            if ($idBillet > 0) 
                            {
                                if(!empty($_POST['auteur']) && !empty($_POST['comm']))
                                {
                                    $auteur = $this->getParametre($_POST, 'auteur');
                                    $comm = $this->getParametre($_POST, 'comm');

                                    $this->ctrlBillet->commenter($auteur, $comm, $idBillet);
                                }
                                else 
                                {
                                    throw new Exception('Tous les champs ne sont pas remplis !');
                                }   
                            }
                            else
                            {
                                throw new Exception('Identifiant de billet envoyé invalide');
                            }
                        }
                        else 
                        {
                            throw new Exception('Aucun identifiant de billet envoyé');
                        }
                    break;
                    case 'signalerCom':
                        if(isset($_GET['idCom']) && isset($_GET['idBillet']))
                        {
                            $idCom = $this->getParametre($_GET, 'idCom');
                            $idBillet = $this->getParametre($_GET, 'idBillet');
                            $idCom = (int)$idCom;
                            $idBillet = (int)$idBillet;
                            $this->ctrlBillet->signalerCom($idCom, $idBillet);
                        }
                        else
                        {
                            throw new Exception('Erreur dans les identifiants, impossible de signaler le commentaire');
                        }
                    break;
                    case 'admin': 
                        // si le mot de passe et l'identifiant ne sont pas corrects on retourne sur la page d'accueil
                        if (isset($_POST['identifiant']) AND $_POST['identifiant'] != "Jean.Forteroche" OR isset($_POST['motdepasse']) AND hash('sha256', $_POST['motdepasse']) != 'cf6f8a4f0373bfc7497a888d2f7dc0d84d9fd925550367b0af7da2fa7c3714f5')
                        {
                            $this->ctrlAdmin->errConnexion();    
                        }
                        // si l'action définie est admin et que le mot de passe et l'identifiant sont bons : on sera sur la page d'administration du site 
                        elseif (isset($_POST['identifiant']) AND ($_POST['identifiant']) == "Jean.Forteroche" AND isset($_POST['motdepasse']) AND hash('sha256', $_POST['motdepasse']) == 'cf6f8a4f0373bfc7497a888d2f7dc0d84d9fd925550367b0af7da2fa7c3714f5') 
                        {  
                            $identifiant = $_POST['identifiant'];
                            $_SESSION['identifiant'] = $identifiant;

                            $this->ctrlAdmin->admin();
                            
                            if (isset($_GET['rubrique']) && isset($_SESSION['identifiant']))
                            {
                                switch($_GET['rubrique'])
                                {
                                    case 'nouveauChapitre':
                                        $this->ctrlAdmin->nouveauChapitre();
                                    break;
                                    case 'postBillet':
                                        if(!empty($_POST['titre']) && !empty($_POST['extrait']) && !empty($_POST['contenu']))
                                        {
                                            $titre = $this->getParametre($_POST, 'titre');
                                            $extrait = $this->getParametre($_POST, 'extrait');
                                            $contenu = $this->getParametre($_POST, 'contenu');
                                            $this->ctrlAdmin->postBillet($titre, $extrait, $contenu);
                                        }
                                        else 
                                        {
                                            throw new Exception('Tous les champs ne sont pas remplis !');
                                        }
                                    break;
                                    case 'update': 
                                        if(isset($_GET['id']))
                                        {
                                            $id = $this->getParametre($_GET, 'id');
                                            $id = (int)$id;
                                            $this->ctrlAdmin->update($id);   
                                        }
                                        else
                                        {
                                            throw new Exception('Pas d\'identifiant de billet en paramètre');
                                        }
                                    break;
                                    case 'updateBillet':
                                        if(isset($_GET['id']))
                                        {
                                            if(!empty($_POST['titre']) && !empty($_POST['extrait']) && !empty($_POST['contenu']))
                                            {
                                            $titre = $this->getParametre($_POST, 'titre');
                                            $extrait = $this->getParametre($_POST, 'extrait');
                                            $contenu = $this->getParametre($_POST, 'contenu');
                                            $id = $this->getParametre($_GET, 'id');
                                            $id =(int)$id;
                                            $this->ctrlAdmin->updateBillet($titre, $extrait, $contenu, $id);
                                            }
                                            else 
                                            {
                                                throw new Exception('Tous les champs ne sont pas remplis !');
                                            }
                                        }
                                        else
                                        {
                                            throw new Exception('Pas d\'id de billet en paramètre');
                                        }
                                    break;
                                    case 'deleteBillet':
                                        if(isset($_GET['id']))
                                        {
                                            $id = $this->getParametre($_GET, 'id');
                                            $id = (int)$id;
                                            $this->ctrlAdmin->deleteBillet($id);
                                        }
                                        else
                                        {
                                            throw new Exception('Pas d\'identifiant de billet à supprimer');
                                        }
                                    break;
                                    case 'updateCom':
                                        if(isset($_GET['id']))
                                        {
                                            $id = $this->getParametre($_GET, 'id');
                                            $id =(int)$id;
                                            $this->ctrlAdmin->updateCom($id);
                                        }
                                        else
                                        {
                                            throw new Exception('Pas d\'identifiant de commentaire à valider en paramètre');
                                        }
                                    break;
                                    case 'deleteCom':
                                        if(isset($_GET['id']))
                                        {
                                            $id = $this->getParametre($_GET, 'id');
                                            $id = (int)$id;
                                            $this->ctrlAdmin->deleteCom($id);
                                        }
                                        else
                                        {
                                            throw new Exception('Pas d\'identifiant de commentaire à supprimer en paramètre');
                                        }
                                    break;
                                    case 'deconnexion':
                                        $this->ctrlAdmin->deconnexion();
                                    break;
                                }
                            }
                        }
                    break;
                }
            }
            else 
            {
                $this->ctrlAccueil->accueil();
            }
        }
        catch(Exception $e) 
        {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}
