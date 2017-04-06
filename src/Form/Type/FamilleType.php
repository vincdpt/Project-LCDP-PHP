<?php

namespace PPE_PHP\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FamilleType extends AbstractType
{
  	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_famille', TextType::class)
            ->add('famille_produit', TextType::class);
    }

    public function getName()
    {
        return 'famille_produit';
    }
}
