<?php

namespace Victoire\Widget\PollBundle\Form\Answer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollConfigurationChain;
use Victoire\Widget\PollBundle\Listener\PollAnswerListener;

class ParticipationType extends AbstractType
{
    private $pollConfigurationChain;

    public function __construct(PollConfigurationChain $pollConfigurationChain)
    {
        $this->pollConfigurationChain = $pollConfigurationChain;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answers', CollectionType::class, [
                'entry_type' => AnswerType::class,

            ])
            ->add('viewRefId', HiddenType::class, [
                'required' => true,
                'mapped' => false,
            ])
            ->add('submit', 'submit')
        ;
        $listener = new PollAnswerListener($this->pollConfigurationChain, $options['questions']);
        $builder->get('answers')->addEventSubscriber($listener);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Victoire\Widget\PollBundle\Entity\Answer\Participation',
            'questions' => [],
        ));
    }
}
