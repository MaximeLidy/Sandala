<?php

namespace App\Form;

use App\Entity\Message;


use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageSubmitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $type_options = [
            'Code' => 'code',
            'Letter' => 'letter',
            'Quick Note' => 'note',
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
            ->add('text', CKEditorType::class, [
                'config' => [
                    'extraPlugins' => 'codesnippet',
                    'codeSnippet_theme' => 'rainbow',
                ],
                'plugins' => [
                    'codesnippet' => [
                        'path' => 'build/ckeditor/plugins/codesnippet/',
                        'filename' => 'plugin.js'
                    ],
                ],
            ])
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
                'attr' => ['class' => 'w-100 btn btn-primary btn-lg mt-auto'],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }


}
