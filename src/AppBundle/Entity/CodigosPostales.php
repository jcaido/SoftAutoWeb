<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class CodigosPostales
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=10, unique=true) */
    protected $cp;
    
    /** @ORM\Column(type="string", length=10) */
    protected $slug;
    
    /**
     * @ORM\Column(type="string", length=80, unique=true)
     * @Assert\NotBlank(message = "Debe introducir una localidad")
     */
    protected $localidad;
    
    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message = "Debe introducir una provincia")
     */
    protected $provincia;
    
    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message = "Debe introducir un pais")
     */
    protected $pais;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setCp($cp)
    {
        $this->cp = $cp;
        $this->slug = $cp;
        return $this;
    }
    public function getCp()
    {
        return $this->cp;
    }
    
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
        return $this;
    }
    public function getLocalidad()
    {
        return $this->localidad;
    }
    
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
        return $this;
    }
    public function getProvincia()
    {
        return $this->provincia;
    }
    
    public function setPais($pais)
    {
        $this->pais = $pais;
        return $this;
    }
    public function getPais()
    {
        return $this->pais;
    }
    
    public function __toString()
    {
        return $this->getCp();
        
    }
}
