<?php

namespace App\Form\Sandbox;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $noteMax = $options['data']['max'];
        // construction de la liste de choix
        $choices = [];
        for($note = 0; $note <= $noteMax; $note ++)
            $choices['- ' . $note . ' -'] = $note;

        $builder
            ->add('etudiant',
                TextType::class,
                [
                    'label' => 'nom étudiant',
                    'mapped' => false,
                ])
            ->add('note',
                ChoiceType::class,
                [
                    'label' => 'note',
                    'choices' => $choices,
                    'placeholder' => 'faites un choix',     // pour ne pas présélectionner une note par défaut
                    //'data' => 3,                          // pour info : préselectionne une entrée particulière
                    //'expanded' => true,                   // pour avoir (beaucoup ?) des radio-boutons
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
