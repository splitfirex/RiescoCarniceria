<?php

namespace Chollosoft\RiescoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Producto
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Producto
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;


     /**
     * @var string
     *
     * @ORM\Column(name="unidadDeCompra", type="string", length=255, unique=true)
     */
    private $unidadDeCompra;

    /**
     * @var decimal
     *
     * @ORM\Column(name="precio", type="decimal")
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime")
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="alarmaStock", type="integer")
     */
    private $alarmaStock;

    /**
     * @var array
     *
	 * @ORM\ManyToMany(targetEntity="Categoria", fetch="EXTRA_LAZY")
	 * 
     */
    private $categorias;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
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
    public function getUnidadDeCompra()
    {
        return $this->unidadDeCompra;
    }


     /**
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
     */
    public function setUnidadDeCompra($unicompra)
    {
        $this->unidadDeCompra = $unicompra;

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
     * Set precio
     *
     * @param integer $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return integer 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Producto
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto2
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Producto
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Producto
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set alarmaStock
     *
     * @param integer $alarmaStock
     * @return Producto2
     */
    public function setAlarmaStock($alarmaStock)
    {
        $this->alarmaStock = $alarmaStock;

        return $this;
    }

    /**
     * Get alarmaStock
     *
     * @return integer 
     */
    public function getAlarmaStock()
    {
        return $this->alarmaStock;
    }

    /**
     * Set categorias
     *
     * @param array $categorias
     * @return Producto
     */
    public function setCategorias($categorias)
    {
        $this->categorias = $categorias;

        return $this;
    }

    /**
     * Get categorias
     *
     * @return array 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
    	$this->setFechaModificacion(new \DateTime(date('Y-m-d H:i:s')));
    
    	if($this->getFechaCreacion() == null)
    	{
    		$this->setFechaCreacion(new \DateTime(date('Y-m-d H:i:s')));
    	}
    }
    
    
// SECCION DE EL FICHERO DE IMAGEN
	
	/**
	 * Image file
	 *
	 * @var File
	 * @Assert\File(maxSize="6000000")
	 */
	private $file;
	
	/**
	 *
	 * @var string @ORM\Column(name="filename", type="string", length=255, nullable=true)
	 */
	private $filename;
	public function getFilename() {
		return $this->filename;
	}
	public function setFilename($filen) {
		$this->filename = $filen;
	}
	
	/**
	 * Sets file.
	 *
	 * @param UploadedFile $file        	
	 */
	public function setFile(\Symfony\Component\HttpFoundation\File\UploadedFile $file = null) {
		$this->file = $file;
	}
	
	/**
	 * Get file.
	 *
	 * @return UploadedFile
	 */
	public function getFile() {
		return $this->file;
	}
	
	/**
	 * Called after entity persistence
	 *
	 * @ORM\PostPersist()
	 * @ORM\PostUpdate()
	 */
	public function upload() {
		// the file property can be empty if the field is not required
		if (null === $this->getFile ()) {
			return;
		}
		
		// we use the original file name here but you should
		// sanitize it at least to avoid any security issues
		
		// move takes the target directory and target filename as params
		$this->getFile ()->move ( $_SERVER['DOCUMENT_ROOT'].'/web/uploads/', $this->getFile()->getClientOriginalName() );
		
		// set the path property to the filename where you've saved the file
		$this->setFilename ( $this->getFile()->getClientOriginalName() );
		
		// clean up the file property as you won't need it anymore
		$this->setFile ( null );
	}
	
	
	/**
	 * Called before saving the entity
	 *
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function preUpload()
	{
		if (null !== $this->file) {
			// do whatever you want to generate a unique name
			$filename = sha1(uniqid(mt_rand(), true));
			$this->filename = $this->getFile()->getClientOriginalName();
		}
	}
	
	
	/**
	 * Called before entity removal
	 *
	 * @ORM\PreRemove()
	 */
	public function removeUpload()
	{
		//if ($file = $this->getAbsolutePath()) {
		//	unlink($file);
		//}
	}
	
	public function __toString(){
		return $this->nombre;	
	
	}
    
}
