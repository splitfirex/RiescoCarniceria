<?php

namespace Chollosoft\RiescoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compra
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Compra
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCompra", type="datetime")
     */
    private $fechaCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="usuarioSession", type="string", length=255, nullable=false)
     */
    private $usuarioSession;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="Carro")
     * @ORM\JoinTable(name="Carro_Compra",
     *      joinColumns={@ORM\JoinColumn(name="usuarioSession", referencedColumnName="usuarioSession")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="carro_id", referencedColumnName="id", unique=true)}
     *      )
     * 
     */
    private $idCarro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreCliente", type="string", length=255, nullable=false)
     */
    private $nombreCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer", nullable=false)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, columnDefinition="ENUM('Revisado', 'Entregado','PorRevisar','Cancelado')")
     */
    private $estado;


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
     * Set fechaCompra
     *
     * @param \DateTime $fechaCompra
     * @return Compra
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;

        return $this;
    }

    /**
     * Get fechaCompra
     *
     * @return \DateTime 
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }

    /**
     * Set usuarioSession
     *
     * @param string $usuarioSession
     * @return Compra
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
     * Set idCarro
     *
     * @param \stdClass $idCarro
     * @return Compra
     */
    public function setIdCarro($idCarro)
    {
        $this->idCarro = $idCarro;

        return $this;
    }

    /**
     * Get idCarro
     *
     * @return \stdClass 
     */
    public function getIdCarro()
    {
        return $this->idCarro;
    }

    /**
     * Set nombreCliente
     *
     * @param string $nombreCliente
     * @return Compra
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * Get nombreCliente
     *
     * @return string 
     */
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Compra
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
     * Set total
     *
     * @param integer $total
     * @return Compra
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Compra
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
