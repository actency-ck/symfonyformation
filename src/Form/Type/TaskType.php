<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class TaskType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $priority = [
      'low' => 'basse',
      'medium' => 'moyenne',
      'high' => 'top prio',
    ];

    $builder
      ->add('name', TextType::class, [
        'required' => false,
      ])
      ->add('dueDate', DateType::class, [
        'constraints' => New GreaterThan('today'),
        'attr' => [
          'class' => $options['classFromController']
        ]
      ])
      ->add('priority', ChoiceType::class, [
        'choices' => array_reverse($priority)
      ])
      ->add('image', FileType::class, [
        'label' => 'Image'
      ])
      ->add('save', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'classFromController' => null,
      //  'validation_groups' => false, // Disable validation

    ]);
  }
}