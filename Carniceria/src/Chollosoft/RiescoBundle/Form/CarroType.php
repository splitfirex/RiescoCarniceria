<?php

namespace Chollosoft\RiescoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuarioSession')
            ->add('precioProducto')
            ->add('cantidad')
            ->add('idProducto')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Chollosoft\RiescoBundle\Entity\Carro'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chollosoft_riescobundle_carro';
    }
}
