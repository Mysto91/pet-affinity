<?php

namespace App\Form;

use App\Entity\Pet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Description')
            ->add(
                'gender',
                ChoiceType::class,
                [
                    'choices'  => [
                        'male' => 'male',
                        'female' => 'female',
                    ],
                ]
            )
            ->add(
                'color',
                ChoiceType::class,
                [
                    'choices'  => [
                        'black' => 'black',
                        'white' => 'white',
                        'grey' => 'grey',
                    ],
                ]
            )
            ->add('size')
            ->add('age')
            ->add(
                'imageFile',
                FileType::class,
                [
                    'required' => false
                ]
            )
            ->add('typePet');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pet::class,
        ]);
    }
}
