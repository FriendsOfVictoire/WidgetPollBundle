<?php

namespace Victoire\Widget\PollBundle\DependencyInjection\Chain;

use Victoire\Widget\PollBundle\Entity\Question\Question;
use Victoire\Widget\PollBundle\Form\Answer\AnswerType;
use Victoire\Widget\PollBundle\Form\Question\QuestionType;

class PollConfigurationChain
{
    private $forms = [];

    public function __construct()
    {
        $this->forms = [];
    }

    public function addPollConfiguration($alias, $configuration)
    {
        $this->forms[$alias] = $configuration;
    }

    public function getClass($alias)
    {
        return $this->forms[$alias]['question']['entity'];
    }
    public function getAliasFromQuestion(Question $question)
    {
        $ref = new \ReflectionClass($question);
        foreach ($this->forms as $alias => $form) {
            if ($form['question']['entity'] === $ref->getName()) {
                return $alias;
            }
        }

        return;
    }
    public function getAliasFromQuestionClass($questionClass)
    {
        foreach ($this->forms as $alias => $form) {
            if ($form['question']['entity'] === $questionClass) {
                return $alias;
            }
        }

        return;
    }

    public function getQuestionFormTypes()
    {
        $formTypes = [];
        foreach ($this->forms as $alias => $form) {
            $formTypes[$alias] = $form['question']['form'];
        }

        return $formTypes;
    }

    public function getQuestionFormTypeFromAlias($alias)
    {
        return $this->forms[$alias]['question']['form'];
    }

    public function getQuestionFormTypeFromQuestion(Question $question)
    {
        $ref = new \ReflectionClass($question);
        foreach ($this->forms as $alias => $form) {
            if ($form['question']['entity'] === $ref->getName()) {
                return $form['question']['form'];
            }
        }

        return;
    }

    public function getAnswerFormTypeFromQuestion(Question $question)
    {
        $ref = new \ReflectionClass($question);
        foreach ($this->forms as $alias => $form) {
            if ($form['question']['entity'] === $ref->getName()) {
                return $form['answer']['form'];
            }
        }

        return;
    }
    public function getQuestionFromQuestionFormType(QuestionType $questionType)
    {
        $ref = new \ReflectionClass($questionType);
        foreach ($this->forms as $alias => $form) {
            if ($form['question']['form'] === $ref->getName()) {
                return $form['question']['entity'];
            }
        }

        return;
    }
    public function getAnswerFromAnswerFormType(AnswerType $answerTypenswer)
    {
        $ref = new \ReflectionClass($answerTypenswer);
        foreach ($this->forms as $alias => $form) {
            if ($form['answer']['form'] === $ref->getName()) {
                return $form['answer']['entity'];
            }
        }

        return;
    }
    public function getQuestionTemplateFromQuestionFormType(QuestionType $questionType)
    {
        $ref = new \ReflectionClass($questionType);
        foreach ($this->forms as $alias => $form) {
            if ($form['question']['form'] === $ref->getName()) {
                return $form['question']['template'];
            }
        }

        return;
    }
    public function getAnswerTemplateFromAnswerFormType(AnswerType $answerType)
    {
        $ref = new \ReflectionClass($answerType);
        foreach ($this->forms as $alias => $form) {
            if ($form['answer']['form'] === $ref->getName()) {
                return $form['answer']['template'];
            }
        }

        return;
    }
    public function getAliases()
    {
        return array_keys($this->forms);
    }
}
