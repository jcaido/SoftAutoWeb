<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class GastosFacturas
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
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\TiposIRPF", cascade={"persist"})
     */
    protected $tipoIRPF;
    
    /**
     * @orm\OneToOne(targetEntity="AppBundle\Entity\Asientos", cascade={"persist"})
     */
    protected $asiento;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GastoGastosFacturas", mappedBy="gastosFacturas", cascade={"persist"})
     */
    protected $gastoGastosFacturas;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gastoGastosFacturas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return GastosFacturas
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
     * @return GastosFacturas
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
     * @return GastosFacturas
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
     * Set tipoIRPF
     *
     * @param \AppBundle\Entity\TiposIRPF $tipoIRPF
     * @return GastosFacturas
     */
    public function setTipoIRPF(\AppBundle\Entity\TiposIRPF $tipoIRPF)
    {
        $this->tipoIRPF = $tipoIRPF;
        return $this;
    }
    
    /**
     * Get tipoIRPF
     *
     * @return string
     */
    public function getTipoIRPF()
    {
        return $this->tipoIRPF;
    }
    
    /**
     * Set asiento
     *
     * @param \AppBundle\Entity\Asientos $asiento
     * @return GastosFacturas
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
     * Add gastoGastosFacturas
     *
     * @param \AppBundle\Entity\GastoGastosFacturas $gastoGastosFacturas
     * @return GastosFacturas
     */
    public function addGastoGastosFactura(\AppBundle\Entity\GastoGastosFacturas $gastoGastosFacturas)
    {
        $this->gastoGastosFacturas[] = $gastoGastosFacturas;
        $gastoGastosFacturas->setGastosFacturas($this);
        
        return $this;
    }
    
    /**
     * Remove gastoGastosFacturas
     *
     * @param \AppBundle\Entity\GastoGastosFacturas $gastoGastosFacturas
     */
    public function removeGAstoGastosFactura(\AppBundle\Entity\GastoGastosFacturas $gastoGastosFacturas)
    {
        $this->gastoGastosFacturas->removeElement($gastoGastosFacturas);
    }
    
    /**
     * Get gastoGastosFacturas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGastoGastosFacturas()
    {
        return $this->gastoGastosFacturas;
    }
    
    
    public function __toString()
    {
        return $this->getNumeroFactura();
    }
}
