<?php

namespace App\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;

class UserAdmin extends BaseUserAdmin
{
    protected $baseRoutePattern = '/user';

    protected function configureFormFields(FormMapper $formMapper): void
    {
        parent::configureFormFields($formMapper);
        $formMapper->removeGroup('Social', 'User');
//        $formMapper
//            ->remove('facebookName')
//            ->remove('twitterUid')
//            ->remove('twitterName')
//            ->remove('gplusUid')
//            ->remove('gplusName');
    }
}
