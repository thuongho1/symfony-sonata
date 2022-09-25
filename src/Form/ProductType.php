<?php

namespace App\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslatedEntityType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Category;
use App\Entity\Product;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder->add('translations', TranslationsType::class, [
            'locales' => ['en', 'vi'],
            'default_locale' => ['vi'],
            'required_locales' => ['vi'],
            'fields' => [
                'name' => [
                    'field_type' => TextType::class,
                ],
                'description' => [
                    'field_type' => TextareaType::class,
                ],

            ],
            'locale_labels' => [
                'vi' => 'Vietnam',
                'en' => 'English',
            ],
        ]);
        $builder
            ->add('price');
//            ->add('categories', EntityType::class, array(
//                'class' => Category::class,
//                'multiple' => true,
//                'expanded' => true,
//                'choice_label' => 'name',
//                'placeholder' => 'Select a value',
//                'empty_data' => null,
//                'by_reference' => false,
//            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
