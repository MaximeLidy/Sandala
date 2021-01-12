<?php

namespace App\Form;

use App\Entity\Message;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
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
            ->add('deathDate', ChoiceType::class, [
                'choices' => [
                    '6 hours' => '6',
                    '12 hours' => '12',
                    '24 hours' => '24',
                    'a week' => 'week',
                    'a month' => 'month',
                    'a year' => 'year',
                ],
                'expanded' => true
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
