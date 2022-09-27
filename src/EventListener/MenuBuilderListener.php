<?php
namespace App\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class MenuBuilderListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            ConfigureMenuEvent::SIDEBAR => 'addMenuItems'
        ];
    }
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $child = $menu->addChild('test', [
            'label' => 'Zoe test 1',
            'route' => 'admin_test',
        ])->setExtras([
            'icon' => 'fa fa-bar-chart', // html is also supported
        ]);
//        test:
//        label: Test
//                icon: 'fa fa-image'
//                keep_open: true
//                items:
//                    - route: admin_test
//                      label: Test

    }

}
