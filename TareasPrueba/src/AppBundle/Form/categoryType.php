<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class categoryType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('products', 'collection', array(
            'type' => new productType(),
            'allow_add' => true,
            'by_reference' => false,
        ));
        $builder->add('aceptar', 'submit');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category', 
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'category';
    }
}


