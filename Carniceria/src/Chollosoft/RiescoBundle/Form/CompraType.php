<?php

namespace Chollosoft\RiescoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCompra')
            ->add('usuarioSession')
            ->add('cliente')
            ->add('telefono')
            ->add('direccion')
            ->add('total')
            ->add('estado')
            ->add('carros')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Chollosoft\RiescoBundle\Entity\Compra'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chollosoft_riescobundle_compra';
    }
}
