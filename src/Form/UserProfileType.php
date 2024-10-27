<?php

namespace App\Form;

use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 255,
                    'class' => 'block w-full p-2 border rounded-md',
                    'placeholder' => 'Enter your name',
                ],
            ])
            ->add('bio', TextType::class, [
                'required' => true,
                'attr' => [
                    'minlength' => 10,
                    'maxlength' => 255,
                    'class' => 'block w-full p-2 border rounded-md',
                    'placeholder' => 'Enter your bio',
                ],
            ])
            ->add('webSiteUrl', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255,
                    'class' => 'block w-full p-2 border rounded-md',
                    'placeholder' => 'https://example.com',
                    'pattern' => 'https?://.+', // Validación de URL en HTML
                ],
            ])
            ->add('twitterUsername', TextType::class, [
                'required' => false,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 255,
                    'class' => 'block w-full p-2 border rounded-md',
                    'placeholder' => '@username',
                ],
            ])
            ->add('company', TextType::class, [
                'required' => false,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 255,
                    'class' => 'block w-full p-2 border rounded-md',
                    'placeholder' => 'Enter your company name',
                ],
            ])
            ->add('location', TextType::class, [
                'required' => true,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 255,
                    'class' => 'block w-full p-2 border rounded-md',
                    'placeholder' => 'Enter your location',
                ],
            ])
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => 'block w-full p-2 border rounded-md',
                ],
            ]);

        if ($options['include_save_button']) {
            $builder
                ->add('save', SubmitType::class, [
                    'label' => 'Save',
                    'attr' => [
                        'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full',
                    ],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
            'include_save_button' => true,
        ]);
    }
}
