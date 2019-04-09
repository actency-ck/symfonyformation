<?php

namespace App\Form\Type;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, [
        'data' => $options['data']['name'] ?? '',
      ])
      ->add('due_date', DateType::class, [
        'data' => $options['data']['due_date'] ?? null,
      ])
      ->add('save', SubmitType::class, ['label' => 'Create Task']);
  }

  /*
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => Task::class,
    ]);
  }
  */

}