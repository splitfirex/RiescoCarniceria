<?php

// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Chollosoft\RiescoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CompraAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		
		

		$formMapper
		->add('usuarioSession')
		->add('fechaCompra')
		->add('total')
		->add('nombreCliente')
		->add('direccion')
		->add('estado')
		->add('idCarro', 'sonata_type_model', array('required' => false, 'expanded' => false, 'multiple' => true, 'label' => 'Productos'))
		
		
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
		->add('nombreCliente')
		->add('direccion')
		->add('estado')
		->add('idCarro')
		
		;
	}

	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('usuarioSession')
		->add('fechaCompra')
		->add('total')
		->add('nombreCliente')
		->add('direccion')
		->add('estado')
		->add('idCarro')
		
		
		;
	}
}