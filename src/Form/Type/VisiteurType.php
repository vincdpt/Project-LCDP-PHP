<?php

namespace PPE_PHP\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_produit', TextType::class)
            ->add('nom', TextType::class)
            ->add('id_famille', ChoiceType::class, array(
                'choices' => array('Analgésiques' => 'Analgésiques', 'Antibiotiques' => 'Antibiotiques', 'Antalgiques' => 'Antalgiques',
                    'Anti-inflammatoires' => 'Anti-inflammatoires', 'Antidépresseurs' => 'Antidépresseurs', 'Antihistaminiques' => 'Antihistaminiques',
                    'Allergènes' => 'Allergènes', 'Antitussifs' => 'Antitussifs')))
            ->add('effets', TextareaType::class)
            ->add('contre_indication', TextareaType::class)
            ->add('interactions_autres_produits', TextType::class)
            ->add('presentation', TextareaType::class)
            ->add('dosage', TextType::class)
            ->add('prix_HT', TextType::class)
            ->add('prix_Echantillon', TextType::class);
    }

    public function getName()
    {
        return 'nom';
    }
}