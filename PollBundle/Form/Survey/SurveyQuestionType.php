<?php

namespace Victoire\Widget\PollBundle\Form\Survey;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Victoire\Widget\PollBundle\Entity\Survey\Tag;
use Victoire\Widget\PollBundle\Listener\SurveyQuestionListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Form\Question\QuestionType;

class SurveyQuestionType extends AbstractType
{
    private $pollConfigurationChain;

    public function __construct(PollConfigurationChain $pollConfigurationChain)
    {
        $this->pollConfigurationChain = $pollConfigurationChain;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visibleOnFront', null, [
                'label' => 'widget.form.poll.surveyQuestion.visibleOnFront.label',
            ])
            ->add('question', QuestionType::class)
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'label' => 'widget.form.poll.surveyQuestion.tags.label',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'survey-tags-form-tags-container',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'widget.form.poll.surveyQuestion.submit.label',
            ])
        ;
        $listener = new SurveyQuestionListener($this->pollConfigurationChain);
        $builder->addEventSubscriber($listener);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion',
            'translation_domain' => 'victoire',
        ));
    }
}
