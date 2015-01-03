<?php

namespace Chollosoft\RiescoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Chollosoft\RiescoBundle\Entity\Compra;
use Chollosoft\RiescoBundle\Form\CarroType;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;



class CRUDController extends Controller
{
	public function entregadoAction()
	{

		$id = $this->get('request')->get($this->admin->getIdParameter());
		$em = $this->getDoctrine ()->getManager ();
		$entity = $em->getRepository ( 'CarniceriaBundle:Compra' )->find ( $id );
		$this->actualizarValores($entity,"Entregado");
		$entity->setEstado('entregado');
		$em->flush();
				
		$this->addFlash('sonata_flash_success', 'Se cambio de estado correctamente');
		
		return new RedirectResponse($this->admin->generateUrl('show',array("id" => $id)));
	}
	
	public function canceladoAction(){
		$id = $this->get('request')->get($this->admin->getIdParameter());
		
		$em = $this->getDoctrine ()->getManager ();
		$entity = $em->getRepository ( 'CarniceriaBundle:Compra' )->find ( $id );
		$this->actualizarValores($entity,"Cancelado");
		
		$entity->setEstado('cancelado');
		$em->flush();
				
		$this->addFlash('sonata_flash_success', 'Se cambio de estado correctamente');
		
		return new RedirectResponse($this->admin->generateUrl('show',array("id" => $id)));
	}
	
	public function revisadoAction(){
		$id = $this->get('request')->get($this->admin->getIdParameter());
		
		$em = $this->getDoctrine ()->getManager ();
		$entity = $em->getRepository ( 'CarniceriaBundle:Compra' )->find ( $id );
		$this->actualizarValores($entity,"Revisado");
		$entity->setEstado('revisado');
		$em->flush();
				
		$this->addFlash('sonata_flash_success', 'Se cambio de estado correctamente');
		
		return new RedirectResponse($this->admin->generateUrl('show',array("id" => $id)));
	
	}
	
	private function actualizarValores($compra, $nuevoEstado){
		$em = $this->getDoctrine ()->getManager ();

		if($compra->getEstado() == "Entregado" && $nuevoEstado=="Cancelado"){
			
			$carros = $em->getRepository('CarniceriaBundle:Carro')->findBy(array('usuarioSession' => $compra->getUsuarioSession() ));
			foreach($carros as $carro){
				$producto = $em->getRepository('CarniceriaBundle:Producto')->findOneById($carro->getIdProducto()->getId());
					
				$nuevoStock = $producto->getStock() + $carro->getCantidad();
				$producto->setStock($nuevoStock);
					
				$em->persist($producto);
				$em->flush();
			}
			
			
		}elseif($compra->getEstado() == "Revisado" && $nuevoEstado=="Entregado"){
			$carros = $em->getRepository('CarniceriaBundle:Carro')->findBy(array('usuarioSession' => $compra->getUsuarioSession() ));
			foreach($carros as $carro){
				$producto = $em->getRepository('CarniceriaBundle:Producto')->findOneById($carro->getIdProducto()->getId());
				 
				$nuevoStock = $producto->getStock() - $carro->getCantidad();
				$producto->setStock($nuevoStock);
				 
				$em->persist($producto);
				$em->flush();
			}
		
		}
	}
}
