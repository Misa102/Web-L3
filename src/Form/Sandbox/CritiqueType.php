<?php

namespace App\Form\Sandbox;

use App\Entity\Sandbox\Critique;
use App\Entity\Sandbox\Film;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CritiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note',
                IntegerType::class,
                [
                    'label' => 'note (entre 0 et 5)',
                    'required' => false,
                ])
            ->add('avis',
                TextareaType::class,
                [
                    'label' => 'votre avis',
                    'attr' => [
                        'placeholder' => 'détaillez vos arguments',
                        'rows' => 5,
                        'cols' => 60,
                    ],
                ])
            ->add('film',
                EntityType::class,
                [
                    'class' => Film::class,
                    'label' => 'pour quel film',
                    //'choice_label' => 'titre',      // quels textes à mettre dans le menu déroulant
                    'choice_label' => function(Film $film) {
                        return $film->getTitre() . ' (' . $film->getAnnee() . ')';
                    },
                    'placeholder' => '------',        // pour ne pas présélectionner un film
                    'expanded' => false,              // true : suite de radio-boutons
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Critique::class,
        ]);
    }
}
