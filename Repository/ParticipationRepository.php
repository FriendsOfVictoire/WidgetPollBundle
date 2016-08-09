<?php

namespace Victoire\Widget\PollBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Victoire\Bundle\WidgetBundle\Model\Widget;

class ParticipationRepository extends EntityRepository
{
    public function isRequestBlocked(Request $request, Widget $widget, $user = null)
    {
        if(($user && is_object($user)) || $user = $request->getUser())
        {
            $qb = $this->createQueryBuilder('participation')
                ->join('participation.voting', 'voting')
                ->join('voting.user', 'user')
                ->where('user = :currentUser')
                ->andWhere('participation.widgetPoll = :currentWidget')
                ->setParameter(':currentUser' ,  $user)
                ->setParameter(':currentWidget', $widget);
            return count($qb->getQuery()->getResult()) > 0 ;
        }else{
            $qb = $this->createQueryBuilder('participation')
                ->join('participation.voting', 'voting')
                ->where('voting.userIp = :currentUserIp')
                ->andWhere('participation.widgetPoll = :currentWidget')
                ->setParameter(':currentUserIp' ,  $request->getClientIp())
                ->setParameter(':currentWidget', $widget);
            return count($qb->getQuery()->getResult()) > 0 ;
        }
    }
}