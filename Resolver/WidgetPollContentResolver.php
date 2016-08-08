<?php

namespace Victoire\Widget\PollBundle\Resolver;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Victoire\Bundle\WidgetBundle\Model\Widget;
use Victoire\Bundle\WidgetBundle\Resolver\BaseWidgetContentResolver;
use Victoire\Widget\PollBundle\Entity\Answer\Participation;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;
use Victoire\Widget\PollBundle\Form\Answer\ParticipationType;

/**
 * CRUD operations on WidgetPoll Widget
 *
 * The widget view has two parameters: widget and content
 *
 * widget: The widget to display, use the widget as you wish to render the view
 * content: This variable is computed in this WidgetManager, you can set whatever you want in it and display it in the show view
 *
 * The content variable depends of the mode: static/businessEntity/entity/query
 *
 * The content is given depending of the mode by the methods:
 *  getWidgetStaticContent
 *  getWidgetBusinessEntityContent
 *  getWidgetEntityContent
 *  getWidgetQueryContent
 *
 * So, you can use the widget or the content in the show.html.twig view.
 * If you want to do some computation, use the content and do it the 4 previous methods.
 *
 * If you just want to use the widget and not the content, remove the method that throws the exceptions.
 *
 * By default, the methods throws Exception to notice the developer that he should implements it owns logic for the widget
 */
class WidgetPollContentResolver extends BaseWidgetContentResolver
{
    private $formFactory;
    private $router;
    private $em;
    private $requestStack;

    public function __construct(FormFactory $factory, Router $router, RequestStack $requestStack, EntityManager $em)
    {
        $this->formFactory = $factory;
        $this->router = $router;
        $this->requestStack = $requestStack;
        $this->em = $em;

    }

    /**
     * Get the static content of the widget
     *
     * @param WidgetPoll $widget
     * @return string The static content
     */
    public function getWidgetStaticContent(Widget $widget)
    {
        $parameters = parent::getWidgetStaticContent($widget);

        $form = $this->formFactory->create(
            ParticipationType::class, null, [
                'questions' => $widget->getQuestions(),
                'action' => $this->router->generate('victoire_poll_participation_add', [
                    'id' => $widget->getId()
                ]),
                'attr' => [
                    'data-toggle' => 'ajax'
                ]
            ]
        );
        $parameters['participationForm'] = $form->createView();
        $parameters['alreadyVoted'] = $this->em->getRepository(Participation::class)->isRequestBlocked($this->requestStack->getCurrentRequest());


        return $parameters;
    }

    /**
     * Get the business entity content
     * @param Widget $widget
     * @return string
     */
    public function getWidgetBusinessEntityContent(Widget $widget)
    {
        return parent::getWidgetBusinessEntityContent($widget);
    }

    /**
     * Get the content of the widget by the entity linked to it
     *
     * @param Widget $widget
     *
     * @return string
     */
    public function getWidgetEntityContent(Widget $widget)
    {
        return parent::getWidgetEntityContent($widget);
    }

    /**
     * Get the content of the widget for the query mode
     *
     * @param Widget $widget
     * @throws \Exception
     */
    public function getWidgetQueryContent(Widget $widget)
    {
        return parent::getWidgetQueryContent($widget);
    }
}
