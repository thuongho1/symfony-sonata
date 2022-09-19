<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Category;
use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class ProductAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'product';
    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('version')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('version')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
                    ->with('Content')
            ->add('name')
            ->add('price')
//            ->add('version')
                        ->end()
                        ->with('Meta data')
                        ->add('categories', EntityType::class, array(
                            'class' => Category::class,
                            'multiple' => true,
                            'expanded' => true,
                            'choice_label' => 'name',
                            'placeholder' => 'Select a value',
                            'empty_data' => null,
                            'by_reference' => false,
                        ))
                        ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('version')
            ;
    }
}
