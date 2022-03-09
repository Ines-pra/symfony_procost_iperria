<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ProjectType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])
            ->add('salesPrice', IntegerType::class, [
                'label' => 'Prix de vente'
            ])
            // ->add('deliverDate', TextAreaType::class, [
            //     'label' => 'Date '
            // ])
            // ->add('dateJob', TextAreaType::class, [
            //     'label' => 'Date d\'embauche'
            // ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void 
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}