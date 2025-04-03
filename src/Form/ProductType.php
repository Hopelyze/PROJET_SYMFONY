<?php
namespace App\Form;

use App\Entity\Flowers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wording', TextType::class, [
                'label' => 'Nom du produit'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix à l\'unité',
                'scale' => 2
            ])
            ->add('quantityStock', NumberType::class, [
                'label' => 'Quantité en stock'
            ])
            ->add('image', TextType::class, [
                'label' => 'Image du produit'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter le produit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flowers::class,
        ]);
    }
}