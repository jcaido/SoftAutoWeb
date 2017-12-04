<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class ComprasRG
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VehiculosComprasRG", mappedBy="comprasRG", cascade={"persist"})
     */
    protected $comprasRGVehiculos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ComprasRGVehiculos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ComprasRG
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
     * @return ComprasRG
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
     * @return ComprasRG
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
     * @return ComprasRG
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
     * @return ComprasRG
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
     * Add comprasRGVehiculo
     *
     * @param \AppBundle\Entity\VehiculosComprasRG $comprasRGvehiculos
     * @return ComprasRG
     */
    public function addComprasRGVehiculo(\AppBundle\Entity\VehiculosComprasRG $comprasRGvehiculos)
    {
        $this->comprasRGVehiculos[] = $comprasRGvehiculos;
        $comprasRGvehiculos->setComprasRG($this);
        
        return $this;
    }
    
    /**
     * Remove comprasRGVehiculo
     *
     * @param \AppBundle\Entity\VehiculosComprasRG $comprasRGVehiculos
     */
    public function removeComprasRGVehiculo(\AppBundle\Entity\VehiculosComprasRG $comprasRGVehiculos)
    {
        $this->comprasRGVehiculos->removeElement($comprasRGVehiculos);
    }
    
    /**
     * Get comprasRGVehiculos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComprasRGVehiculos()
    {
        return $this->comprasRGVehiculos;
    }
    
    
    public function __toString()
    {
        return $this->getNumeroFactura();
    }
}
