<?php

namespace Chollosoft\RiescoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerAware;

/**
 * Compra
 *
 * @ORM\Table() 
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Compra implements ObjectManagerAware
{
	private $em;
	public function injectObjectManager(ObjectManager $objectManager, ClassMetadata $classMetadata)
	{
		$this->em = $objectManager;
	}
	
    /**
     * @var \DateTime
     * @ORM\Column(name="fechaCompra", type="datetime", nullable=false)
     */
    private $fechaCompra;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="usuarioSession", type="string", length=255, nullable=false)
     * 
     */
    private $usuarioSession;

    /**
     * @var \stdClass
     *
     * 
     * @ORM\ManyToMany(targetEntity="Carro")
     * @ORM\JoinTable(name="carro_compra",
     *      joinColumns={@ORM\JoinColumn(name="compra_id", referencedColumnName="usuarioSession")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="carro_id", referencedColumnName="id", unique=true)}
     *      )
     * 
     */
    private $carros;

    /**
     * @var string
     *
     * @ORM\Column(name="cliente", type="string", length=255, nullable=false)
     */
    private $cliente;


     /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var decimal
     *
     * @ORM\Column(name="total", type="decimal", nullable=false, precision=10, scale=2)
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
     * Set usuarioSession
     *
     * @param string $usuarioSession
     * @return Compra
     */
    public function setTelefono($usuarioSession)
    {
        $this->telefono = $usuarioSession;

        return $this;
    }

    /**
     * Get usuarioSession
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set idCarro
     *
     * @param \stdClass $idCarro
     * @return Compra
     */
    public function setCarros($idCarro)
    {
        $this->carros = $idCarro;

        return $this;
    }

    /**
     * Get idCarro
     *
     * @return \stdClass 
     */
    public function getCarros()
    {
        return $this->carros;
    }

    /**
     * Set nombreCliente
     *
     * @param string $nombreCliente
     * @return Compra
     */
    public function setCliente($nombreCliente)
    {
        $this->cliente = $nombreCliente;

        return $this;
    }

    /**
     * Get nombreCliente
     *
     * @return string 
     */
    public function getCliente()
    {
        return $this->cliente;
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
     * @param decimal $total
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
     * @return decimal 
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


     /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {


        $totalParcial = 0;
        foreach ($this->getCarros() as $valor){

            $totalParcial = $totalParcial + $valor->getPrecioProducto() * $valor->getCantidad();

        }

        $this->setTotal($totalParcial);

        if($this->getFechaCompra() == null)
        {
            $this->setFechaCompra(new \DateTime(date('Y-m-d H:i:s')));
        }
    }
}
