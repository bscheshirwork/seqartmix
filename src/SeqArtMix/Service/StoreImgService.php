<?php
namespace SeqArtMix\Service;

use Zend\Http\Header\SetCookie;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Description of StoreImgService
 *
 * @author BSCheshir
 */
class StoreImgService 
{
    /**
     * @var String
     */
    protected $mainCookie = 'seqArt';
    
    /**
     * get img list from cookie
     *
     * @param  AbstractActionController $ctr
     * @return array
     */
    public function getImgCollection(AbstractActionController $ctr)
    {
	$data=$ctr->getRequest()->getCookie();
	$arr=  preg_split('|[,;.]|', $data->{$this->mainCookie},-1,PREG_SPLIT_NO_EMPTY);
	$imgCollection=[];
	foreach ($arr as $val)
	    $imgCollection[$val]=$ctr->getImgHydrator()->hydrate(Array(
		    'id'=>  $val,
		    'url'=> $data->$val
		), 
		new \SeqArtMix\Entity\Img()
	    );
	return $imgCollection;
    }
    
    /**
     * get RegEx parsed url form url
     *
     * @param  AbstractActionController $ctr
     * @return String
     */
    public function setImg(AbstractActionController $ctr, $newEntity){
	$data=$ctr->getRequest()->getCookie();
	$arr=  preg_split('|[,;.]|', $data->{$this->mainCookie},-1,PREG_SPLIT_NO_EMPTY);
	$arr[]=$newEntity->getId();
	
	//store to cookies 1year
	$header = new \Zend\Http\Header\SetCookie();
	$header->setName($this->mainCookie);
	$header->setValue(implode(',', $arr));
	$header->setPath('/');
	$header->setExpires(time() + 3600*24*365);
	$ctr->getResponse()->getHeaders()->addHeader($header);

	$header = new \Zend\Http\Header\SetCookie();
	$header->setName($newEntity->getId());
	$header->setValue($newEntity->getUrl());
	$header->setPath('/');
	$header->setExpires(time() + 3600*24*365);
	$ctr->getResponse()->getHeaders()->addHeader($header);
    }
}
