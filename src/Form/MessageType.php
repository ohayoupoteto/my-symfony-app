<?php  

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; //関連付けで必要なタイプ
use App\Entity\Person;
use App\Entity\Message;

class MessageType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder,array $options){
        $builder
        ->add('person',EntityType::class,['class'=>'App\Entity\Person'])
        ->add('content',TextType::class)
        ->add('posted',DateTimeType::class)
        ->add('save',SubmitType::class,['label'=>'click']);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(['data_class'=>Message::class]);
    }
}