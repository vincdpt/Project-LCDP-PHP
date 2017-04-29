<?php

namespace PPE_PHP\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
<<<<<<< Updated upstream
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
=======
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class VisiteurType extends AbstractType
=======
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
>>>>>>> origin/master
>>>>>>> Stashed changes
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
            ->add('id_secteur', ChoiceType::class, array(
                'choices' => array('1' => '1', '2' => '2', '3' => '3',
                    '4' => '4', '5' => '5')))
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('login', TextType::class)
            ->add('mdp', TextType::class)
            ->add('adresse', TextType::class)
            ->add('cp', IntegerType::class)
            ->add('ville', TextType::class)
            ->add('dateEmbauche', DateType::class)
            ->add('privileges', IntegerType::class);
    }


    public function getName()
    {
        return 'visiteur';
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
    }
}