<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class Ejercicios
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="integer")
     */
    protected $ejercicio;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $abierto;
    
    
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
     * Set ejercicio
     *
     * @param integer $ejercicio
     * @return Ejercicios
     */
    public function setEjercicio($ejercicio)
    {
        $this->ejercicio = $ejercicio;
        return $this;
    }
    
    /**
     * Get ejercicio
     *
     * @return integer
     */
    public function getEjercicio()
    {
        return $this->ejercicio;
    }
    
    /**
     * Set abierto
     *
     * @param boolean $abierto
     * @return Ejercicios
     */
    public function setAbierto($abierto)
    {
        $this->abierto = $abierto;
        return $this;
    }
    
    /**
     * Get abierto
     *
     * @return boolean
     */
    public function getAbierto()
    {
        return $this->abierto;
    }
    
    
    public function __toString()
    {
        return $this->getEjercicio();
    }
}
