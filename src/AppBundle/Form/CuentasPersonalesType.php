<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\CodigopostalToNumberTransformer;

class CuentasPersonalesType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new CodigopostalToNumberTransformer($entityManager);
        
        $builder->add(
            $builder->create('cp', 'text', array('label' => 'Código Postal', 'attr' => array('class' => 'form-control', 'placeholder' => 'Código Postal')))
                ->addModelTransformer($transformer)
        );
        
        $builder
            ->add('cliente', 'checkbox', array('label' => 'Cliente', 'required' => false))
            ->add('proveedor', 'checkbox', array('label'=> 'Proveedor', 'required' => false))
            ->add('personaFisica', 'checkbox', array('label' => 'Persona física', 'required' => false))
            ->add('nombre', 'text', array('label' => 'Nombre', 'required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Nombre')))
            ->add('primerApellido', 'text', array('label' => 'Primer Apellido', 'required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Primer Apellido')))
            ->add('segundoApellido', 'text', array('label' => 'Segundo Apellido', 'required' => false, 'attr'=> array('class' => 'form-control', 'placeholder' => 'Segundo Apellido')))
            ->add('denominacionSocial', 'text', array('label' => 'Denominación social','required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Denominación social')))
            ->add('direccion', 'text', array('label' => 'Dirección', 'required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Dirección')))
            ->add('nifCif', 'text', array('label' => 'NIF / CIF', 'attr' => array('class' => 'form-control', 'placeholder' => 'NIF / CIF', 'oninvalid' => 'this.setCustomValidity("Debe introducir un NIF/CIF")')))
            ->add('email', 'email', array('label' => 'E-mail', 'required' => false, 'attr'=> array('class'=> 'form-control', 'placeholder' => 'E-mail', 'oninvalid' => 'this.setCustomValidity("Debe introducir una dirección de email válida")')))
            ->add('atdp','checkbox', array('label'=> 'Autorización al tratamiento de datos personales', 'required' => false))
            ->add('acdp', 'checkbox', array('label' => 'Autorización cesión de datos personales', 'required' => false))
            ->add('rdp', 'checkbox', array('label' => 'Rectificación de datos personales', 'required' => false))
            ->add('fechaRdp', 'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'label' => 'Fecha de rectificación', 'attr' => array('size' => 10)))
            ->add('rectccd', 'checkbox',array('label' => 'Rectificación comunicada al cesionario de los datos', 'required'=> false))
            ->add('rcdp', 'checkbox', array('label' => 'Revocación para la cesión de datos personales', 'required' => false))
            ->add('fechaRcdp', 'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'label' => 'Fecha de la revocación', 'attr' => array('size' => 10)))
            ->add('revccd', 'checkbox', array('label'=> 'Revocación comunicada al cesionario de los datos', 'required' => false))
            ->add('aecc', 'checkbox', array('label' => 'Autorización envío de comunicaciones comerciales', 'required' => false) )
            ->add('ccpCp', 'checkbox', array('label' => 'Correo Postal', 'required' => false))
            ->add('ccpEmail', 'checkbox', array('label' => 'E-mail', 'required' => false))
            ->add('ccpLlt', 'checkbox', array('label' => 'Llamadas telefónicas', 'required'=> false))
            ->add('ccpMm', 'checkbox', array('label'=> 'Mensajes de móvil', 'required' => false))
            ->add('ccpFax', 'checkbox', array('label' => 'Fax', 'required' => false))
            ->add('ccpRs', 'checkbox', array('label' => 'Redes sociales', 'required'=> false))
            ->add('ccpVa', 'checkbox', array('label' => 'Vía alternativa', 'required' => false))
            ->add('racc', 'checkbox', array('label' => 'Revocación autorización envío de com. comerciales', 'required' => false))
            ->add('fechaRacc', 'date', array('widget' => 'single_text', 'format'=> 'dd/MM/yyyy', 'label' => 'Fecha de revocación de la autorización', 'required'=> false, 'attr' => array('size' => 10)))
            ->add('racd', 'checkbox', array('label' => 'Revocación comunicada al cesionario de los datos', 'required' => false))
            ->add('datosTelefonicos', 'collection', array(
                    'type' => new DatosTelefonicosType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
            ))
            ->add('aceptar', 'submit', array('attr' => array('class' => 'btn btn-primary btn-sm')))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CuentasPersonales',
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
        return 'cuentasPersonales';
    }
}


