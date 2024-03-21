<?php

namespace App\Form;

use App\Entity\Report;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $optionsNumberType = [
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
            'scale' => 1,
        ];

        $optionsFileType = [
            'constraints' => [
                new ConstraintsFile([
                    'maxSize' => '2048k',
                    'mimeTypes' => [
                        'image/jpeg',
                        'img/png',
                    ],
                    'mimeTypesMessage' => 'Plik musi być formatu jpg lub png i nie przekraczać 2MB'
                ])
            ],
        ];


        $builder
            ->add('weight', NumberType::class, $optionsNumberType)
            ->add('calfCircumference', NumberType::class, $optionsNumberType)
            ->add('thighCircumference', NumberType::class, $optionsNumberType)
            ->add('beltCircumference', NumberType::class, $optionsNumberType)
            ->add('chestCircumference', NumberType::class, $optionsNumberType)
            ->add('neckCircumference', NumberType::class, $optionsNumberType)
            ->add('bicepsCircumference', NumberType::class, $optionsNumberType)
            ->add('forearmCircumference', NumberType::class, $optionsNumberType)
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
            ->add('frontImg', FileType::class, $optionsFileType)
            ->add('sideImg', FileType::class, $optionsFileType)
            ->add('backImg', FileType::class, $optionsFileType)
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
