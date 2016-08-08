<?php

namespace Victoire\Widget\PollBundle\Form\Question;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;

class QuestionRadioType extends QuestionType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add("proposals", CollectionType::class, [
            "entry_type" => ProposalType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'vic_widget_add_btn' => null
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->pollConfigurationChain->getQuestionFromQuestionFormType($this),
            'questionType' => null,
            'translation_domain' => 'victoire'
        ));
    }
}
