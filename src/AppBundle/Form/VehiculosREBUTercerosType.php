<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculosREBUTercerosType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marca', 'text', array('label' => 'marca', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'marca', 'oninvalid' => 'this.setCustomValidity("Debe introducir una marca de vehiculo")')))
            ->add('modelo', 'text', array('label' => 'modelo', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'modelo', 'oninvalid' => 'this.setCustomValidity("Debe introducir el modelo")')))
            ->add('matricula', 'text', array('label' => 'matricula', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'matricula', 'oninvalid' => 'this.setCustomValidity("Debe introducir la matrícula")')))
            ->add('importe', 'money', array('label' => 'importe', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'importe', 'oninvalid' => 'this.setCustomValidity("Debe introducir el importe")')))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\VehiculosREBUTerceros',
            'cascade_validation' => true
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'vehiculosREBUTerceros';
    }
}


