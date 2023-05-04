<?php

namespace App\Form;

use App\Entity\Foro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Tema;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ForoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('descripcion')
            ->add('oculto')
            ->add('creator')
            ->add('foto', FileType::class, [
                'label' => 'Foto del foro ',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
              
            ])

       /*     ->add('temas',EntityType::class, [
                'class' => Tema::class,
                 'multiple' => true,
                 'expanded' => true,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Foro::class,
        ]);
    }
}
