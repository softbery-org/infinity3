<?php

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'articles' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/article[/:id[:/action]]',
                    'defaults' => [
                        'controller' => Controller\ArticleController::class,
                        'id'         => '\d+',
                        'action'     => 'index',
                    ],
                ],
            ],
            'blog' => [
                'type'    => Regex::class.
                'options' => [
                'regex'   => '/blog/(?<friendly_name>[a-zA-Z0-9_-]+)(\.(?<format>(json|html|xml|rss)))?',
                'defaults' => [
                    'controller' => Controller\BlogController::class,
                    'action'     => 'view',
                    'format'     => 'html',
                ],
                'spec' => '/blog/%friendly_name%.%format%',
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
