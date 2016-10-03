<?php

namespace Victoire\Widget\PollBundle\Listener;

use Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Entity\Question\Question;

/**
 * Class PollQuestionListener.
 */
class SurveyQuestionListener implements EventSubscriberInterface
{
    private $pollConfigurationChain;

    /**
     * SurveyQuestionListener constructor.
     *
     * @param PollConfigurationChain $pollConfigurationChain
     * @param FormFactoryInterface   $factory
     */
    public function __construct(PollConfigurationChain $pollConfigurationChain)
    {
        $this->pollConfigurationChain = $pollConfigurationChain;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        /** @var SurveyQuestion $data */
        $data = $event->getData();
        $form = $event->getForm();
        /**
         * @var int
         * @var Question $question
         */
        $question = $data->getQuestion();
        if ($question === null) {
            $question = new Question();
        }

        $questionType = $this->pollConfigurationChain->getQuestionFormTypeFromQuestion($question);

        $form->remove('question');
        $form->add('question', $questionType, [
            'questionType' => $this->pollConfigurationChain->getAliasFromQuestion($question),
        ]);
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        /**
         * @var int
         * @var array $question
         */
        $question = $data['question'];
        $form->remove('question');
        $form->add('question', $this->pollConfigurationChain->getQuestionFormTypeFromAlias($question['type']), [
            'questionType' => $question['type'],
        ]);
    }
}
