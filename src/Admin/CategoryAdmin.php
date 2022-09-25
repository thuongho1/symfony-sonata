<?php

namespace App\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Category;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{
//    public function __construct()
//    {
//        parent::__construct();
//    }
//    protected $baseRoutePattern = 'category';
    public function toString($object)
    {
        return $object instanceof Category
            ? $object->getName()
            : $this->translator->trans('category'); // shown in the breadcrumb on the create view
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('translations', TranslationsType::class, [
            'fields' => [
                'name' => [
                    'field_type' => TextType::class,
                ],
            ],
            'excluded_fields' => ['slug']

        ])
            ->end();
//            ->add('slug', TextType::class);
    }
//
//    public function prePersist($object)
//    {
//dump($object);
//    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('slug');
    }
    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name');
    }
}
