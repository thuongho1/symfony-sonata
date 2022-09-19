<?php
namespace App\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
//
//        $child = $menu->addChild('products', [
//            'label' => 'Daily and monthly reports',
//            'route' => 'app_reports_index',
//        ])->setExtras([
//            'icon' => 'fa fa-bar-chart', // html is also supported
//        ]);
    }
}
