<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class GastoGastosFacturas
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $retencion;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CuentasContables", cascade={"persist"})
     */
    protected $ctaContable;
    
    /** @ORM\Column(type="string", length=200) */
    protected $concepto;
    
    /**
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\TiposIva", cascade={"persist"})
     */
    protected $tipoIva;
    
    /** @ORM\Column(type="decimal", scale=2 ) */
    protected $importe;
    
    /**
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\GastosFacturas", inversedBy="gastoGastosFacturas", cascade={"persist"})
     * @ORM\JoinColumn(name="GastosFacturas_id", referencedColumnName="id")
     */
    protected $gastosFacturas;
    
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
     * Set retencion
     *
     * @param boolean $retencion
     * @return GastoGastosFacturas
     */
    public function setRetencion($retencion)
    {
        $this->retencion = $retencion;
        return $this;
    }
    
    /**
     * Get retencion
     *
     * @return boolean
     */
    public function getRetencion()
    {
        return $this->retencion;
    }
    
    /**
     * Set ctaContable
     *
     * @param \AppBundle\Entity\CuentasContables $ctaContable
     * @return GastoGastosFacturas
     */
    public function setCtaContable($ctaContable)
    {
        $this->ctaContable = $ctaContable;
        return $this;
    }
    
    /**
     * Get ctaContable
     *
     * @return string
     */
    public function getCtaContable()
    {
        return $this->ctaContable;
    }
    
    /**
     * Set concepto
     *
     * @param string $concepto
     * @return GastoGastosFacturas
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
        return $this;
    }
    
    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }
    
    /**
     * Set tipoIva
     *
     * @param \AppBundle\Entity\TiposIva $tipoIva
     * @return GastoGastosFacturas
     */
    public function setTipoIva($tipoIva)
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
     * Set importe
     * @param decimal $importe
     * @return GastoGastosFacturas
     */
    public function setImporte()
    {
        $this->importe= $importe;
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
     * Set gastosFacturas
     *
     * @param \AppBundle\Entity\GastosFacturas $gastosFacturas
     * @return GastoGastosFacturas
     */
    public function setGastosFacturas(\AppBundle\Entity\GastosFacturas $gastosFacturas = null)
    {
       $this->gastosFacturas = $gastosFacturas;
    }
    
    /**
     * Get gastosFacturas
     *
     * @return \AppBundle\Entity\GastosFacturas
     */
    public function getGastosFacturas()
    {
        return $this->gastosFacturas;
    }
    
    
    public function __toString()
    {
        return $this->getConcepto();
    }
}
