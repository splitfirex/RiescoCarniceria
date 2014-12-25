<?php

// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Chollosoft\RiescoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductoAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('nombre', 'text', array('label' => 'Nombre Producto'))
		->add('descripcion', 'text', array('label' => 'Descripcion'))
		->add('precio', 'number')
		->add('stock', 'integer', array('label' => 'En inventario'))
		->add('alarmaStock', 'integer', array('label' => 'Alarma de inventario'))
		->add('categorias', 'sonata_type_model', array('required' => false, 'expanded' => false, 'multiple' => true, 'label' => 'Categorias'))
		->add('file', 'file', array('required' => false))
		//->add('categorias', 'entity', array('label' => 'Categorias','class' => 'Chollosoft\RiescoBundle\Entity\Categoria'))
		//->add('author', 'entity', array())
		//->add('body') //if no type is specified, SonataAdminBundle tries to guess it
		;
	}

	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('nombre')
		->add('descripcion')
		;
	}

	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('nombre')
		->add('descripcion')
		->add('stock')
		->add('alarmaStock')
		->add('categorias')
		;
	}
}