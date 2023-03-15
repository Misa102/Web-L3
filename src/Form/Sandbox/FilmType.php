<?php

namespace App\Form\Sandbox;

use App\Entity\Sandbox\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',
                TextType::class,       // déduit automatiquement par Symfony
                [
                    'label' => 'titre du film',
                    'attr' => ['placeholder' => 'titre'],
                ])
            ->add('annee',
                IntegerType::class,    // déduit automatiquement par Symfony
                ['label' => 'année de sortie'])
            ->add('enstock',
                ChoiceType::class,     // par défaut c'est CheckboxType
                [
                    'label' => 'en stock',
                    'choices' => ['oui' => true, 'non' => false],     // liste des choix : labels et valeurs
                    'expanded' => true,                               // liste déroulante ou radio-boutons
                ])
            ->add('prix',
                NumberType::class,     // déduit automatiquement par Symfony
                [
                    'label' => 'prix d\'achat',
                    'invalid_message' => 'le prix n\'est pas un nombre',
                ])
            ->add('quantite',
                IntegerType::class,    // déduit automatiquement par Symfony
                [
                    'label' => 'quantité en stock',
                    'required' => false,                              // saisie non obligatoire
                    'help' => '0 si "enstock" est à "non"',           // message d'aide lié au champ
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
