<?php

namespace App\Form\Sandbox;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo',
                TextType::class,
                [
                    'label' => 'pseudo',
                    'required' => false,         // il n'est pas obligatoire de saisir un pseudo
                    'mapped' => false,           // le champ n'est pas relié à un membre d'une classe
                ])
            ->add('refus',
                CheckboxType::class,
                [
                    'label' => 'refus cookies',
                    'required' => false,         // sinon on ne peut pas laisser la checkbox décochée
                    'data' => true,              // pour pré-cocher la checkbox
                    'mapped' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
