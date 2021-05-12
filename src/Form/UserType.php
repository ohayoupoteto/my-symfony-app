<?php  

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\User;


class UserType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder,array $options){
        $builder
        ->add('username',TextType::class)
        ->add('password',PasswordType::class)
        ->add('email',EmailType::class)
        ->add('register',SubmitType::class,['label'=>'click']);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(['data_class'=>User::class]);
    }
}