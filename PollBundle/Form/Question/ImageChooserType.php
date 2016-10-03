<?php

namespace Victoire\Widget\PollBundle\Form\Question;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageChooserType extends QuestionType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('images', CollectionType::class, [
            'label' => 'widget.form.poll.question.imageChooser.images.label',
            'entry_type' => ImageType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'vic_widget_add_btn' => null,
            'widget_add_btn' => null,
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }
}
