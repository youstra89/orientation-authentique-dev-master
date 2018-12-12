<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname',     TextType::class, ['required' => true, 'label' => 'Nom et Prénoms'])
            ->add('email',        TextType::class, ['required' => true, 'label' => 'Email'])
            ->add('phone_number', TextType::class, ['required' => false, 'label' => 'Numéro de téléphone'])
            ->add('subject',      TextType::class, ['required' => true, 'label' => 'Sujet'])
            ->add('message', TextareaType::class,  ['required' => true, 'label' => 'Message'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
