<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddUserChallenge extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('user_id', IntegerType::class)
            ->add('challenge_id', IntegerType::class)
            ->add('statut', TextType::class)
            ->add('date_fin', DateType::class)
            ->add('date_obligatoire', DateType::class);
    }
}