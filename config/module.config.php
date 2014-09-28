<?php
return array(
    'router' => array(
        'routes' => array(
            'seq-art-mix' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/sam',
                    'defaults' => array(
                        'controller' => 'SeqArtMix\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
	    'seq-art-mix\admin\home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/sam/admin',
                    'defaults' => array(
                        'controller' => 'SeqArtMix\Controller\Admin',
                        'action'     => 'index',
                    ),
                ),
            ),
	    'seq-art-mix\admin\img\add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/sam/admin/img/add',
                    'defaults' => array(
                        'controller' => 'SeqArtMix\Controller\Admin',
                        'action'     => 'add-img',
                    ),
                ),
            ),
	)
    ),
    'controllers' => array(
        'invokables' => array(
            //'SeqArtMix\Controller\Index' => 'SeqArtMix\Controller\IndexController',
            //'SeqArtMix\Controller\Admin' => 'SeqArtMix\Controller\AdminController'
        ),
	'factories'=> array(
	    'SeqArtMix\Controller\Admin' => function($serviceLocator){
		$ctr = new \SeqArtMix\Controller\AdminController();
		$hyd = new \SeqArtMix\Mapper\ImgHydrator();
		$form = new \SeqArtMix\Form\ImgAdd();
		$form->setHydrator($hyd);
		$form->bind(new \SeqArtMix\Entity\Img());
		$ctr->setImgAddForm($form);
		$ctr->setImgHydrator($hyd);
		return $ctr;
	    },
	    'SeqArtMix\Controller\Index' => function($serviceLocator){
		$ctr = new \SeqArtMix\Controller\IndexController();
		$hyd = new \SeqArtMix\Mapper\ImgHydrator();
		$ctr->setImgHydrator($hyd);
		return $ctr;
	    }
	)
    ),    
    'service_manager'=>array(
        'invokables' => array(
            'SeqArtMix\Service\StoreImg' => 'SeqArtMix\Service\StoreImgService',
            'SeqArtMix\Service\ParseImg' => 'SeqArtMix\Service\ParseImgService',
        ),
    ),
    'view_manager' => array(
	'template_map' => array(
	    'seq-art-mix/layout/admin' => __DIR__ . '/../view/layout/admin.phtml',
	    'seq-art-mix/layout/index' => __DIR__ . '/../view/layout/index.phtml',
	),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
	'invokables' => array(
	    'DisplayImgCollection' => 'SeqArtMix\View\Helper\DisplayImgCollection'
	)
    )
);