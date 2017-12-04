<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class Diarios
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=50) */
    protected $diario;
    
    /** @ORM\Column(type="string", length=10) */
    protected $abrDiario;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setDiario($diario)
    {
        $this->diario = $diario;
        return $this;
    }
    
    public function getDiario()
    {
        return $this->diario;
    }
    
    public function setAbrDiario($abrDiario)
    {
        $this->abrDiario = $abrDiario;
        return $this;
    }
    
    public function getAbrDiario()
    {
        return $this->abrDiario;
    }
    
    public function __toString()
    {
        return $this->getAbrDiario();
        
    }
}
