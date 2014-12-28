<?php

// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Chollosoft\RiescoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CompraAdmin extends Admin
{
	protected $baseRouteName = 'compra_admin';
	
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		
		

		$formMapper
		->add('usuarioSession')
		->add('fechaCompra')
		->add('total')
		->add('telefono')
		->add('cliente')
		->add('direccion')
		->add('estado', 'choice', array('choices' => array('Revisado' => 'Revisado', 'Entregado' => 'Entregado','PorRevisar' => 'PorRevisar','Cancelado' => 'Cancelado')))
		->add('carros', 'sonata_type_model', array('required' => false, 'expanded' => false, 'multiple' => true, 'label' => 'Productos'))
		
		
		//->add('categorias', 'entity', array('label' => 'Categorias','class' => 'Chollosoft\RiescoBundle\Entity\Categoria'))
		//->add('author', 'entity', array())
		//->add('body') //if no type is specified, SonataAdminBundle tries to guess it
		;
	}

	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('usuarioSession')
		->add('fechaCompra')
		->add('total')
		->add('telefono')
		->add('cliente')
		->add('direccion')
		->add('estado', 'doctrine_orm_choice', array('choices' => array('Revisado' => 'Revisado', 'Entregado' => 'Entregado','PorRevisar' => 'PorRevisar','Cancelado' => 'Cancelado')))

		//->add('idCarro')
		
		;
	}

	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('usuarioSession')
		->add('fechaCompra')
		->add('total', 'currency', array('currency' => '€'))
		->add('cliente')
		->add('direccion')
		->add('telefono')
		->add('estado', 'string', array('template' => 'CarniceriaBundle:Partials:estado_partial.html.twig'))
		->add('Productos', 'sonata_type_model',array('template' => 'CarniceriaBundle:Partials:list_partial.html.twig'))

		//->add('idCarro')
		
		
		;
	}
}