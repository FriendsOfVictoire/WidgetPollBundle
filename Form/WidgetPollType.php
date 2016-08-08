<?php

namespace Victoire\Widget\PollBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Form\Question\QuestionType;
use Victoire\Widget\PollBundle\Listener\PollQuestionListener;

class WidgetPollType extends WidgetType
{
    private $pollConfigurationChain;

    public function __construct(PollConfigurationChain $pollConfigurationChain)
    {
        $this->pollConfigurationChain = $pollConfigurationChain;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('secure', CheckboxType::class, [
            'label' => 'widget.form.poll.secure.label',
            'required' => false
        ]);
        $builder->add('questions', CollectionType::class, [
            'label' => 'widget.form.poll.questions.label',
            'entry_type' => QuestionType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'vic_widget_add_btn' => null
        ]);
        $listener = new PollQuestionListener($this->pollConfigurationChain);
        $builder->addEventSubscriber($listener);
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\PollBundle\Entity\WidgetPoll',
            'widget'             => 'Poll',
            'translation_domain' => 'victoire'
        ));
    }
}
