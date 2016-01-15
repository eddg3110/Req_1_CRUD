<?php

namespace SiSu\CuentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Municipio
 *
 * @ORM\Table(name="municipio")
 * @ORM\Entity(repositoryClass="SiSu\CuentaBundle\Repository\MunicipioRepository")
 */
class Municipio
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
     * @ORM\Column(name="nombreMunicipio", type="string", length=30)
     */
    private $nombreMunicipio;

    /**
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="municipios")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    protected $estado;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia", mappedBy="municipio")
     */
    protected $parroquias;
 
    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="municipio")
     */
    protected $usuarios;
    
    /**
     * Constructor
     */
    
    public function __construct()
    {
    	$this->parroquias = new ArrayCollection();
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
     * Set nombreMunicipio
     *
     * @param string $nombreMunicipio
     *
     * @return Municipio
     */
    public function setNombreMunicipio($nombreMunicipio)
    {
        $this->nombreMunicipio = $nombreMunicipio;

        return $this;
    }

    /**
     * Get nombreMunicipio
     *
     * @return string
     */
    public function getNombreMunicipio()
    {
        return $this->nombreMunicipio;
    }

    /**
     * Set estado
     *
     * @param \SiSu\CuentaBundle\Entity\Estado $estado
     *
     * @return Municipio
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
     * Add parroquia
     *
     * @param \SiSu\CuentaBundle\Entity\Parroquia $parroquia
     *
     * @return Municipio
     */
    public function addParroquia(\SiSu\CuentaBundle\Entity\Parroquia $parroquia)
    {
        $this->parroquias[] = $parroquia;

        return $this;
    }

    /**
     * Remove parroquia
     *
     * @param \SiSu\CuentaBundle\Entity\Parroquia $parroquia
     */
    public function removeParroquia(\SiSu\CuentaBundle\Entity\Parroquia $parroquia)
    {
        $this->parroquias->removeElement($parroquia);
    }

    /**
     * Get parroquias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParroquias()
    {
        return $this->parroquias;
    }

    /**
     * Add usuario
     *
     * @param \SiSu\CuentaBundle\Entity\Usuario $usuario
     *
     * @return Municipio
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
    	return $this->nombreMunicipio;
    }
}
