<?php

namespace Victoire\Widget\PollBundle\Form\Answer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;

class AnswerType extends AbstractType
{
    protected $pollConfigurationChain;

    public function __construct(PollConfigurationChain $pollConfigurationChain)
    {
        $this->pollConfigurationChain = $pollConfigurationChain;
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->pollConfigurationChain->getAnswerFromAnswerFormType($this),
            'question' => null,
        ));
    }
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);
        $view->vars['answerTemplate'] = $this->pollConfigurationChain->getAnswerTemplateFromAnswerFormType($this);
    }
}
