<?php

namespace Victoire\Widget\PollBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * PollController.
 *
 * @Route("/_victoire_poll")
 */
class PollController extends Controller
{
    /**
     * Handle the form submission.
     *
     * @param Request $request
     *
     * @Route("/testpollAction", name="victoire_poll_index")
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        return new Response();
    }
}
