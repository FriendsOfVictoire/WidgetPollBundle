<?php

namespace Victoire\Widget\PollBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Victoire\Widget\PollBundle\Entity\Radio;
use Victoire\Widget\PollBundle\Form\Answer\RadioAnswerType;
use Victoire\Widget\PollBundle\Form\Question\ProposalType;

class QuestionRadioType extends QuestionType
{
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

    public function getQuestionClass()
    {
        return Radio::class;
    }

    public function getAnswerType()
    {
        return RadioAnswerType::class;
    }
    
    public function getQuestionFormTemplate()
    {
        return "radio";
    }
}
