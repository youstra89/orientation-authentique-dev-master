<?php

namespace App\Form;

use App\Entity\HDS;
use App\Entity\Mosquee;
use App\Entity\Commune;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MosqueeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('quartier')
            ->add('nom_imam')
            ->add('description', TextareaType::class, ['required' => true])
            ->add('numero_imam')
            ->add('responsable')
            ->add('numero_responsable')
            ->add('djoumoua', CheckboxType::class, ['required' => false])
            ->add('annee_construction')
            ->add('commune', EntityType::class, [
              'required' => true,
              'label' => 'Commune',
              'placeholder' => 'Commune',
              'class' => Commune::class,
              'choice_label' => 'nom',
              'multiple' => false
            ])
            ->add('imam', EntityType::class, [
              'required' => false,
              'label' => 'Imam',
              'choice_label' => function ($hds) {
                    return $hds->getPnom() . ' ' . $hds->getNom();
              },
              'class' => HDS::class,
              'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('h');
              },
              'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mosquee::class,
        ]);
    }
}
