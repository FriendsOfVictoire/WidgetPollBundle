<?php

namespace Victoire\Widget\PollBundle\Form\Answer;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends CollectionType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults(array(
            'questions' => [],
            'data_class' => 'Victoire\Widget\PollBundle\Entity\Answer\Participation'
        ));
    }
    public function getParent()
    {
        return CollectionType::class;
    }
}
