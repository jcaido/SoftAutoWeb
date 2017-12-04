<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class VehiculosComprasRG
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
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\ComprasRG", inversedBy="comprasRGVehiculos", cascade={"persist"})
     * @ORM\JoinColumn(name="ComprasRG_id", referencedColumnName="id")
     */
    protected $comprasRG;
    
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
     * @return VehiculosComprasRG
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
     * @return VehiculosComprasRG
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
     * @return VehiculosComprasRG
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
     * @return VehiculosComprasRG
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
     * Set ComprasRG
     *
     * @param \AppBundle\Entity\ComprasRG $comprasRG
     * @return VehiculosComprasRG
     */
    public function setComprasRG(\AppBundle\Entity\ComprasRG $comprasRG = null)
    {
       $this->comprasRG = $comprasRG;
    }
    
    /**
     * Get ComprasRG
     *
     * @return \AppBundle\Entity\ComprasRG
     */
    public function getComprasRG()
    {
        return $this->comprasRG;
    }
    
    
    public function __toString()
    {
        return $this->getMatricula();
    }
}
