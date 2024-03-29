<?php


namespace App\Form;


use App\Entity\Pilot;
use App\Entity\Rank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PilotFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("firstname", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("lastname", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("country", ChoiceType::class, array('choices' => array(
                "United Kingdom" => "gb",
                "United States of America" => "us",
                "France" => "fr",
                "Belgium" => "be",
                "Russia" => "ru"
            ), 'attr' => array("class" => "form-control")))
            ->add("hometown", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("age", IntegerType::class, array('attr' => array("class" => "form-control", "min" => 18, "max" => 65)))
            ->add("rank", EntityType::class, array(
                'class' =>  Rank::class,
                'choice_label' => 'Title',
                'attr' => array("class" => "form-control")));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pilot::class
        ]);
    }

}