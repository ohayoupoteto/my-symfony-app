<?php  

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Person;

class PersonType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder,array $options){
        $builder
        ->add('name',TextType::class)
        ->add('mail',EmailType::class)
        ->add('age',IntegerType::class)
        ->add('save',SubmitType::class,['label'=>'click']);
    }
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class'=>Person::class,
        ]);
    }
}