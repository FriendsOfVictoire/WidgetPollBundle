<?php

namespace Victoire\Widget\PollBundle\Form\Question;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;

class QuestionType extends AbstractType
{
    protected $pollConfigurationChain;
    protected $availableLocales;

    public function __construct(PollConfigurationChain $pollConfigurationChain, $availableLocales)
    {
        $this->pollConfigurationChain = $pollConfigurationChain;
        $this->availableLocales = $availableLocales;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [];
        foreach ($this->pollConfigurationChain->getAliases() as $questionName) {
            $choices[] = $questionName;
        }

        $builder
            ->add('title', null, [
                'label' => 'widget.form.poll.question.title.label',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'widget.form.poll.question.type.label',
                'choices' => $choices,
                'choices_as_values' => true,
                'choice_label' => function ($questionName, $key, $index) {
                    return 'widget_poll.pollQuestion.'.$questionName;
                },
                'attr' => [
                    'data-refreshOnChange' => 'true',
                    'data-target' => '.vic-modal-body .vic-container-fluid .vic-tab-pane.vic-active',
                ],
                'mapped' => false,
                'data' => $options['questionType'] ? $options['questionType'] : null,
            ])
            ->add('locale', ChoiceType::class, [
                'label' => 'widget.form.poll.question.locale.label',
                'choices' => $this->availableLocales,
            ])
        ;
    }
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);
        $view->vars['questionTemplate'] = $this->pollConfigurationChain->getQuestionTemplateFromQuestionFormType($this);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->pollConfigurationChain->getQuestionFromQuestionFormType($this),
            'questionType' => null,
            'translation_domain' => 'victoire',
        ));
    }
}
