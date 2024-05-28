<?php

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('trainingDays', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Ile dni w tygodniu możesz trenować?',
                'choices' => [
                    '1 dzień w tygodniu' => '1 dzień w tygodniu',
                    '2 dni w tygodniu' => '2 dni w tygodniu',
                    '3 dni w tygodniu' => '3 dni w tygodniu',
                    '4 dni w tygodniu' => '4 dni w tygodniu',
                    '5 dni w tygodniu' => '5 dni w tygodniu',
                    '6 dni w tygodniu' => '6 dni w tygodniu',
                    '7 dni w tygodniu' => '7 dni w tygodniu',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('trainingHours', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Ile godzin dziennie możesz trenować?',
                'choices' => [
                    '1 godzinę' => '1 godzinę',
                    '1 godzinę 30 minut' => '1 godzinę 30 minut',
                    '2 godzinę' => '2 godzinę',
                    '2 godzinę 30 minut' => '2 godzinę 30 minut',
                    '3 godzinę' => '3 godzinę',
                    'więcej' => 'więcej',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('productsLike', TextareaType::class, [
                'required' => false,
                'label' => 'Produkty, które lubisz (wymień kilka)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('productsNotLike', TextareaType::class, [
                'required' => false,
                'label' => 'Produkty, których nie lubisz (wymień kilka)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('typeWork', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Rodzaj Twojej pracy?',
                'choices' => [
                    'Siedząca (biurowa, mało ruchu)' => 'siedząca',
                    'Umiarkowanie aktywna (część czasu spędzana w ruchu)' => 'umiarkowanie aktywna',
                    'Aktywna (praca fizyczna, dużo ruchu)' => 'aktywna',
                    'Bardzo aktywna (intensywna praca fizyczna)' => 'bardzo aktywna',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('goals', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Główne cele treningowe',
                'choices' => [
                    'Schudnąć' => 'schudnąć',
                    'Zbudować mięśnie' => 'zbudować mięśnie',
                    'Poprawić kondycję' => 'poprawić kondycję',
                    'Zwiększyć siłę' => 'zwiększyć siłę',
                    'Poprawić zdrowie' => 'poprawić zdrowie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('shortTermGoals', TextareaType::class, [
                'required' => false,
                'label' => 'Cele krótkoterminowe (3-6 miesięcy)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('longTermGoals', TextareaType::class, [
                'required' => false,
                'label' => 'Cele długoterminowe (6-12 miesięcy)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('activityLevel', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jaki jest Twój poziom aktywności fizycznej?',
                'choices' => [
                    'Niski (mało ruchu)' => 'niski',
                    'Umiarkowany (sporadyczne ćwiczenia)' => 'umiarkowany',
                    'Wysoki (regularne ćwiczenia)' => 'wysoki',
                    'Bardzo wysoki (intensywne ćwiczenia codziennie)' => 'bardzo wysoki',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])


            ->add('currentTraining', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Obecny plan treningowy',
                'choices' => [
                    'Kardio' => 'kardio',
                    'Siłowy' => 'siłowy',
                    'Mieszany' => 'mieszany',
                    'Nie trenuję regularnie' => 'nie trenuję regularnie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('healthIssues', TextareaType::class, [
                'required' => false,
                'label' => 'Czy masz jakieś problemy zdrowotne, które powinniśmy znać?',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('mobilityIssues', TextareaType::class, [
                'required' => false,
                'label' => 'Czy masz jakieś problemy z mobilnością?',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('stressLevel', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jak oceniasz swój poziom stresu?',
                'choices' => [
                    'Niski (rzadko odczuwam stres)' => 'niski',
                    'Średni (czasami odczuwam stres)' => 'średni',
                    'Wysoki (często odczuwam stres)' => 'wysoki',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('sleepQuality', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jak oceniasz jakość swojego snu?',
                'choices' => [
                    'Zła (mam problemy ze snem)' => 'zła',
                    'Średnia (czasami mam problemy ze snem)' => 'średnia',
                    'Dobra (śpię dobrze)' => 'dobra',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('currentDiet', TextareaType::class, [
                'required' => false,
                'label' => 'Jak wygląda Twoja obecna dieta?',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('mealsPerDay', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Ile posiłków spożywasz dziennie?',
                'choices' => [
                    '1 posiłek' => '1 posiłek',
                    '2 posiłki' => '2 posiłki',
                    '3 posiłki' => '3 posiłki',
                    '4 posiłki' => '4 posiłki',
                    '5 posiłków' => '5 posiłków',
                    '6 posiłków' => '6 posiłków',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('snackingHabits', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Czy masz nawyki podjadania?',
                'choices' => [
                    'Nie nigdy nie podjadam' => 'nigdy',
                    'Czasami podjadam' => 'czasami',
                    'Często podjadam' => 'często',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('waterIntake', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Ile wody spożywasz dziennie?',
                'choices' => [
                    'Mniej niż 1 litr' => 'mniej niż 1 litr',
                    '1-2 litry' => '1-2 litry',
                    '2-3 litry' => '2-3 litry',
                    'Więcej niż 3 litry' => 'więcej niż 3 litry',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('alcoholIntake', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jak często spożywasz alkohol?',
                'choices' => [
                    'Nie spożywam alkoholu' => 'nie spożywam',
                    'Okazjonalnie (raz na tydzień lub rzadziej)' => 'okazjonalnie',
                    'Regularnie (kilka razy w tygodniu)' => 'regularnie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('smokingHabits', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Czy palisz?',
                'choices' => [
                    'Nie palę' => 'nie palę',
                    'Okazjonalnie palę' => 'okazjonalnie',
                    'Regularnie palę' => 'regularnie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])


            ->add('motivation', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Co najbardziej Cię motywuje do treningu?',
                'choices' => [
                    'Poprawa zdrowia' => 'poprawa zdrowia',
                    'Utrata wagi' => 'utrata wagi',
                    'Budowanie mięśni' => 'budowanie mięśni',
                    'Poprawa samopoczucia' => 'poprawa samopoczucia',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('preferredTraining', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jakie rodzaje treningów preferujesz?',
                'choices' => [
                    'Siłowy (np. podnoszenie ciężarów)' => 'siłowy',
                    'Kardio (np. bieganie, rower)' => 'kardio',
                    'Stretching (np. joga, pilates)' => 'stretching',
                    'Sporty drużynowe (np. piłka nożna, koszykówka)' => 'sporty drużynowe',
                ],
                'multiple' => true,
                'expanded' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'array']),
                ],
            ])

            ->add('dislikedTraining', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jakie rodzaje treningów Ci nie odpowiadają?',
                'choices' => [
                    'Siłowy (np. podnoszenie ciężarów)' => 'siłowy',
                    'Kardio (np. bieganie, rower)' => 'kardio',
                    'Stretching (np. joga, pilates)' => 'stretching',
                    'Sporty drużynowe (np. piłka nożna, koszykówka)' => 'sporty drużynowe',
                ],
                'multiple' => true,
                'expanded' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'array']),
                ],
            ])

            ->add('preferredTrainingTime', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Kiedy preferujesz trenować?',
                'choices' => [
                    'Rano (przed pracą)' => 'rano',
                    'Po południu (po pracy)' => 'po południu',
                    'Wieczorem (późnym wieczorem)' => 'wieczorem',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('availableEquipment', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Wybierz...',
                'label' => 'Jakim sprzętem do treningu dysponujesz?',
                'choices' => [
                    'Hantle' => 'hantle',
                    'Sztanga' => 'sztanga',
                    'Mata do ćwiczeń' => 'mata',
                    'Sprzęt kardio (bieżnia, rower stacjonarny)' => 'sprzęt kardio',
                ],
                'multiple' => true,
                'expanded' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'array']),
                ],
            ])

            ->add('additionalInfo', TextareaType::class, [
                'required' => false,
                'label' => 'Dodatkowe informacje, które chciałbyś przekazać',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'To pole jest wymagane!',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
