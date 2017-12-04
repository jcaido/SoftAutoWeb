<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class CuentasContables
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=20) */
    protected $cuentaContable;
    
    /** @ORM\Column(type="string", length=100) */
    protected $nombreCtaContable;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setCuentaContable($cuentaContable)
    {
        $this->cuentaContable = $cuentaContable;
        return $this;
    }
    
    public function getCuentaContable()
    {
        return $this->cuentaContable;
    }
    
    public function setNombreCtaContable($nombreCtaContable)
    {
        $this->nombreCtaContable = $nombreCtaContable;
        return $this;
    }
    
    public function getNombreCtaContable()
    {
        return $this->nombreCtaContable;
    }
    
    public function __toString()
    {
        return $this->getCuentaContable();
        
    }
}
