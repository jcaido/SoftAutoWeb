<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\CuentapersonalToNumberTransformer;

class REBUAutoFacturasType extends AbstractType
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
            ->add('marca', 'text', array('label' => 'Marca', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'marca')))
            ->add('modelo', 'text', array('label' => 'Modelo', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'modelo')))
            ->add('matricula', 'text', array('label'=> 'Matrícula', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'matricula')))
            ->add('importe', 'money', array('label' => 'Importe', 'required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'importe')))
            ->add('aceptar', 'submit')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\REBUAutoFacturas',
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
        return 'RebuAutoFacturas';
    }
}


