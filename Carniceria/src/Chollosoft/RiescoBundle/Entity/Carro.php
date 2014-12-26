<?php

namespace Chollosoft\RiescoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carro
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Carro
{

   /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="usuarioSession", type="string", length=255, nullable=false)
     */
    private $usuarioSession;

    /**
     * @var integer
     * 
     * @ORM\OneToOne(targetEntity="Producto")
     */
    private $idProducto;

    /**
     * @var integer
     * 
     * @ORM\Column(name="precioProducto", type="decimal", nullable=false)
     */
    private $precioProducto;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;


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
     * Set usuarioSession
     *
     * @param string $usuarioSession
     * @return Carro
     */
    public function setUsuarioSession($usuarioSession)
    {
        $this->usuarioSession = $usuarioSession;

        return $this;
    }

    /**
     * Get usuarioSession
     *
     * @return string 
     */
    public function getUsuarioSession()
    {
        return $this->usuarioSession;
    }

    /**
     * Set idProducto
     *
     * @param integer $idProducto
     * @return Carro
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return integer 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set precioProducto
     *
     * @param integer $precioProducto
     * @return Carro
     */
    public function setPrecioProducto($precioProducto)
    {
        $this->precioProducto = $precioProducto;

        return $this;
    }

    /**
     * Get precioProducto
     *
     * @return integer 
     */
    public function getPrecioProducto()
    {
        return $this->precioProducto;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Carro
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
    public function __toString(){
    	
    	if($this->getIdProducto()!= null){
    		return $this->getIdProducto()->getNombre() . " ". $this->getPrecioProducto(); ; 
    	}
    	return "sin producto";
    }
}
