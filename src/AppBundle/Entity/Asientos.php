<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class Asientos
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
     * @ORM\Column(type="date", nullable = true)
     */
    protected $fechaAsiento;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="integer", nullable = true)
     */
    protected $referencia;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Diarios", cascade={"persist"})
     */
    protected $diario;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Apuntes", mappedBy="asiento", cascade={"persist"})
     */
    protected $apuntes;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->apuntes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fechaAsiento
     *
     * @param date$fechaAsiento
     * @return Asientos
     */
    public function setFechaAsiento($fechaAsiento)
    {
        $this->fechaAsiento = $fechaAsiento;
        return $this;
    }
    
    /**
     * Get fechaAsiento
     *
     * @return date
     */
    public function getFechaAsiento()
    {
        return $this->fechaAsiento;
    }
    
    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Asientos
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
        return $this;
    }
    
    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }
    
    /**
     * Set diario
     *
     * @param \AppBundle\Entity\Diarios $diario
     * @return Asientos
     */
    public function setDiario(\AppBundle\Entity\Diarios $diario)
    {
        $this->diario = $diario;
        return $this;
    }
    
    /**
     * Get diario
     *
     * @return string
     */
    public function getDiario()
    {
        return $this->diario;
    }
    
    /**
     * Add apuntes
     *
     * @param \AppBundle\Entity\Apuntes $apuntes
     * @return Asientos
     */
    public function addApunte(\AppBundle\Entity\Apuntes $apuntes)
    {
        $this->apuntes[] = $apuntes;
        $apuntes->setAsiento($this);
        
        return $this;
    }
    
    /**
     * Remove apuntes
     *
     * @param \AppBundle\Entity\Apuntes $apuntes
     */
    public function removeApunte(\AppBundle\Entity\Apuntes $apuntes)
    {
        $this->apuntes->removeElement($apuntes);
    }
    
    /**
     * Get apuntes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApuntes()
    {
        return $this->apuntes;
    }
    
    
    public function __toString()
    {
        return $this->getReferencia();
    }
}
