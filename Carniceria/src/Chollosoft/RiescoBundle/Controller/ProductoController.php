<?php

namespace Chollosoft\RiescoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Chollosoft\RiescoBundle\Entity\Producto;
use Chollosoft\RiescoBundle\Form\ProductoType;

/**
 * Producto controller.
 *
 * @Route("/producto")
 */
class ProductoController extends Controller
{

    /**
     * Lists all Producto entities.
     *
     * @Route("/", name="producto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarniceriaBundle:Producto')->findAll();

        $categorias = $em->getRepository('CarniceriaBundle:Categoria')->findAll();

     
        
        return array(
            'entities' => $entities,
        	'categorias' => $categorias
        );
    }


   /**
     * Lists all Producto entities.
     *
     * @Route("/{id}", name="producto_filt")
     * @Method("GET")
     * @Template("CarniceriaBundle:Producto:index.html.twig")
     */
    public function filtradoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarniceriaBundle:Producto')->findAll();

        $categorias = $em->getRepository('CarniceriaBundle:Categoria')->findAll();

     
        
        return array(
            'entities' => $entities,
            'categorias' => $categorias
        );
    }
    
    
    /**
     * Lists all Producto entities.
     *
     * @Route("/listar", name="producto_listar")
     * @Method("GET")
     * @Template()
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entities = $em->getRepository('CarniceriaBundle:Producto')->findAll();
    
    	$serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');
    	
    	return new Response($serializedEntity);

    }
    

  
    /**
     * Finds and displays a Producto entity.
     *
     * @Route("/show/{id}", name="producto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarniceriaBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

 
}
