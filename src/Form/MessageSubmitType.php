<?php

namespace App\Form;

use App\Entity\Message;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageSubmitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('text', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Letter' => 'letter',
                    'Note' => 'note',
                    'Code' => 'code',
                ],
                'expanded' => true
            ])
            ->add('duration', ChoiceType::class, [
                'choices' => [
                    '6 hours' => 'PT1H',
                    '12 hours' => 'PT12H',
                    '24 hours' => 'P1D',
                    'a week' => 'P7D',
                    'a month' => 'P1M',
                    'a year' => 'P1Y',
                ],
                'expanded' => true
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'Send'],
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
