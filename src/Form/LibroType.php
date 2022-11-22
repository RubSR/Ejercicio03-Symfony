<?php

namespace App\Form;

use App\Entity\Autor;
use App\Entity\Cat;
use App\Entity\Libro;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo',TextType::class)
            ->add('anyo', IntegerType::class)
            ->add('autor', EntityType::class,
            ['class'=> Autor::class]
            )
            ->add('categoria',EntityType::class,
                ['class'=>Cat::class]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
    public function getName(){
        return '';
    }
}
