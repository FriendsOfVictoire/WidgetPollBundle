<?php

namespace Victoire\Widget\PollBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Entity\Answer\Participation;

/**
 * Class PollAnswerListener.
 */
class PollAnswerListener implements EventSubscriberInterface
{
    private $questions;
    private $pollConfigurationChain;

    /**
     * PollAnswerListener constructor.
     *
     * @param Question []     $questions
-     */
    public function __construct(PollConfigurationChain $chain, $questions)
    {
        $this->questions = $questions;
        $this->pollConfigurationChain = $chain;
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
        /** @var Participation $data */
        $data = $event->getData();
        $form = $event->getForm();
        /*
        foreach ($data->getAnswers() as $index => $answer) {

            $questionType = $this->pollAnswerChain->getAnswerTypeFromEntity($question);

            $form->get('questions')->remove($index);
            $form->get('questions')->add($index, $questionType, [
                'questionType' => $this->pollAnswerChain->getAnswerName($question)
            ]);
        }*/
        foreach ($this->questions as $index => $question)
        {
            $answerType = $this->pollConfigurationChain->getAnswerFormTypeFromQuestion($question);
            $form->add($index, $answerType, [
                        'required' => 'required',
                        'question' => $question
                    ]
                );
        }
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        foreach ($this->questions as $index => $question)
        {
            $answerType = $this->pollConfigurationChain->getAnswerFormTypeFromQuestion($question);
            $form->add($index, $answerType, [
                    'required' => 'required',
                    'question' => $question
                ]
            );
        }
        /**
         * @var integer $index
         * @var array $question
         */
        /*foreach ($data['questions'] as $index => $question) {
            $form->get('questions')->remove($index);
            $form->get('questions')->add($index, $this->pollAnswerChain->getAnswerTypeFromName($question['type']), [
                'questionType' => $question['type']
            ]);
        }*/
    }
}
