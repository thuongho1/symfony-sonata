<?php

declare(strict_types=1);

namespace App\Admin;

use A2lix\AutoFormBundle\Form\Type\AutoFormType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsFormsType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ProductAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = '/product';
//
//    public function toString($object)
//    {
//        return $object instanceof Product
//            ? $object->getName()
//            : $this->translator->trans('product'); // shown in the breadcrumb on the create view
//    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('categories', null, [
                'field_type' => EntityType::class,
                'field_options' => [
                    'class' => Category::class,
                    'choice_label' => 'name',
                ],
            ])
            ->add('version');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('price')
            ->add('version')
            ->add('description', FieldDescriptionInterface::TYPE_HTML)
            ->add('categories', FieldDescriptionInterface::TYPE_MANY_TO_MANY, [])
            ->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('translations', TranslationsType::class, [
            'fields' => [
                'name' => [
                    'field_type' => TextType::class,
                ],
                'description' => [
                    'field_type' => CKEditorType::class,
                ],
            ],

        ])
            ->add('price')
            ->end();

        $form
            ->with('Meta data')
            ->add('categories', EntityType::class, [
                'class' => Category::class,
//                'query_builder' => function (EntityRepository $er) {
//                    return $er->createQueryBuilder('c')
//                        ->orderBy('u.username', 'ASC');
//                },
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
                'placeholder' => 'Select a value',
                'empty_data' => null,
                'by_reference' => false,
            ])
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('version');
    }
}
