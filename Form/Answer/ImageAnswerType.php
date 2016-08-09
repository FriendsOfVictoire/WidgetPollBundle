<?php

namespace Victoire\Widget\PollBundle\Form\Answer;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Widget\PollBundle\Entity\Question\Image;

class ImageAnswerType extends AnswerType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('image', EntityType::class,[
                'label' => $options['question'] ? $options['question']->getTitle() : null,
                'class' => Image::class,
                'choice_label' => 'value',
                'query_builder' => function(EntityRepository $er) use ($options){
                    return $er->createQueryBuilder('ans')
                        ->where('ans.question = :question')
                        ->setParameter(':question', $options['question'] )
                        ;
                },
                'expanded' => true,
                'multiple' => false
            ])
        ;
    }
}
