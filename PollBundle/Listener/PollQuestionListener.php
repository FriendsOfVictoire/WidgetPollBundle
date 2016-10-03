<?php

namespace Victoire\Widget\PollBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Entity\Question\Question;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;

/**
 * Class PollQuestionListener.
 */
class PollQuestionListener implements EventSubscriberInterface
{
    private $pollConfigurationChain;

    /**
     * PollQuestionListener constructor.
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
        /** @var WidgetPoll $data */
        $data = $event->getData();
        $form = $event->getForm();
        /**
         * @var int
         * @var Question $question
         */
        foreach ($data->getQuestions() as $index => $question) {
            $questionType = $this->pollConfigurationChain->getQuestionFormTypeFromQuestion($question);

            $form->get('questions')->remove($index);
            $form->get('questions')->add($index, $questionType, [
                'questionType' => $this->pollConfigurationChain->getAliasFromQuestion($question),
            ]);
        }
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        /*
         * @var integer $index
         * @var array $question
         */
        var_dump($data);
        die();
        foreach ($data['questions'] as $index => $question) {
            $form->get('questions')->remove($index);
            $form->get('questions')->add($index, $this->pollConfigurationChain->getQuestionFormTypeFromAlias($question['type']), [
                'questionType' => $question['type'],
            ]);
        }
    }
}
