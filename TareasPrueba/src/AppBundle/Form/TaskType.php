<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function BuildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description');
        $builder->add('tags', 'collection', array('type' => new TagType()));
        $builder->add('aceptar', 'submit');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task', 
        ));
    }
    
    public function getBlockPrefix()
    {
        return 'task';
    }
}


