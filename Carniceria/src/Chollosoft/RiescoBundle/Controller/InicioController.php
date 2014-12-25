<?php

namespace Chollosoft\RiescoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class InicioController extends Controller
{
    /**
     * @Route("/inicio", name="inicio")
     * @Template()
     */
    public function inicioAction()
    {
        return array(
                // ...
            );    }
        /**
        * @Route("/contacto", name="contacto")
        * @Template()
        */
     public function contactoAction(){

     	return array();
     }   

}
