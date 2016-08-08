<?php

namespace Victoire\Widget\PollBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Victoire\Widget\PollBundle\Entity\Answer\Participation;
use Victoire\Widget\PollBundle\Entity\Voting;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;
use Victoire\Widget\PollBundle\Form\Answer\ParticipationType;

/**
 * PaarticipationController.
 *
 * @Route("/_victoire_poll_participation")
 */
class ParticipationController extends Controller
{
    /**
     * Handle the form submission.
     *
     * @param Request $request
     *
     * @Route("/addParticipation/{id}", name="victoire_poll_participation_add")
     * @ParamConverter(class="VictoireWidgetPollBundle:WidgetPoll", name="widget")
     *
     * @return array
     */
    public function addAction(Request $request, WidgetPoll $widget)
    {
        $em = $this->getDoctrine()->getManager();
        if($widget->isSecure() && $em->getRepository(Participation::class)->isRequestBlocked($request))
        {
            return new JsonResponse([
                'success' => false
            ]);
        }
        $participation = new Participation();
        $voting = new Voting();
        $voting->setUserIp($request->getClientIp());
        if ($user = $this->getUser())
        {
            $voting->setUser($user);
        }
        $form = $this->createForm(
            ParticipationType::class, $participation, [
                'questions' => $widget->getQuestions(),
                'action' => $this->generateUrl('victoire_poll_participation_add', [
                    'id' => $widget->getId()
                ]),
                'attr' => [
                    'data-toggle' => 'ajax'
                ]
            ]
        );
        $form->handleRequest($request);
        if($form->isValid())
        {
            $participation->setWidgetPoll($widget);
            $participation->setVoting($voting);
            $em->persist($voting);
            $em->persist($participation);
            $em->flush();
            return new JsonResponse(
                [
                    'success' => true
                ]
            );
        }
        return new JsonResponse(
            [
                'success' => false
            ]
        );
    }
}
