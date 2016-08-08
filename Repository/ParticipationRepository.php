<?php

namespace Victoire\Widget\PollBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

class ParticipationRepository extends EntityRepository
{
    public function isRequestBlocked(Request $request)
    {
        if($user = $request->getUser())
        {
            $qb = $this->createQueryBuilder('participation')
                ->join('participation.voting', 'voting')
                ->join('voting.user', 'user')
                ->where('user = :currentUser')
                ->setParameter(':currentUser', $user);
            return count($qb->getQuery()->getResult()) > 0 ;
        }else{
            $qb = $this->createQueryBuilder('participation')
                ->join('participation.voting', 'voting')
                ->where('voting.userIp = :currentUserIp')
                ->setParameter(':currentUserIp', $request->getClientIp());
            return count($qb->getQuery()->getResult()) > 0 ;
        }
    }
}