<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class VehiculosREBUTerceros
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=100) */
    protected $marca;
    
    /** @ORM\Column(type="string", length=200) */
    protected $modelo;
    
    /** @ORM\Column(type="string", length=100) */
    protected $matricula;
    
    /** @ORM\Column(type="decimal", scale=2 ) */
    protected $importe;
    
    /**
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\REBUTerceros", inversedBy="vehiculosREBUTerceros", cascade={"persist"})
     * @ORM\JoinColumn(name="RebuTerceros_id", referencedColumnName="id")
     */
    protected $rebuTerceros;
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set marca
     *
     * @param string $marca
     * @return VehiculosREBUTerceros
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
        return $this;
    }
    
    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }
    
    /**
     * Set modelo
     *
     * @param string $modelo
     * @return VehiculosREBUTerceros
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
        return $this;
    }
    
    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }
    
    /**
     * Set matricula
     *
     * @param string $matricula
     * @return VehiculosREBUTerceros
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
        return $this;
    }
    
    /**
     * Get matricula
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }
    
    /**
     * Set importe
     *
     * @param decimal $importe
     * @return VehiculosREBUTerceros
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;
        return $this;
    }
    
    /**
     * Get importe
     *
     * @return decimal
     */
    public function getImporte()
    {
        return $this->importe;
    }
    
    /**
     * Set RebuTerceros
     *
     * @param \AppBundle\Entity\REBUTerceros $RebuTerceros
     * @return VehiculosREBUTerceros
     */
    public function setRebuTerceros(\AppBundle\Entity\REBUTerceros $rebuTerceros = null)
    {
       $this->rebuTerceros = $rebuTerceros;
    }
    
    /**
     * Get RebuTerceros
     *
     * @return \AppBundle\Entity\REBUTerceros
     */
    public function getRebuTerceros()
    {
        return $this->rebuTerceros;
    }
    
    
    public function __toString()
    {
        return $this->getMatricula();
    }
}
