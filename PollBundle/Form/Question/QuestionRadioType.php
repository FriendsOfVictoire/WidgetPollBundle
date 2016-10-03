<?php

namespace Victoire\Widget\PollBundle\Form\Question;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionRadioType extends QuestionType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('proposals', CollectionType::class, [
            'label' => 'widget.form.poll.question.radio.proposals.label',
            'entry_type' => ProposalType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'vic_widget_add_btn' => null,
            'widget_add_btn' => null,
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }
}
