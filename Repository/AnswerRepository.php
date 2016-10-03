<?php

namespace Victoire\Widget\PollBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Victoire\Widget\PollBundle\Entity\Question\Question;

class AnswerRepository extends EntityRepository
{
    use \AppVentus\Awesome\ShortcutsBundle\Repository\AwesomeRepositoryTrait;

    public function filterByQuestion(Question $question)
    {
        $this->getInstance('answer')
            ->where('answer.question = :question')
            ->setParameter(':question', $question)
        ;

        return $this;
    }
}
