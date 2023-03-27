<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Formations;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('lastname')
            ->add('firstname')
            ->add('phone')
            ->add('photo')
            ->add('formation', EntityType::class, [
                'class'=>Formations::class,
                'choice_label'=>'name'
            ])
            ->add('roles', ChoiceType::class, [
                'choices'=> [
                    'Stagiaire'=>"ROLE_USER",
                    'Administrateur'=>"ROLE_ADMIN",
                ],
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
