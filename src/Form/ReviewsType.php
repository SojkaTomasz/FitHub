<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('opinion', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać wartość',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Minimum {{ limit }} znaków',
                    ]),
                ]
            ])
            ->add('rating', ChoiceType::class, [
                'choices' => [1,2,3,4,5],
                'expanded' => true,
                'multiple' => false,
                'choice_label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wybrać rolę.',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
