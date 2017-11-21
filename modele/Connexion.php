<?php

class Connexion 
{
    protected $id, 
              $identifiant,
              $motdepasse;
    
    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    
    // getters
    public function id()
    {
        return $this->id;
    }
    public function identifiant()
    {
        return $this->identifiant;
    }
    public function motdepasse()
    {
        return $this->motdepasse;
    }
    
    //setters
    public function setId()
    {
        $id = (int) $id;
        if($id>0)
        {
            $this->id = $id;
        }
    }
    
    public function setIdentifiant()
    {
        if (is_string($identifiant))
        {
            $this->identifiant = $identifiant;
        }
    }
    
    public function setMotdepasse()
    {
        if (is_string($motdepasse))
        {
            $this->motdepasse = $motdepasse;
        }
    }
}