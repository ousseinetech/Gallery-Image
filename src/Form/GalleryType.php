<?php

namespace App\Form;

use App\Entity\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
               'label' => false,
               'attr' => ['placeholder' => 'Nom de l\'image...']
            ])
            ->add('imageFile', FileType::class, [
               'required' => false,
               'label' => false
            ])
            ->add('submit', SubmitType::class, [
               'label' => 'Ajouter une image',
               'attr' => ['class' => 'btn-lg btn-success']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class,
        ]);
    }
}
