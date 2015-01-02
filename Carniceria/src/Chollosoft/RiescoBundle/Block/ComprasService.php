<?php

// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Chollosoft\RiescoBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

class ComprasService extends BaseBlockService
{
	private $em;

	public function __construct($name, $templating, \Doctrine\ORM\EntityManager $entityManager)
	{
		parent::__construct($name, $templating);
		$this->em = $entityManager;
	}
	
    public function getName()
    {
        return 'My Newsletter';
    }

    public function getDefaultSettings()
    {
        return array();
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
    // merge settings
        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());
        
        $entities = $this->em->getRepository('CarniceriaBundle:Compra')->findBy(array(), array('fechaCompra'=>'desc'),20);

        return $this->renderResponse('CarniceriaBundle:Partials:Comprasblock_partial.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
        	'compras'	=> $entities
            ), $response);
    }
}

