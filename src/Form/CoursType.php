<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Livre;
use App\Entity\Discipline;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heure', ChoiceType::class, [
              'placeholder' => 'Heure du cours',
              'choices' => $this->getChoices(Cours::HEURECOURS)
            ])
            ->add('jour', ChoiceType::class, [
              'placeholder' => 'Jour du cours',
              'choices' => $this->getChoices(Cours::JOURCOURS)
            ])
            ->add('annee_debut')
            ->add('discipline', EntityType::class, [
              'class' => Discipline::class,
              'choice_label' => 'nom',
              'placeholder' => 'Nom de la discipline',
              'required' => true,
              'multiple' => false
            ])
            ->add('livre', EntityType::class, [
              'class' => Livre::class,
              'choice_label' => 'nom',
              'placeholder' => 'Nom du livre',
              'required' => false,
              'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }


    public function getChoices($entity)
    {
      $choices = $entity;
      $output = [];
      foreach($choices as $k => $v){
        $output[$v] = $k;
      }
      return $output;
    }
}
