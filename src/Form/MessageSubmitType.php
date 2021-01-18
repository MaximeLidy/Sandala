<?php

namespace App\Form;

use App\Entity\Message;


use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageSubmitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $type_options = [
            'Code' => 'code',
            'Letter' => 'letter',
            'Note' => 'note',
        ];

        $duration_options = [
            '1 hour' => 'PT1H',
            '12 hours' => 'PT12H',
            '24 hours' => 'P1D',
            'a week' => 'P7D',
            'a month' => 'P1M',
            'a year' => 'P1Y',
        ];

        $builder
            ->add('text', CKEditorType::class,)
            ->add('type', ChoiceType::class, [
                'choices' => $type_options,
                'expanded' => true,
                'data' => "code"

            ])
            ->add('duration', ChoiceType::class, [
                'choices' => $duration_options,
                'expanded' => true,
                'data' => "PT1H",
                'label_attr' => array(
                    'class' => 'checkbox-inline'
                )
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn, btn-primary'],

            ]);
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }


}
