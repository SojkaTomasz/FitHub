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
                'label' => 'Ile dni w tygodniu możesz przeznaczyć na trening?',
                'choices' => [
                    'Wybierz' => '',
                    '1 dzień w tygodniu' => 1,
                    '2 dni w tygodniu' => 2,
                    '3 dni w tygodniu' => 3,
                    '4 dni w tygodniu' => 4,
                    '5 dni w tygodniu' => 5,
                    '6 dni w tygodniu' => 6,
                    '7 dni w tygodniu' => 7,
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'integer']),
                ],
            ])

            ->add('trainingHours', ChoiceType::class, [
                'required' => false,
                'label' => 'Ile godzin dziennie możesz przeznaczyć na trening?',
                'choices' => [
                    'Wybierz' => '',
                    '1 godzina dziennie' => 1,
                    '2 godziny dziennie' => 2,
                    '3 godziny dziennie' => 3,
                    '4 godziny dziennie' => 4,
                    '5 godzin dziennie' => 5,
                    '6 godzin dziennie' => 6,
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'integer']),
                ],
            ])

            ->add('productsLike', TextareaType::class, [
                'required' => false,
                'label' => 'Produkty, które lubisz (wymień kilka)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('productsNotLike', TextareaType::class, [
                'required' => false,
                'label' => 'Produkty, których nie lubisz (wymień kilka)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('typeWork', ChoiceType::class, [
                'required' => false,
                'label' => 'Rodzaj Twojej pracy',
                'choices' => [
                    'Wybierz' => '',
                    'Siedząca (biurowa, mało ruchu)' => 'siedząca',
                    'Umiarkowanie aktywna (część czasu spędzana w ruchu)' => 'umiarkowanie aktywna',
                    'Aktywna (praca fizyczna, dużo ruchu)' => 'aktywna',
                    'Bardzo aktywna (intensywna praca fizyczna)' => 'bardzo aktywna',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('goals', ChoiceType::class, [
                'required' => false,
                'label' => 'Główne cele treningowe',
                'choices' => [
                    'Wybierz' => '',
                    'Schudnąć' => 'schudnąć',
                    'Zbudować mięśnie' => 'zbudować mięśnie',
                    'Poprawić kondycję' => 'poprawić kondycję',
                    'Zwiększyć siłę' => 'zwiększyć siłę',
                    'Poprawić zdrowie' => 'poprawić zdrowie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('shortTermGoals', TextareaType::class, [
                'required' => false,
                'label' => 'Cele krótkoterminowe (3-6 miesięcy)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('longTermGoals', TextareaType::class, [
                'required' => false,
                'label' => 'Cele długoterminowe (6-12 miesięcy)',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('activityLevel', ChoiceType::class, [
                'required' => false,
                'label' => 'Jaki jest Twój poziom aktywności fizycznej?',
                'choices' => [
                    'Wybierz' => '',
                    'Niski (mało ruchu)' => 'niski',
                    'Umiarkowany (sporadyczne ćwiczenia)' => 'umiarkowany',
                    'Wysoki (regularne ćwiczenia)' => 'wysoki',
                    'Bardzo wysoki (intensywne ćwiczenia codziennie)' => 'bardzo wysoki',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])


            ->add('currentTraining', ChoiceType::class, [
                'required' => false,
                'label' => 'Obecny plan treningowy',
                'choices' => [
                    'Wybierz' => '',
                    'Kardio' => 'kardio',
                    'Siłowy' => 'siłowy',
                    'Mieszany' => 'mieszany',
                    'Nie trenuję regularnie' => 'nie trenuję regularnie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('healthIssues', TextareaType::class, [
                'required' => false,
                'label' => 'Czy masz jakieś problemy zdrowotne, które powinniśmy znać?',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('mobilityIssues', TextareaType::class, [
                'required' => false,
                'label' => 'Czy masz jakieś problemy z mobilnością?',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('stressLevel', ChoiceType::class, [
                'required' => false,
                'label' => 'Jak oceniasz swój poziom stresu?',
                'choices' => [
                    'Wybierz' => '',
                    'Niski (rzadko odczuwam stres)' => 'niski',
                    'Średni (czasami odczuwam stres)' => 'średni',
                    'Wysoki (często odczuwam stres)' => 'wysoki',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('sleepQuality', ChoiceType::class, [
                'required' => false,
                'label' => 'Jak oceniasz jakość swojego snu?',
                'choices' => [
                    'Wybierz' => '',
                    'Zła (mam problemy ze snem)' => 'zła',
                    'Średnia (czasami mam problemy ze snem)' => 'średnia',
                    'Dobra (śpię dobrze)' => 'dobra',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('currentDiet', TextareaType::class, [
                'required' => false,
                'label' => 'Jak wygląda Twoja obecna dieta?',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('mealsPerDay', ChoiceType::class, [
                'required' => false,
                'label' => 'Ile posiłków spożywasz dziennie?',
                'choices' => [
                    'Wybierz' => '',
                    '1 posiłek' => 1,
                    '2 posiłki' => 2,
                    '3 posiłki' => 3,
                    '4 posiłki' => 4,
                    '5 posiłków' => 5,
                    '6 posiłków' => 6,
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'integer']),
                ],
            ])

            ->add('snackingHabits', ChoiceType::class, [
                'required' => false,
                'label' => 'Czy masz nawyki podjadania?',
                'choices' => [
                    'Wybierz' => '',
                    'Nie nigdy nie podjadam' => 'nigdy',
                    'Czasami podjadam' => 'czasami',
                    'Często podjadam' => 'często',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('waterIntake', ChoiceType::class, [
                'required' => false,
                'label' => 'Ile wody spożywasz dziennie?',
                'choices' => [
                    'Wybierz' => '',
                    'Mniej niż 1 litr' => 'mniej niż 1 litr',
                    '1-2 litry' => '1-2 litry',
                    '2-3 litry' => '2-3 litry',
                    'Więcej niż 3 litry' => 'więcej niż 3 litry',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('alcoholIntake', ChoiceType::class, [
                'required' => false,
                'label' => 'Jak często spożywasz alkohol?',
                'choices' => [
                    'Wybierz' => '',
                    'Nie spożywam alkoholu' => 'nie spożywam',
                    'Okazjonalnie (raz na tydzień lub rzadziej)' => 'okazjonalnie',
                    'Regularnie (kilka razy w tygodniu)' => 'regularnie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('smokingHabits', ChoiceType::class, [
                'required' => false,
                'label' => 'Czy palisz?',
                'choices' => [
                    'Wybierz' => '',
                    'Nie palę' => 'nie palę',
                    'Okazjonalnie palę' => 'okazjonalnie',
                    'Regularnie palę' => 'regularnie',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])


            ->add('motivation', ChoiceType::class, [
                'required' => false,
                'label' => 'Co najbardziej Cię motywuje do treningu?',
                'choices' => [
                    'Wybierz' => '',
                    'Poprawa zdrowia' => 'poprawa zdrowia',
                    'Utrata wagi' => 'utrata wagi',
                    'Budowanie mięśni' => 'budowanie mięśni',
                    'Poprawa samopoczucia' => 'poprawa samopoczucia',
                    'Inne' => 'inne',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('preferredTraining', ChoiceType::class, [
                'required' => false,
                'label' => 'Jakie rodzaje treningów preferujesz?',
                'choices' => [
                    'Wybierz' => '',
                    'Siłowy (np. podnoszenie ciężarów)' => 'siłowy',
                    'Kardio (np. bieganie, rower)' => 'kardio',
                    'Stretching (np. joga, pilates)' => 'stretching',
                    'Sporty drużynowe (np. piłka nożna, koszykówka)' => 'sporty drużynowe',
                    'Inne' => 'inne',
                ],
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('dislikedTraining', ChoiceType::class, [
                'required' => false,
                'label' => 'Jakie rodzaje treningów Ci nie odpowiadają?',
                'choices' => [
                    'Wybierz' => '',
                    'Siłowy (np. podnoszenie ciężarów)' => 'siłowy',
                    'Kardio (np. bieganie, rower)' => 'kardio',
                    'Stretching (np. joga, pilates)' => 'stretching',
                    'Sporty drużynowe (np. piłka nożna, koszykówka)' => 'sporty drużynowe',
                    'Inne' => 'inne',
                ],
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('preferredTrainingTime', ChoiceType::class, [
                'required' => false,
                'label' => 'Kiedy preferujesz trenować?',
                'choices' => [
                    'Wybierz' => '',
                    'Rano (przed pracą)' => 'rano',
                    'Po południu (po pracy)' => 'po południu',
                    'Wieczorem (późnym wieczorem)' => 'wieczorem',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('availableEquipment', ChoiceType::class, [
                'required' => false,
                'label' => 'Jakim sprzętem do treningu dysponujesz?',
                'choices' => [
                    'Wybierz' => '',
                    'Hantle' => 'hantle',
                    'Sztanga' => 'sztanga',
                    'Mata do ćwiczeń' => 'mata',
                    'Sprzęt kardio (bieżnia, rower stacjonarny)' => 'sprzęt kardio',
                    'Inne' => 'inne',
                ],
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
                    ]),
                    new Assert\Type(['type' => 'string']),
                ],
            ])

            ->add('additionalInfo', TextareaType::class, [
                'required' => false,
                'label' => 'Dodatkowe informacje, które chciałbyś przekazać',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Musisz wybrać wartość',
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
