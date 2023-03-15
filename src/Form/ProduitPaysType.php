<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitPaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produit',
                EntityType::class,
                [
                    'class' => Produit::class,
                    'choice_label' => 'denomination',
                    'placeholder' => '----------',
                    'label' => 'produit',
                    'mapped' => false,
                ])
            ->add('pays',
                EntityType::class,
                [
                    'class' => Pays::class,
                    'choice_label' => function(Pays $pays) {
                        return
                            $pays->getNom()
                            . ' ('
                            . (is_null($pays->getCode()) ? '??' : $pays->getCode())
                            . ')';
                    },
                    'placeholder' => '----------',
                    'label' => 'pays',
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
