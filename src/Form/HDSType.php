<?php

namespace App\Form;

use App\Entity\HDS;
use App\Entity\Commune;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class HDSType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('pnom')
            ->add('numero')
            ->add('niveau_etude')
            ->add('specialite')
            ->add('commune', EntityType::class, [
              'required' => true,
              'label' => 'Commune',
              'class' => Commune::class,
              'choice_label' => 'nom',
              'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HDS::class,
        ]);
    }
}
