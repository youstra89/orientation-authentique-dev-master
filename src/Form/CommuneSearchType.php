<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Search\CommuneSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CommuneSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
              'required' => false,
              'label' => false,
              'attr' => [
                'placeholder' => 'Entrez un nom'
              ]
            ])
            ->add('region', EntityType::class, [
              'required' => false,
              'class'    => Region::class,
              'choice_label' => 'nom',
              'label'    => false,
              'required' => false,
              'multiple' => false,
              'placeholder' => 'Sélectionnez une région'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommuneSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
      return '';
    }
}
