<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class Usuario implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
    * @ORM\Column(type="string", length=100)
    * @Assert\NotBlank()
    */
    protected $nombre;
    
    /** @ORM\Column(type="string", length=255) */
    protected $password;
    

    public function getId()
    {
        return $this->id;
    }
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getRoles()
    {
        return array('ROLE_USUARIO');
    }
    
    public function getUsername()
    {
        return $this->getNombre();
    }
    
    public function eraseCredentials()
    {
        
    }
    
    public function getSalt()
    {
        
    }
    
    /** @see \Serializable::serialize() */
    public  function serialize()
    {
        return serialize(array(
            $this->id,
            $this->nombre,
            $this->password,
        ));    
    }
    
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nombre,
            $this->password,
        ) = unserialize($serialized);
    }
    
    public function __toString()
    {
        return $this->getNombre();
        
    }
}
