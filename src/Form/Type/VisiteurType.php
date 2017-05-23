<?php

namespace PPE_PHP\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class VisiteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        return 'nom';
    }
}