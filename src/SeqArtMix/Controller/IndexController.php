<?php
/**
 * BSCheshir
 *
 * controler for view img collection
 * @copyright Copyright (c) 2014 BSCheshir
 * @license   New BSD License
 */

namespace SeqArtMix\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

class IndexController extends AbstractActionController
{
    /**
     * @var \SeqArtMix\Mapper\ImgHydrator
     */
    protected $imgHydrator = null;

    /**
     * Displays a img collection.
     */
    public function indexAction()
    {
	if($this->getRequest()->isPost()){
	    $data=$this->getRequest()->getPost();
	    $id=substr($data['id'],0, -2);
	    $shift=(integer)$data['shift'];
	    
	    $imgCollection=$this->getServiceLocator()->
		    get('SeqArtMix\Service\StoreImg')->getImgCollection($this);
	    
	    $entity=$imgCollection[$id];
	    
	    $entity->shift($shift);
	    ini_set('display_errors', E_ALL);
	    $this->getServiceLocator()->
		get('SeqArtMix\Service\StoreImg')->setImg($this,$entity);
	    $this->getServiceLocator()->
		    get('SeqArtMix\Service\ParseImg')->parseUrl($entity);
	    
	    $data = array(
		'id' => $entity->getId(),
		'url' => $entity->getUrl(),
		'imgUrl' => $entity->getImgUrl(),
	    );
	    return $this->getResponse()->setContent(Json::encode($data));	    
	}else{
	    $imgCollection=$this->getServiceLocator()->
		    get('SeqArtMix\Service\StoreImg')->getImgCollection($this);
	    $imgCollection=$this->getServiceLocator()->
		    get('SeqArtMix\Service\ParseImg')->parseCollection($imgCollection);
	    return new ViewModel(array(
		'imgCollection'=>$imgCollection,
	    ));
	}
    }
    
    /**
     * set hydrator Img to controller
     *
     * @param \SeqArtMix\Mapper\ImgHydrator $hydrator
     */
    public function setImgHydrator(\SeqArtMix\Mapper\ImgHydrator $hydrator){
	$this->imgHydrator=$hydrator;
    }
    /**
     * get hydrator Img from controller
     *
     * @return \SeqArtMix\Mapper\ImgHydrator
     */
    public function getImgHydrator(){
	return $this->imgHydrator;
    }    
}
