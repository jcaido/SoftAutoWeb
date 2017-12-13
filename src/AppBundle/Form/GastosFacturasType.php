<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\CuentapersonalToNumberTransformer;

class GastosFacturasType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new CuentapersonalToNumberTransformer($entityManager);
        
        $builder->add(
            $builder->create('cuentaPersonal', 'text', array('label' => 'Acreedor', 'attr' => array('class' => 'form-control', 'placeholder' => 'acreedor')))
                ->addModelTransformer($transformer)
        );
        
        $builder
            ->add('fechaFactura', 'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'label' => 'Fecha Factura', 'attr' => array('size' => 10)))
            ->add('numeroFactura', 'text', array('label'=> 'Número de Factura', 'attr' => array('class' => 'form-control', 'placeholder' => 'nº. de factura')))
            ->add('gastoGastosFacturas', 'collection', array(
                    'type' => new GastoGastosFacturasType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
            ))
            ->add('tipoIRPF', 'entity', array('class' => 'AppBundle:TiposIRPF', 'choice_value' => 'porcentaje', 'attr' => array('class' => 'form-control')))
            ->add('aceptar', 'submit')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GastosFacturas',
            'cascade_validation' => true
        ));
        
        $resolver->setRequired(array(
            'em',
        ));
        
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'GastosFacturas';
    }
}


