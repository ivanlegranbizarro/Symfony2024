<?php

namespace App\Form;

use App\Entity\MicroPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MicroPostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'required' => true,
                    'minlength' => 5,
                    'maxlength' => 255,
                ],
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'required' => true,
                    'minlength' => 10,
                    'maxlength' => 500,
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => $options['button_label'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MicroPost::class,
            'button_label' => 'Save',
        ]);
    }
}
