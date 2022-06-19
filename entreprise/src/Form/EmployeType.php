<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("prenom")
            ->add("nom")
            ->add("telephone")
            ->add("email")
            ->add("adresse" , TextareaType::class , ["attr" => ["rows" => 4]])
            ->add("poste")
            ->add("salaire")
            ->add("datedenaissance", DateType::class , ["widget" => "single_text"])
            ->add("ajouter", SubmitType::class , ["label" => "Enregistrer"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
