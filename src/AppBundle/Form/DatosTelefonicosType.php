<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatosTelefonicosType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telefono', 'text', array('label' => 'nº. de teléfono', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'nº. de teléfono', 'oninvalid' => 'this.setCustomValidity("Debe introducir un nº. de teléfono")')))
            ->add('observaciones', 'text', array('label' => 'observaciones', 'attr' => array('class' => 'form-control', 'placeholder' => 'observaciones')))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DatosTelefonicos',
            'cascade_validation' => true
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'datosTelefonicos';
    }
}


