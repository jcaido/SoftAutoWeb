<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class TiposIva
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** @ORM\Column(type="integer") */
    protected $porcentaje;
    
    /** @ORM\Column(type="string", length=80) */
    protected $descripcion;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
        return $this;
    }
    
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }
    
    
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }
    
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function __toString()
    {
        return $this->getDescripcion();
        
    }
}
