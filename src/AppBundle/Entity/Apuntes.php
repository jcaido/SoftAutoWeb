<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Apuntes
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CuentasContables", cascade={"persist"})
     */
    protected $cuentaContable;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CuentasPersonales", cascade={"persist"})
     */
    protected $cuentaPersonal;
    
    /** @ORM\Column(type="string", length=50) */
    protected $concepto;
    
    /** @ORM\Column(type="decimal", scale=2 ) */
    protected $importe;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $debe;
    
    /**
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\Asientos", inversedBy="apuntes", cascade={"persist"})
     * @ORM\JoinColumn(name="asiento_id", referencedColumnName="id")
     */
    protected $asiento ;
    
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
     * Set cuentaContable
     *
     * @param \AppBundle\Entity\CuentasCuentasContables $cuentaContable
     * @return Apuntes
     */
    public function setCuentaContable(\AppBundle\Entity\CuentasContables $cuentaContable)
    {
        $this->cuentaContable = $cuentaContable;
        return $this;
    }
    
    /**
     * Get cuentaContable
     *
     * @return string
     */
    public function getCuentaContable()
    {
        return $this->cuentaContable;
    }
    
    /**
     * Set cuentaPersonal
     *
     * @param \AppBundle\Entity\CuentasPersonales $cuentaPersonal
     * @return Apuntes
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
     * Set concepto
     *
     * @param string $concepto
     * @return Apuntes
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
     * Set importe
     *
     * @param decimal $importe
     * @return Apuntes
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
     * Set debe
     *
     * @param boolean $debe
     * @return Apuntes
     */
    public function setDebe($debe)
    {
        $this->debe = $debe;
        return $this;
    }
    
    /**
     * Get debe
     *
     * @return boolean
     */
    public function getDebe()
    {
        return $this->debe;
    }
    
    /**
     * Set asiento
     *
     * @param \AppBundle\Entity\Asientos $asiento
     * @return Apuntes
     */
    public function setAsiento(\AppBundle\Entity\Asientos $asiento = null)
    {
       $this->asiento = $asiento;
    }
    
    /**
     * Get Asiento
     *
     * @return \AppBundle\Entity\Asientos
     */
    public function getAsiento()
    {
        return $this->asiento;
    }
    
    
    public function __toString()
    {
       return $this->getConcepto();
    }
}
