<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class REBUAutoFacturas
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
     * @ORM\Column(type="string", length=10)
     */
    protected $nAutoFactura;
    
    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    protected $nAnual;
    
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
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $marca;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=200)
     */
    protected $modelo;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $matricula;
    
    /** @ORM\Column(type="decimal", scale=2 ) */
    protected $importe;
    
    
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
     * @return REBUAutoFacturas
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
     * Set nAutoFactura
     *
     * @param string $nAutoFactura
     * @return REBUAutoFacturas
     */
    public function setNAutoFactura($nAutoFactura)
    {
        $this->nAutoFactura = $nAutoFactura;
        return $this;
    }
    
    /** Get nAutoFactura
     *
     * @return string
     */
    public function getNAutoFactura()
    {
        return $this->nAutoFactura;
    }
    
    
    /**
     * Set nAnual
     *
     * @param integer $nAnual
     * @return REBUAutoFacturas
     */
    public function setNAnual($nAnual)
    {
        $this->nAnual = $nAnual;
        return $this;
    }
    
    /** Get nAnual
     *
     * @return integer
     */
    public function getNAnual()
    {
        return $this->nAnual;
    }
    
    
    /**
     * Set cuentaPersonal
     *
     * @param \AppBundle\Entity\CuentasPersonales $cuentaPersonal
     * @return REBUAutoFacturas
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
     * @return REBUAutoFacturas
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
     * @return REBUAutoFacturas
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
     * Set marca
     *
     * @param string $marca
     * @return REBUAutoFacturas
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
     * @return REBUAutoFacturas
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
        return $this;
    }
    
    /**
     * Get numeroFactura
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
     * @return REBUAutoFacturas
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
     * @return REBUAutoFacturas
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
    
    public function __toString()
    {
        return $this->getNumeroFactura();
    }
}
