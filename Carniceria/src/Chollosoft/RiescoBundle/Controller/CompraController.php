<?php

namespace Chollosoft\RiescoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Chollosoft\RiescoBundle\Entity\Compra;
use Chollosoft\RiescoBundle\Entity\Carro;
use Chollosoft\RiescoBundle\Form\CompraType;

/**
 * Compra controller.
 *
 * @Route("/compra")
 */
class CompraController extends Controller
{

    /**
     * Lists all Compra entities.
     *
     * @Route("/", name="compra")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarniceriaBundle:Compra')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Compra entity.
     *
     * @Route("/", name="compra_create")
     * @Method("POST")
     * @Template("CarniceriaBundle:Compra:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Compra();
        //$form = $this->createCreateForm($entity);
        $session = $this->get('session');
        $session->start();
        $entity->setUsuarioSession($session->getId());
        $entity->setCliente($request->request->get ( 'name' ));
        $entity->setTelefono($request->request->get ( 'telefono' ));
        $entity->setDireccion($request->request->get ( 'direccion' ));
        $entity->setEstado("PorRevisar");
        $entity->setTotal(2000.32);
       // $form->handleRequest($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

        $carros = $em->getRepository('CarniceriaBundle:Carro')->findBy(array('usuarioSession' => $session->getId() ));

        $entity->setCarros($carros); 

            $em->persist($entity);
            $em->flush();
     $session->invalidate();
            return $this->redirect($this->generateUrl('compra_show', array('id' => $entity->getusuarioSession())));
   
        //}

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Compra entity.
     *
     * @param Compra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Compra $entity)
    {
        $form = $this->createForm(new CompraType(), $entity, array(
            'action' => $this->generateUrl('compra_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Compra entity.
     *
     * @Route("/new", name="compra_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Compra();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    
    public function cloneAction(){
    	$id = $this->get('request')->get($this->admin->getIdParameter());
    	
    	$object = $this->admin->getObject($id);
    	
    	if (!$object) {
    		throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
    	}
    	
    	return new RedirectResponse($this->admin->generateUrl('list'));
    }
    
    /**
     * Finds and displays a Compra entity.
     *
     * @Route("/{id}", name="compra_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarniceriaBundle:Compra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Compra entity.
     *
     * @Route("/{id}/edit", name="compra_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarniceriaBundle:Compra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compra entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Compra entity.
    *
    * @param Compra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Compra $entity)
    {
        $form = $this->createForm(new CompraType(), $entity, array(
            'action' => $this->generateUrl('compra_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Compra entity.
     *
     * @Route("/{id}", name="compra_update")
     * @Method("PUT")
     * @Template("CarniceriaBundle:Compra:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarniceriaBundle:Compra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('compra_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Compra entity.
     *
     * @Route("/{id}", name="compra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CarniceriaBundle:Compra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Compra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('compra'));
    }

    /**
     * Creates a form to delete a Compra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compra_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
