<?php

namespace Victoire\Widget\PollBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

class WidgetPollType extends WidgetType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);

    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\PollBundle\Entity\WidgetPoll',
            'widget'             => 'Poll',
            'translation_domain' => 'victoire'
        ));
    }
}
