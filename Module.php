<?php
namespace SeqArtMix;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
	$sharedEvents = $moduleManager->getEventManager()->getSharedManager();
	$sharedEvents->attach(
	    'SeqArtMix\Controller\AdminController',
	    'dispatch',
	    function($e){
		$controller= $e->getTarget();
		$controller->layout('seq-art-mix/layout/admin');
	    },
	    100
	);
	$sharedEvents->attach(
	    'SeqArtMix\Controller\IndexController',
	    'dispatch',
	    function($e){
		$controller= $e->getTarget();
		$controller->layout('seq-art-mix/layout/index');
	    },
	    100
	);
    }
}
