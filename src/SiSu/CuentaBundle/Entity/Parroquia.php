<?php

namespace SiSu\CuentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Parroquia
 *
 * @ORM\Table(name="parroquia")
 * @ORM\Entity(repositoryClass="SiSu\CuentaBundle\Repository\ParroquiaRepository")
 */
class Parroquia
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
     * @ORM\Column(name="nombreParroquia", type="string", length=30)
     */
    private $nombreParroquia;

    /**
     * @ORM\ManyToOne(targetEntity="Municipio", inversedBy="parroquias")
     * @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
     */
    protected $municipio;

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="parroquia")
     */
    protected $usuarios;
    
    public function __construct()
    {
    	$this->usuarios = new ArrayCollection();
    }
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
     * Set nombreParroquia
     *
     * @param string $nombreParroquia
     *
     * @return Parroquia
     */
    public function setNombreParroquia($nombreParroquia)
    {
        $this->nombreParroquia = $nombreParroquia;

        return $this;
    }

    /**
     * Get nombreParroquia
     *
     * @return string
     */
    public function getNombreParroquia()
    {
        return $this->nombreParroquia;
    }

    /**
     * Set municipio
     *
     * @param \SiSu\CuentaBundle\Entity\Municipio $municipio
     *
     * @return Parroquia
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
     * Add usuario
     *
     * @param \SiSu\CuentaBundle\Entity\Usuario $usuario
     *
     * @return Parroquia
     */
    public function addUsuario(\SiSu\CuentaBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \SiSu\CuentaBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\SiSu\CuentaBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
    
    public function __toString()
    {
    	return $this->nombreParroquia;
    }
}
