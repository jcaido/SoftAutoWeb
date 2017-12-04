<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class REBUTerceros
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @var date
     * 
     * @ORM\Column(type="date")
     */
    protected $fechaFactura;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100)
     */
    protected $numeroFactura;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CuentasPersonales", cascade={"persist"})
     */
    protected $cuentaPersonal;
    
    /**
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\TiposIva", cascade={"persist"})
     */
    protected $tipoIva;
    
    /**
     * @orm\OneToOne(targetEntity="AppBundle\Entity\Asientos", cascade={"persist"})
     */
    protected $asiento;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VehiculosREBUTerceros", mappedBy="rebuTerceros", cascade={"persist"})
     */
    protected $vehiculosREBUTerceros;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehiculosREBUTerceros = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set fechaFactura
     *
     * @param date$fechaFactura
     * @return REBUTerceros
     */
    public function setFechaFactura($fechaFactura)
    {
        $this->fechaFactura = $fechaFactura;
        return $this;
    }
    
    /**
     * Get fechaFactura
     *
     * @return date
     */
    public function getFechaFactura()
    {
        return $this->fechaFactura;
    }
    
    /**
     * Set numeroFactura
     *
     * @param string $numeroFactura
     * @return REBUTerceros
     */
    public function setNumeroFactura($numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;
        return $this;
    }
    
    /**
     * Get numeroFactura
     *
     * @return string
     */
    public function getNumeroFactura()
    {
        return $this->numeroFactura;
    }
    
    /**
     * Set cuentaPersonal
     *
     * @param \AppBundle\Entity\CuentasPersonales $cuentaPersonal
     * @return REBUTerceros
     */
    public function setCuentaPersonal(\AppBundle\Entity\CuentasPersonales $cuentaPersonal)
    {
        $this->cuentaPersonal = $cuentaPersonal;
        return $this;
    }
    
    /**
     * Get cuentaPersonal
     *
     * @return string
     */
    public function getCuentaPersonal()
    {
        return $this->cuentaPersonal;
    }
    
    /**
     * Set tipoIva
     *
     * @param \AppBundle\Entity\TiposIva $tipoIva
     * @return REBUTerceros
     */
    public function setTipoIva(\AppBundle\Entity\TiposIva $tipoIva)
    {
        $this->tipoIva = $tipoIva;
        return $this;
    }
    
    /**
     * Get tipoIva
     *
     * @return string
     */
    public function getTipoIva()
    {
        return $this->tipoIva;
    }
    
    /**
     * Set asiento
     *
     * @param \AppBundle\Entity\Asientos $asiento
     * @return REBUTerceros
     */
    public function setAsiento(\AppBundle\Entity\Asientos $asiento)
    {
        $this->asiento = $asiento;
        return $this;
    }
    
    /**
     * Get asiento
     *
     * @return string
     */
    public function getAsiento()
    {
        return $this->asiento;
    }
    
    /**
     * Add vehiculosREBUTerceros
     *
     * @param \AppBundle\Entity\VehiculosREBUTerceros $vehiculosREBUTerceros
     * @return REBUTerceros
     */
    public function addVehiculosREBUTercero(\AppBundle\Entity\VehiculosREBUTerceros $vehiculosREBUTerceros)
    {
        $this->vehiculosREBUTerceros[] = $vehiculosREBUTerceros;
        $vehiculosREBUTerceros->setRebuTerceros($this);
        
        return $this;
    }
    
    /**
     * Remove vehiculosREBUTerceros
     *
     * @param \AppBundle\Entity\VehiculosREBUTerceros $vehiculosREBUTerceros
     */
    public function removeVehiculosREBUTercero(\AppBundle\Entity\VehiculosREBUTerceros $vehiculosREBUTerceros)
    {
        $this->vehiculosREBUTerceros->removeElement($vehiculosREBUTerceros);
    }
    
    /**
     * Get vehiculosREBUTerceros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehiculosREBUTerceros()
    {
        return $this->vehiculosREBUTerceros;
    }
    
    
    public function __toString()
    {
        return $this->getNumeroFactura();
    }
}
