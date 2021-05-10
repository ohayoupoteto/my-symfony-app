<?php  

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Controller\FlashController as Flash;

class FlashType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder,array $options){
        $builder
        ->add('name',TextType::class)
        ->add('mail',EmailType::class)
        ->add('submit',SubmitType::class,['label'=>'click']);
    }

    
}