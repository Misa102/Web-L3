<?php

namespace App\Form;

use App\Entity\Magasin;
use App\Entity\Produit;
use App\Entity\ProduitMagasin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitMagasinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produit',
                EntityType::class,
                [
                    'class' => Produit::class,
                    'label' => 'produit',
                    'choice_label' => 'denomination',
                    'placeholder' => 'select one ...',
                ])
            ->add('magasin',
                EntityType::class,
                [
                    'class' => Magasin::class,
                    'label' => 'magasin',
                    'choice_label' => 'nom',
                    'placeholder' => 'choose one ...',
                ])
            ->add('quantite',
                IntegerType::class,
                ['label' => 'quantité en stock'])
            ->add('prixUnitaire',
                NumberType::class,
                ['label' => 'prix unitaire'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitMagasin::class,
        ]);
    }
}
