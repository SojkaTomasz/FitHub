<?php

namespace App\Form;

use App\Entity\Report;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class ReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $options = [
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Musisz wpisać wartość',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => 'Wartość musi być liczbą.',
                ]),
            ],
            'invalid_message' => 'Wartość musi być liczbą.',
            'scale' => 2,
        ];

        $builder
            ->add('weight', NumberType::class, $options)
            ->add('calfCircumference', NumberType::class, $options)
            ->add('thighCircumference', NumberType::class, $options)
            ->add('beltCircumference', NumberType::class, $options)
            ->add('chestCircumference', NumberType::class, $options)
            ->add('neckCircumference', NumberType::class, $options)
            ->add('bicepsCircumference', NumberType::class, $options)
            ->add('forearmCircumference', NumberType::class, $options)
            ->add('percentDiet', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 5,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać wartość',
                    ])
                ],

            ])
            ->add('Comments', TextareaType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Report::class,
        ]);
    }
}
