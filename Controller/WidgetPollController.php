<?php

namespace Victoire\Widget\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Widget Poll Controller.
 *
 * @Route("/vic/widget/poll")
 */
class WidgetPollController extends Controller
{
    /**
     * Display Poll Participations results.
     *
     * @Route("/results", name="vic_widget_poll_results")
     *
     * @return JsonResponse
     */
    public function resultsAction()
    {
        return new JsonResponse(
            [
                'success' => true,
                'html'    => $this->container->get('templating')->render(
                    'VictoireWidgetPollBundle::resultsModal.html.twig',
                    []
                ),
            ]
        );
    }

}