<?php

// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Chollosoft\RiescoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoriaAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		
		// get the current Image instance
		
		
		$formMapper
		->add('nombre', 'text', array('label' => 'Nombre Categoria'))
		->add('descripcion', 'text', array('label' => 'Descripcion'))
		->add('file', 'file', $fileFieldOptions)
		->add('categorias', 'sonata_type_model', array('required' => false, 'expanded' => false, 'multiple' => true, 'label' => 'Categorias'))
		
		//->add('author', 'entity', array('class' => 'Acme\DemoBundle\Entity\User'))
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
		;
	}
	
	
}