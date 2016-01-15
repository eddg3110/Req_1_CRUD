<?php

namespace SiSu\CuentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="SiSu\CuentaBundle\Repository\EstadoRepository")
 */
class Estado
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
     * @ORM\Column(name="nombreEstado", type="string", length=30)
     */
    private $nombreEstado;


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
     * Set nombreEstado
     *
     * @param string $nombreEstado
     *
     * @return Estado
     */
    public function setNombreEstado($nombreEstado)
    {
        $this->nombreEstado = $nombreEstado;

        return $this;
    }

    /**
     * Get nombreEstado
     *
     * @return string
     */
    public function getNombreEstado()
    {
        return $this->nombreEstado;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="estado")
     */
    protected $usuarios;
    
    /**
     * @ORM\OneToMany(targetEntity="Municipio", mappedBy="estado")
     */
    protected $municipios;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->usuarios = new ArrayCollection();
    	$this->municipios = new ArrayCollection();
    }
    
    /**
     * Add usuario
     *
     * @param \SiSu\CuentaBundle\Entity\Usuario $usuario
     *
     * @return Estado
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

    /**
     * Add municipio
     *
     * @param \SiSu\CuentaBundle\Entity\Municipio $municipio
     *
     * @return Estado
     */
    public function addMunicipio(\SiSu\CuentaBundle\Entity\Municipio $municipio)
    {
        $this->municipios[] = $municipio;

        return $this;
    }

    /**
     * Remove municipio
     *
     * @param \SiSu\CuentaBundle\Entity\Municipio $municipio
     */
    public function removeMunicipio(\SiSu\CuentaBundle\Entity\Municipio $municipio)
    {
        $this->municipios->removeElement($municipio);
    }

    /**
     * Get municipios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMunicipios()
    {
        return $this->municipios;
    }
    
    public function __toString()
    {
    	return $this->nombreEstado;
    }
}
