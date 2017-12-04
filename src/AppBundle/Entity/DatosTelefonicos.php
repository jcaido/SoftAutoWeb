<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class DatosTelefonicos
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=10, unique=true)
     * @Assert\NotBlank(message = "Debe introducir un nº. de telefono")
     */
    protected $telefono;
    
    /** @ORM\Column(type="string", length=10) */
    protected $slug;
    
    /** @ORM\Column(type="string", length=300) */
    protected $observaciones;
    
    /**
     * @ORM\ManytoOne(targetEntity="AppBundle\Entity\CuentasPersonales", inversedBy="datosTelefonicos", cascade={"persist"})
     * @ORM\JoinColumn(name="cuentaPersonal_id", referencedColumnName="id")
     */
    protected $cuentaPersonal;
    
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
     * Set telefono
     *
     * @param string $telefono
     * @return DatosTelefonicos
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        $this->slug = $telefono;
        return $this;
    }
    
    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
    
    /**
     * Set slug
     *
     * @param string $slug
     * @return DatosTelefonicos
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
    
    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return DatosTelefonicos
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
        return $this;
    }
    
    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
    
    /**
     * Set cuentaPersonal
     *
     * @param \AppBundle\Entity\CuentasPersonales $cuentaPersonal
     * @return DatosTelefonicos
     */
    public function setCuentaPersonal(\AppBundle\Entity\CuentasPersonales $cuentaPersonal = null)
    {
       $this->cuentaPersonal = $cuentaPersonal;
    }
    
    /**
     * Get cuentaPersonal
     *
     * @return \AppBundle\Entity\CuentasPersonales
     */
    public function getCuentaPersonal()
    {
        return $this->cuentaPersonal;
    }
    
    
    public function __toString()
    {
        return $this->getTelefono();
    }
}
