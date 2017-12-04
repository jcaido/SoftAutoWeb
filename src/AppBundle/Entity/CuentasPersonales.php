<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @uniqueEntity(fields={"nifCif"}, message="El NIF / CIF ya existe")
 */

class CuentasPersonales
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
     * @ORM\Column(type="string", length=6, nullable = true)
     */
    protected $ncuentaPersonal;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $cliente;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $proveedor;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $personaFisica;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $nombre;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $primerApellido;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $segundoApellido;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=200, nullable = true)
     */
    protected $denominacionSocial;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=300, nullable = true)
     */
    protected $direccion;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CodigosPostales", cascade={"persist"})
     */
    protected $cp;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=10, unique = true)
     * @Assert\NotBlank(message = "Debe introducir un NIF/CIF")
     */
    protected $nifCif;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable = true)
     * @Assert\Email(message = "'{{ value }}' No es una dirección de e-mail válida")
     */
    protected $email;
    
    // Autorización al tratamiento de datos personales //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $atdp;
    
    // Autorizacion cesión datos personales //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $acdp;
    
    // Rectificación datos personales //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $rdp;
    
    // Fecha de rectificacion de datos personales //
    /**
     * @var date
     * 
     * @ORM\Column(type="date", nullable = true)
     */
    protected $fechaRdp;
    
    // Rectificación comunicada al cesionario de los datos //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $rectccd;
    
    // Revocación para la cesión de datos personales //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $rcdp;
    
    // Fecha de revocación para la cesión de datos personales //
    /**
     * @var date
     * 
     * @ORM\Column(type="date", nullable = true)
     */
    protected $fechaRcdp;
    
    // Revocación comunicada al cesionario de los datos //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $revccd;
    
    // Autorización envío comunicaciones comerciales //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $aecc;
    
    // Canales de comunicación prohibidos, Correo Postal //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpCp;
    
    // Canales de comunicacion prohibidos, E-mail //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpEmail;
    
    // Canales de comunicación prohibidos, Llamadas telefónicas //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpLlt;
    
    // Canales de comunicación prohibidos, Mensajes de móvil //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpMm;
    
    // Canales de comunicación prohibidos, Fax //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpFax;
    
    // Canales de comunicación prohibidos, Redes sociales //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpRs;
    
    // Canales de comunicación prohibidos, Vía alternativa //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $ccpVa;
    
    // Revocación autorizada envío comunicaciones comerciales //
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $racc;
    
    // Fecha de revocación de la autorización de comunicaciones comerciales //
    /**
     * @var date
     * 
     * @ORM\Column(type="date", nullable = true)
     */
    protected $fechaRacc;
    
    // Revocación comunicada al cesionario de los datos //
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    protected $racd;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DatosTelefonicos", mappedBy="cuentaPersonal", cascade={"persist"})
     */
    protected $datosTelefonicos;
    
    
    public function __construct()
    {
        $this->datosTelefonicos = new ArrayCollection();
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
     * Set nºcuentaPersonal
     *
     * @param string $ncuentaPersonal
     * @return CuentasPersonales
     */
    public function setNcuentaPersonal($ncuentaPersonal)
    {
        $this->ncuentaPersonal = $ncuentaPersonal;
        return $this;
    }
    
    /**
     *Get nºcuentaPersonal
     *
     *@return string
     */
    public function getNcuentaPersonal()
    {
        return $this->ncuentaPersonal;
    }
    
    /**
     * Set cliente
     *
     * @param boolean $cliente
     * @return CuentasPersonales
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }
    
    /**
     * Get cliente
     *
     * @return boolean
     */
    public function getCliente()
    {
        return $this->cliente;
    }
    
    /**
     * Set proveedor
     *
     * @param boolean $proveedor
     * @return CuentasPersonales
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
        return $this;
    }
    
    /**
     * Get proveedor
     *
     * @return boolean
     */
    public function getProveedor ()
    {
        return $this->proveedor;
    }
    
    /**
     * Set personaFisica
     *
     * @param boolean $personaFisica
     * @return CuentasPersonales
     */
    public function setPersonaFisica($personaFisica)
    {
        $this->personaFisica = $personaFisica;
        return $this;
    }
    
    /**
     * Get personaFisica
     *
     * @return boolea
     */
    public function getPersonaFisica()
    {
        return $this->personaFisica;
    }
    
    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CuentasPersonales
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    
    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     * @return CuentaPersonales
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;
        return $this;
    }
    
    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }
    
    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     * @return CuentasPersonales
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;
        return $this;
    }
    
    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }
    
    /**
     * Set denominacionSocial
     *
     * @param string $denominacionSocial
     * @return CuentasPersonales
     */
    public function setDenominacionSocial($denominacionSocial)
    {
        $this->denominacionSocial = $denominacionSocial;
        return $this;
    }
    
    /**
     * Get denominacionSocial
     *
     * @return string
     */
    public function getDenominacionSocial()
    {
        return $this->denominacionSocial;
    }
    
    /**
     * Set direccion
     *
     * @param string $direccion
     * @return CuentasPersonales
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }
    
    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    /**
     * Set cp
     *
     * @param \AppBundle\Entity\CodigosPostales $cp
     * @return CuentasPersonale
     */
    public function setCp(\AppBundle\Entity\CodigosPostales $cp)
    {
        $this->cp = $cp;
        return $this;
    }
    
    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }
    
    /**
     *
     * Set nifCif
     *
     * @param string $nifCif
     * @return CuentasPersonales
     */
    public function setNifCif($nifCif)
    {
        $this->nifCif = $nifCif;
        return $this;
    }
    
    /**
     * Get nifCif
     *
     * @return string
     */
    public function getNifCif()
    {
        return $this->nifCif;
    }
    
    /**
     * Set email
     *
     * @param string $email
     * @return CuentasPersonales
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set atdp
     *
     * @param boolen $atdp
     * @return CuentasPersonales
     */
    public function setAtdp($atdp)
    {
        $this->atdp = $atdp;
        return $this;
    }
    
    /**
     * Get atdp
     *
     * @return boolean
     */
    public function getAtdp()
    {
        return $this->atdp;
    }
    
    /**
     * Set acdp
     *
     * @param boolean $acdp
     * @return CuentasPersonales
     */
    public function setAcdp($acdp)
    {
        $this->acdp = $acdp;
        return $this;
    }
    
    /**
     * Get acdp
     *
     * @return boolean
     */
    public function getAcdp()
    {
        return $this->acdp;
    }
    
    /**
     * Set rdp
     * @param boolean $rdp
     * @return CuentasPersonales
     */
    public function setRdp($rdp)
    {
        $this->rdp = $rdp;
        return $this;
    }
    
    /**
     * Get rdp
     *
     * @return boolean
     */
    public function getRdp()
    {
        return $this->rdp;
    }
    
    /**
     * Set fechaRdp
     *
     * @param date $fechaRdp
     * @return CuentasPersonales
     */
    public function setFechaRdp($fechaRdp)
    {
        $this->fechaRdp = $fechaRdp;
        return $this;
    }
    
    /**
     * Get fechaRdp
     *
     * @return date
     */
    public function getFechaRdp()
    {
        return $this->fechaRdp;
    }
    
    /**
     * Set rectccd
     *
     * @param boolean $rectccd
     * @return CuentasPersonales
     */
    public function setRectccd($rectccd)
    {
        $this->rectccd = $rectccd;
        return $this;
    }
    
    /**
     * Get rectccd
     *
     * @return boolean
     */
    public function getRectccd()
    {
        return $this->rectccd;
    }
    
    /**
     * Set rcdp
     *
     * @param boolean $rcdp
     * @return CuentasPersonales
     */
    public function setRcdp($rcdp)
    {
        $this->rcdp = $rcdp;
        return $this;
    }
    
    /**
     * Get rcdp
     *
     * @return boolean
     */
    public function getRcdp()
    {
        return $this->rcdp;
    }
    
    /**
     * Set fechaRcdp
     *
     * @param date $fechaRcdp
     * @return CuentasPersonales
     */
    public function setFechaRcdp($fechaRcdp)
    {
        $this->fechaRcdp = $fechaRcdp;
        return $this;
    }
    
    /**
     * Get fechaRcdp
     *
     * @return date
     */
    public function getFechaRcdp()
    {
        return $this->fechaRcdp;
    }
    
    /**
     * Set revccd
     *
     * @param boolean $revccd
     * @return CuentasPersonales
     */
    public function setRevccd($revccd)
    {
        $this->revccd = $revccd;
        return $this;
    }
    
    /**
     * Get revccd
     *
     * @return boolean
     */
    public function getRevccd()
    {
        return $this->revccd;
    }
    
    /**
     * Set aecc
     *
     * @param boolean $aecc
     * @return CuentasPersonales
     */
    public function setAecc($aecc)
    {
        $this->aecc = $aecc;
        return $this;
    }
    
    /**
     * Get aecc
     *
     * @ return aecc
     */
    public function getAecc()
    {
        return $this->aecc;
    }
    
    /**
     * Set ccpCp
     *
     * @param boolean $ccpCp
     * @return CuentasPersonales
     */
    public function setCcpCp($ccpCp)
    {
        $this->ccpCp = $ccpCp;
        return $this;
    }
    
    /**
     * Get ccpCp
     *
     * @return boolean
     */
    public function getCcpCp()
    {
        return $this->ccpCp;
    }
    
    /**
     * Set ccpEmail
     *
     * @param boolean $ccpEmail
     * @return CuentasPersonales
     */
    public function setCcpEmail($ccpEmail)
    {
        $this->ccpEmail = $ccpEmail;
        return $this;
    }
    
    /**
     * Get ccpEmail
     *
     * @return boolean
     */
    public function getCcpEmail()
    {
        return $this->ccpEmail;
    }
    
    /**
     * Set ccpLlt
     *
     * @param boolean $ccpLlt
     * @return CuentasPersonales
     */
    public function setCcpLlt($ccpLlt)
    {
        $this->ccpLlt = $ccpLlt;
        return $this;
    }
    
    /**
     *Get ccpLlt
     *
     * @return boolean
     */
    public function getCcpLlt()
    {
        return $this->ccpLlt;
    }
    
    /**
     * Set ccpMm
     *
     * @param boolean $ccpMm
     * @return CuentasPersonales
     */
    public function setCcpMm($ccpMm)
    {
        $this->ccpMm = $ccpMm;
        return $this;
    }
    
    /**
     * Get ccpMm
     *
     * @return boolean
     */
    public function getCcpMm()
    {
        return $this->ccpMm;
    }
    
    /**
     * Set ccpFax
     *
     * @param boolean $ccpFax
     * @return CuentasPersonales
     */
    public function setCcpFax($ccpFax)
    {
        $this->ccpFax = $ccpFax;
        return $this;
    }
    
    /**
     * Get ccpFax
     *
     * @return boolean
     */
    public function getCcpFax()
    {
        return $this->ccpFax;
    }
    
    /**
     * Set ccpRs
     *
     * @param boolean $ccpRs
     * @return CuentasPersonales
     */
    public function setCcpRs($ccpRs)
    {
        $this->ccpRs = $ccpRs;
        return $this;
    }
    
    /**
     * Get ccpRs
     *
     * @return boolean
     */
    public function getCcpRs()
    {
        return $this->ccpRs;
    }
    
    /**
     * Set ccpVa
     *
     * @param boolean $ccpVa
     * @return CuentasPersonales
     */
    public function setCcpVa($ccpVa)
    {
        $this->ccpVa = $ccpVa;
        return $this;
    }
    
    /**
     * Get ccpVa
     *
     * @return boolean
     */
    public function getCcpVa()
    {
        return $this->ccpVa;
    }
    
    /**
     * Set racc
     *
     * @param boolean $racc
     * @return CuentasPersonales
     */
    public function setRacc($racc)
    {
        $this->racc= $racc;
        return $this;
    }
    
    /**
     * Get racc
     *
     * @return boolean
     */
    public function getRacc()
    {
        return $this->racc;
    }
    
    /**
     * Set fechaRacc
     *
     * @param date $fechaRacc
     * @return CuentasPersonales
     */
    public function setFechaRacc($fecharacc)
    {
        $this->fechaRacc = $fecharacc;
        return $this;
    }
    
    /**
     * Get fechaRacc
     *
     * @return date
     */
    public function getFechaRacc()
    {
        return $this->fechaRacc;
    }
    
    /**
     * Set racd
     *
     * @param boolean $racd
     * @return CuentasPersonales
     */
    public function setRacd($racd)
    {
        $this->racd = $racd;
        return $this;
    }
    
    /**
     * Get racd
     *
     * @return boolean
     */
    public function getRacd()
    {
        return $this->racd;
    }
    
    
    /**
     * Add datosTelefonicos
     *
     * @param \AppBundle\Entity\DatosTelefonicos $datosTelefonicos
     * @return CuentasPersonales
     */
    public function addDatosTelefonico(\AppBundle\Entity\DatosTelefonicos $datosTelefonicos)
    {
        $this->datosTelefonicos[] = $datosTelefonicos;
        $datosTelefonicos->setCuentaPersonal($this);
        
        return $this;
    }
    
    /**
     * Remove datosTelefonicos
     *
     * @param \AppBundle\Entity\DatosTelefonicos $datosTelefonicos
     */
    public function removeDatosTelefonico(\AppBundle\Entity\DatosTelefonicos $datosTelefonicos)
    {
        $this->datosTelefonicos->removeElement($datosTelefonicos);
    }
    
    /**
     * Get datosTelefonicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDatosTelefonicos()
    {
        return $this->datosTelefonicos;
    }
    
    
    public function __toString()
    {
        return $this->getNcuentaPersonal();
    }
}
