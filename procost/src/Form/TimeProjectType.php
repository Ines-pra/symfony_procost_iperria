<?php

namespace App\Form;

use App\Entity\Employees;
use App\Entity\Project;
use App\Entity\TimeProject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TimeProjectType extends AbstractType 
{

    
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {

        $builder
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'name',
                'label' => 'Projet concerné'
            ])
            ->add('day', IntegerType::class, [
                'label' => 'Nombre de jours'
            ])
  
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void 
    {
        $resolver->setDefaults([
            'data_class' => TimeProject::class,
        ]);
    }
}