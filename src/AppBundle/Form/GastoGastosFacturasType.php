<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\CuentaContableToNumberTransformer;

class GastoGastosFacturasType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('retencion', 'checkbox', array('label' => 'Retención', 'required' => true))
            ->add('ctaContable', 'cuenta_contable') //campo personalizado con transformador de datos (CuentaContableType.php)
            ->add('concepto', 'text', array('label' => 'concepto', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'concepto', 'oninvalid' => 'this.setCustomValidity("Debe introducir el concepto")')))
            ->add('tipoIva')
            ->add('importe', 'money', array('label' => 'importe', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'importe', 'oninvalid' => 'this.setCustomValidity("Debe introducir el importe")')))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GastoGastosFacturas',
            'cascade_validation' => true
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'GastoGastosFacturas';
    }
}


