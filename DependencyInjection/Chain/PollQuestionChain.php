<?php

namespace Victoire\Widget\PollBundle\DependencyInjection\Chain;

use Victoire\Widget\PollBundle\Entity\Question;
use Victoire\Widget\PollBundle\Form\QuestionType;

class PollQuestionChain
{
    private $formTypes;
    private $questionsClass;

    public function __construct()
    {
        $this->formTypes= [];
        $this->questionsClass = [];
    }

    public function addPollQuestion(QuestionType $pollQuestion, $questionName)
    {
        $this->formTypes[$questionName] = $pollQuestion;
        $this->questionsClass[$pollQuestion->getQuestionClass()] = $questionName;
    }

    public function getPollQuestions()
    {
        return $this->formTypes;
    }
    public function getPollQuestionNames()
    {
        return array_keys($this->formTypes);
    }

    public function getPollQuestion($questionName)
    {
        return $this->formTypes[$questionName];
    }

    /**
     * @param Question $question
     * @return string
     */
    public function getQuestionName(Question $question)
    {
        $ref = new \ReflectionClass($question);
        return $this->questionsClass[$ref->getName()];
    }

    /**
     * @param Question $question
     * @return QuestionType
     */
    public function getQuestionTypeFromEntity(Question $question)
    {
        $questionName = $this->getQuestionName($question);
        return $this->getQuestionTypeFromName($questionName);
    }
    /**
     * @param Question $question
     * @return QuestionType
     */
    public function getQuestionTypeFromName($questionName)
    {
        return $this->formTypes[$questionName];
    }
}
