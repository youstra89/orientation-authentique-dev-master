<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Commune;
use App\Entity\Discipline;
use App\Entity\Search\HDSSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class HDSSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
              'required' => false,
              'label' => false,
              'attr' => [
                'placeholder' => 'Entrez un nom ou un prénom'
              ]
            ])
            ->add('discipline', EntityType::class, [
              'required' => false,
              'class'    => Discipline::class,
              'choice_label' => 'nom',
              'label'    => false,
              'required' => false,
              'multiple' => false,
              'placeholder' => 'Sélectionnez une discipline'
            ])
            ->add('commune', EntityType::class, [
              'required' => false,
              'class'    => Commune::class,
              'choice_label' => 'nom',
              'label'    => false,
              'required' => false,
              'multiple' => false,
              'placeholder' => 'Sélectionnez une commune'
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
            'data_class' => HDSSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
      return '';
    }
}
