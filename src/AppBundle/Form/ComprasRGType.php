<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\CuentapersonalToNumberTransformer;

class ComprasRGType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new CuentapersonalToNumberTransformer($entityManager);
        
        $builder->add(
            $builder->create('cuentaPersonal', 'text', array('label' => 'Proveedor', 'attr' => array('class' => 'form-control', 'placeholder' => 'proveedor')))
                ->addModelTransformer($transformer)
        );
        
        $builder
            ->add('fechaFactura', 'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'label' => 'Fecha Factura', 'attr' => array('size' => 10)))
            ->add('numeroFactura', 'text', array('label'=> 'Número de Factura', 'attr' => array('class' => 'form-control', 'placeholder' => 'nº. de factura')))
            ->add('comprasRGVehiculos', 'collection', array(
                    'type' => new VehiculosComprasRGType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
            ))
            ->add('tipoIva')
            ->add('aceptar', 'submit')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ComprasRG',
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
        return 'ComprasRG';
    }
}


