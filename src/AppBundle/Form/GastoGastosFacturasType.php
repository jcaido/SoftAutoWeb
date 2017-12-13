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
            ->add('retencion', 'checkbox', array('label' => 'Retención', 'required' => false))
            ->add('ctaContable', 'cuenta_contable', array('label' => 'Cta. Contable', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Cta. Contable', 'oninvalid' => 'this.setCustomValidity("Debe introducir una Cuenta Contable")'))) //campo personalizado con transformador de datos (CuentaContableType.php)
            ->add('concepto', 'text', array('label' => 'concepto', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Concepto', 'oninvalid' => 'this.setCustomValidity("Debe introducir el concepto")')))
            ->add('tipoIva', 'entity', array('class' => 'AppBundle:TiposIva', 'choice_value' =>'porcentaje', 'attr' => array('class' => 'form-control')))
            ->add('importe', 'money', array('label' => 'importe', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Importe', 'oninvalid' => 'this.setCustomValidity("Debe introducir el importe")')))
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


