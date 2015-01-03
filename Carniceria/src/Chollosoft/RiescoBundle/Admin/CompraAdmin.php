<?php

// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Chollosoft\RiescoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CompraAdmin extends Admin
{
	protected $baseRouteName = 'compra_admin';
	public $supportsPreviewMode = true;


	protected function configureRoutes(RouteCollection $collection)
	{
		$collection->add('revisado', $this->getRouterIdParameter().'/revisado');
		$collection->add('cancelado', $this->getRouterIdParameter().'/cancelado');
		$collection->add('entregado', $this->getRouterIdParameter().'/entregado');
	}
	
	public function getTemplate($name)
	{
		switch ($name) {
			case 'preview':
			return 'CarniceriaBundle:Admin:compraedit.html.twig';
			break;
			default:
			return parent::getTemplate($name);
			break;
		}
	}


	protected function configureShowFields(ShowMapper $showMapper)
	{
        // Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
		$showMapper

            /*
             * The default option is to just display the value as text (for boolean this will be 1 or 0)
             */

            ->with('Compra')
            ->add('fechaCompra')
            ->add('usuarioSession',null, array('label' => 'Identificador del cliente'))
            ->add('cliente')
            ->add('telefono')
            ->add('direccion')
            ->add('total','currency', array('currency' => '€'))
            ->add('estado', 'string', array('template' => 'CarniceriaBundle:Partials:estado_partial_compra.html.twig','label' => 'Estado'))
            ->add('CambiarEstado', 'string', array('template' => 'CarniceriaBundle:Partials:cambiarestado_partial_compra.html.twig','label' => 'Estado'))

            //->add('usuarioSession','string', array('template' => 'CarniceriaBundle:Partials:estado_partial.html.twig','label' => 'Estado'))
            ->end()
            
    
            ->with('Productos')
            ->add('Productos', 'sonata_type_model',array('template' => 'CarniceriaBundle:Partials:list_partial_show.html.twig'))

            ->end()
            ;

        }

	// Fields to be shown on create/edit forms
        protected function configureFormFields(FormMapper $formMapper)
        {



        	$formMapper
        	->tab("Compra")
        	->with('Compra')
        	->add('usuarioSession',"text", array('label' => 'Identificador del cliente'))
        	->add('fechaCompra')
        	->add('total')
        	->add('telefono')
        	->add('cliente')
        	->add('direccion')
        	->add('estado', 'choice', array('choices' => array('Revisado' => 'Revisado', 'Entregado' => 'Entregado','PorRevisar' => 'PorRevisar','Cancelado' => 'Cancelado')))

        	->end()
        	->end()
        	->tab("Productos")
        	->with('Productos')
        	->add('carros', 'sonata_type_model', array('required' => false, 'expanded' => false, 'multiple' => true, 'label' => 'Productos'))
        	->end()
        	->end()



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
        	        	->add('_action', 'actions', array(
            'actions' => array(
                'show' => array(),
                'edit' => array(),
            )
        	))
        	->add('usuarioSession','text',array('label' => 'Id Compra' ))
        	->add('fechaCompra')

        	->add('total', 'currency', array('currency' => '€'))
        	->add('cliente')
        	->add('direccion')
        	->add('telefono')
        	->add('estado', 'string', array('template' => 'CarniceriaBundle:Partials:estado_partial.html.twig'))
        	//->add('Productos', 'sonata_type_model',array('template' => 'CarniceriaBundle:Partials:list_partial.html.twig'))


		//->add('idCarro')


        	;
        }
    }