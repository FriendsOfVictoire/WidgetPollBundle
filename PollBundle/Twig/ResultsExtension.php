<?php

namespace Victoire\Widget\PollBundle\Twig;

use Doctrine\ORM\EntityRepository;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Entity\Question\Question;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;

class ResultsExtension extends \Twig_Extension_Core
{
    protected $pollRepo;
    private $pollConfigurationChain;
    /**
     * ResultsExtension constructor.
     *
     * @param EntityRepository $pollRepo
     */
    public function __construct(EntityRepository $pollRepo, PollConfigurationChain $chain)
    {
        $this->pollRepo = $pollRepo;
        $this->pollConfigurationChain = $chain;
    }

    /**
     * Register twig functions.
     *
     * @return \Twig_SimpleFunction[] The list of extensions
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('victoire_widget_poll_all_results', [$this, 'allResults'], ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('victoire_widget_poll_single_result', [$this, 'singleResult'], ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('victoire_widget_poll_alias_for_question', [$this, 'getAliasForQuestion'], []),
        ];
    }

    /**
     * Get extension name.
     *
     * @return string The name
     */
    public function getName()
    {
        return 'victoire_widget_poll_extension';
    }

    /**
     * Get all Polls results.
     *
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function allResults(\Twig_Environment $twig)
    {
        $polls = $this->pollRepo->findAll();

        return $twig->render('VictoireWidgetPollBundle::results.html.twig', ['polls' => $polls]);
    }

    /**
     * Get a single Poll results.
     *
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function singleResult(\Twig_Environment $twig, WidgetPoll $poll, $questions = [])
    {
        $questions = count($questions) > 0 ? $questions : $poll->getQuestions();

        return $twig->render('@VictoireWidgetPoll/includes/questionsResults.html.twig', ['questions' => $questions]);
    }

    public function getAliasForQuestion(Question $question)
    {
        return $this->pollConfigurationChain->getAliasFromQuestion($question);
    }

    public function getAliasForQuestionClass($questionClass)
    {
        return $this->pollConfigurationChain->getAliasFromQuestionClass($questionClass);
    }
}
