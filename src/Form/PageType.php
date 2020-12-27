<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\PageNathalie;
use App\Entity\PageEleve;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        if($options['createMode']==true)
            $createMode=true;
        else
            $createMode=false;
        
        if($options['formSpe']=="EleveValidation"){
            if($createMode == false){
                $builder
                ->add('valide', ChoiceType::class, [
                    'choices'  => [
                        'En attente' => 0,
                        'Valide' => 1,
                        'Non valide' => 2,
                    ],
                ]);
            } 
        }

        else{
            $builder
            ->add('title')
            ->add('imageFile', FileType::class, [
                'required' => $createMode])
            ;

            if($options['formSpe']=="Nathalie"){
                $builder
                    ->add('description')
                    ->add('lienAzza')
                ;
            }

        }
  
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'formSpe' => false,
            'createMode' => false
        ]);
        
        $resolver->setAllowedTypes('formSpe', 'string');

        
    }
}
