SeqArtMix
=======================

Введение
------------
Демонстрационный модуль для ZF2. Отображает картинки по указанному пути, 
определяя по простейшим правилам следующую и предыдущую. Сохраняет позицию
последнего просмотренного изображения.

Установка
------------
Для демонстрации модуля установите, к примеру, на ZendSkeletonApplication
http://github.com/zendframework/ZendSkeletonApplication

На шаге "manually invoke composer using the shipped composer.phar" можно добавить зависимость модуля

Добавьте в composer.json зависимость
"bscheshir/seqartmix":"dev-master"
и репозиторий
"http://github.com/bscheshirwork/seqartmix"

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
php composer.phar install для первичной установки вместеили
php composer.phar update если добавляете только модуль

Настройка
------------
Для включения добавьте в раздел модулей вашего /config/application.config.php
'SeqArtMix' и 'TwbBundle' примерно так

    'modules' => array(
	...
        'SeqArtMix',
	'TwbBundle',
    ),
