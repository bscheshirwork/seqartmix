<?php
/**
 * BSCheshir
 *
 * controller for add / maneger img object
 * @copyright Copyright (c) 2014 BSCheshir
 * @license   New BSD License
 */

namespace SeqArtMix\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
/**
 * Administration action controller
 */
class AdminController extends AbstractActionController
{
    /**
     * @var \SeqArtMix\Form\ImgAdd
     */
    protected $imgAddForm = null;
    /**
     * @var \SeqArtMix\Mapper\ImgHydrator
     */
    protected $imgHydrator = null;
    
    /**
     * Displays a img collection rules.
     * @return ViewModel
     */
    public function indexAction()
    {
	$imgCollection=$this->getServiceLocator()->
		get('SeqArtMix\Service\StoreImg')->getImgCollection($this);
        return new ViewModel(array(
	    'imgCollection'=>$imgCollection
	));
    }
    
    /**
     * Displays a img form on GET and process form on POST.
     */
    public function addImgAction(){
	$form = $this->getImgAddForm();
	
	if($this->getRequest()->isPost()){
	    $form->setData($this->getRequest()->getPost());
	    
	    if($form->isValid()){
		$newEntity=$form->getData();
		
		$this->getServiceLocator()->
		get('SeqArtMix\Service\StoreImg')->setImg($this,$newEntity);

		return new ViewModel(//another empty form
		    array(
			'form'=> new \SeqArtMix\Form\ImgAdd()
		    )
		);
	    }else{
		return new ViewModel(//fill form (with error)
		    array(
			'form'=>$form
		    )
		);
	    }
	}else{
	    return new ViewModel(//empty form (first call)
		array(
		    'form'=>$form
		)
	    );
	}
    }
    /**
     * set form ImgAdd to controller
     *
     * @param  SeqArtMix\Form\ImgAdd $form
     */
    public function setImgAddForm(\SeqArtMix\Form\ImgAdd $form){
	$this->imgAddForm=$form;
    }
    /**
     * get form ImgAdd from controller
     *
     * @return SeqArtMix\Form\ImgAdd
     */
    public function getImgAddForm(){
	return $this->imgAddForm;
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
