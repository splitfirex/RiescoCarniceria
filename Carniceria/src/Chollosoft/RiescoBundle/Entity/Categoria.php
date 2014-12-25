<?php

namespace Chollosoft\RiescoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Categoria {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer")
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="nombre", type="string", length=50, unique=true)
	 */
	private $nombre;
	
	/**
	 *
	 * @var string @ORM\Column(name="descripcion", type="string", length=255)
	 */
	private $descripcion;
	
	/**
	 *
	 * @var Productos @ORM\ManyToMany(targetEntity="Producto", mappedBy="categorias", fetch="EXTRA_LAZY")
	 */
	private $productos;
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set nombre
	 *
	 * @param string $nombre        	
	 * @return Categoria
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
		
		return $this;
	}
	
	/**
	 * Get nombre
	 *
	 * @return string
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * Set descripcion
	 *
	 * @param string $descripcion        	
	 * @return Categoria
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
		
		return $this;
	}
	
	/**
	 * Get descripcion
	 *
	 * @return string
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	public function __toString() {
		return $this->nombre;
	}
	public function getProductos() {
		return $this->productos;
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
}
