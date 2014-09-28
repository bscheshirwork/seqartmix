SeqArtMix
=======================

Введение
------------
Демонстрационный модуль для ZF2. Отображает картинки по указанному пути, 
определяя по простейшим правилам следующую и предыдущую. Сохраняет позицию
последнего просмотренного изображения.

Установка
------------
Для демонстрации модуля установите, к примеру, на `ZendSkeletonApplication`
http://github.com/zendframework/ZendSkeletonApplication

На шаге `"manually invoke composer using the shipped composer.phar"` можно добавить зависимость модуля

Добавьте в `composer.json` зависимость
`"bscheshir/seqartmix":"dev-master"`
и репозиторий
`"http://github.com/bscheshirwork/seqartmix"`

Примерно таким образом:

	{
	    ...
	    "require": {
	    ...
	        "bscheshir/seqartmix":"dev-master"
	    },
	    "repositories":[
	        {
	            "type":"git",
	            "url":"http://github.com/bscheshirwork/seqartmix"
	        }
	    ]
	}

Запустите из каталога приложения 
`php composer.phar install` для первичной установки или 
`php composer.phar update` если добавляете только модуль

Настройка
------------
Для включения добавьте в раздел модулей вашего `/config/application.config.php`
`SeqArtMix` и `TwbBundle` примерно так

	'modules' => array(
		...
		'SeqArtMix',
		'TwbBundle',
	),

Маршруты `/sam` `/sam/admin` `/sam/admin/img/add` можно найти в настройках модуля 
`/vendor/bscheshir/seqartmix/config/module.config.php` и перезаписать в настройках приложения модулем-декоратором

создадим новый подкаталог и, тем самым, новый модуль в каталоге module, и назовем его `SeqArtMixMod`. 
Здесь нам нужен только Module.php, в методе getConfig() 

	<?php
	namespace SeqArtMixMod;

	class Module
	{
		public function getConfig()
		{
			return array(
				'router' => array(
					'routes' => array(
						'seq-art-mix' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
								'route'    => '/',// <-- default '/sam'
								'defaults' => array(
									'controller' => 'SeqArtMix\Controller\Index',
									'action'     => 'index',
								),
							),
						),
					'seq-art-mix\admin\home' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
								'route'    => '/admin',// <-- default '/sam/admin'
								'defaults' => array(
									'controller' => 'SeqArtMix\Controller\Admin',
									'action'     => 'index',
								),
							),
						),
					'seq-art-mix\admin\img\add' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
								'route'    => '/add',// <-- default '/sam/admin/img/add'
								'defaults' => array(
									'controller' => 'SeqArtMix\Controller\Admin',
									'action'     => 'add-img',
								),
							),
						),
					)
				)
			);
		}
	}

Не забудьте добавить этот модуль ПОСЛЕ модуля `SeqArtMix` в раздел модулей вашего `/config/application.config.php`

	'modules' => array(
		...
		'SeqArtMix',
		'SeqArtMixMod',
		'TwbBundle',
	),
