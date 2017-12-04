<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodigosPostalesType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cp', 'text', array('label' => 'Código Postal', 'attr' => array('class' => 'form-control', 'placeholder' => 'Código Postal')))
            ->add('localidad', 'text', array('label'=> 'Localidad', 'attr' => array('class' => 'form-control', 'placeholder' => 'Localidad', 'oninvalid' => 'this.setCustomValidity("Debe introducir una localidad")')))
            ->add('provincia', 'text', array('label' => 'Provinca', 'attr' => array('class' => 'form-control', 'placeholder' => 'Provincia', 'oninvalid' => 'this.setCustomValidity("Debe introducir una provincia")')))
            ->add('pais', 'text', array('label' => 'Pais', 'attr' => array('class' => 'form-control', 'placeholder' => 'Pais', 'oninvalid' => 'this.setCustomValidity("Debe introducir un NIF/CIF")')))
            ->add('aceptar', 'submit', array('attr' => array('class' => 'btn btn-primary btn-sm')))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CodigosPostales', 
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'codigosPostales';
    }
}


