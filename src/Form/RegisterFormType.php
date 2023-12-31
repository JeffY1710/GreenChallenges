<?php

namespace App\Form;

use PhpParser\Node\Expr\BinaryOp\Identical;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = array(
            'Administrateur' => 'ROLE_ADMIN',
            'Utilisateur' => 'ROLE_USER'
        );

        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'mon-classe-username'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Mail',
                'attr' => ['class' => 'mon-classe-email'],
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
                'attr' => ['class' => 'mon-classe-birthday'],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['class' => 'mon-classe-password'],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => ['class' => 'mon-classe-confirm-password'],
                ],
                'invalid_message' => 'The password fields must match.',
                'required' => true,
            ])
            ->add('roles', ChoiceType::class,[
                'label' => 'Roles :',
                'choices' => $roles,
                'multiple'  => true,
                'expanded' => true,
                'required' => true,
                'attr' => ['class' => 'choice_rank'],

            ])
            ->add('Submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => ['class' => 'button_valider2'],
            ]);
    }
}
