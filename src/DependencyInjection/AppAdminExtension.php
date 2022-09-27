<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DependencyInjection;

use App\Admin\ProductAdmin;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Twig\Environment;
use Yokai\SonataWorkflow\Controller\WorkflowController;

/**
 * @author Zoe
 *
 * @internal
 */
class AppAdminExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->setDefinition('app.admin.product', new Definition(ProductAdmin::class))
            ->setArguments(['~', Product::class, WorkflowController::class])
            ->setTags(['name' => 'sonata.admin', 'manager_type' => 'orm', 'group' => 'Commerce', 'label' => 'Product'])
            ->setPublic(false);

    }
}
