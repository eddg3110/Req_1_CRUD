<?php

namespace SiSu\CuentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SiSu\CuentaBundle\Entity\Estado;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="SiSu\CuentaBundle\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreUsuario", type="string", length=30, unique=true)
     */
    private $nombreUsuario;

    /**
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="usuarios")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    protected $estado;
    
    /**
     * @ORM\ManyToOne(targetEntity="Municipio", inversedBy="usuarios")
     * @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
     */
    protected $municipio;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia", inversedBy="usuarios")
     * @ORM\JoinColumn(name="parroquia_id", referencedColumnName="id")
     */
    protected $parroquia;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreUsuario
     *
     * @param string $nombreUsuario
     *
     * @return Usuario
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    /**
     * Get nombreUsuario
     *
     * @return string
     */
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    /**
     * Set estado
     *
     * @param \SiSu\CuentaBundle\Entity\Estado $estado
     *
     * @return Usuario
     */
    public function setEstado(\SiSu\CuentaBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \SiSu\CuentaBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set municipio
     *
     * @param \SiSu\CuentaBundle\Entity\Municipio $municipio
     *
     * @return Usuario
     */
    public function setMunicipio(\SiSu\CuentaBundle\Entity\Municipio $municipio = null)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return \SiSu\CuentaBundle\Entity\Municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set parroquia
     *
     * @param \SiSu\CuentaBundle\Entity\Parroquia $parroquia
     *
     * @return Usuario
     */
    public function setParroquia(\SiSu\CuentaBundle\Entity\Parroquia $parroquia = null)
    {
        $this->parroquia = $parroquia;

        return $this;
    }

    /**
     * Get parroquia
     *
     * @return \SiSu\CuentaBundle\Entity\Parroquia
     */
    public function getParroquia()
    {
        return $this->parroquia;
    }
    
    public function __toString()
    {
    	return $this->nombreUsuario;
    }
}
