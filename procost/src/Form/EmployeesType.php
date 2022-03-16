<?php

namespace App\Form;

use App\Entity\Employees;
use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EmployeesType extends AbstractType 
{
    public function __construct(
        private JobRepository $jobRepository)
    {}
    
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {

        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'name',
                'label' => 'Métier'
            ])
            ->add('dayCost', IntegerType::class, [
                'label' => 'Coût journalier'
            ])
            ->add('createdAt', DateType::class, [
                'label' => 'Date d\'embauche',
                'widget' => 'single_text',
            ])     
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void 
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}