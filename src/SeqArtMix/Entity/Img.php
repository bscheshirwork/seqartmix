<?php
/**
 * Entity of Img
 *
 * @author BSCheshir
 *
 * @property string $id
 * @property string $url
 * @property integer $cur
 */
namespace SeqArtMix\Entity;

class Img 
{
    /**
     *
     * string id
     * @var string $id
     */
    protected $id;
    
    /**
     *
     * string url
     * @var string $url
     */
    protected $url;
    
    /**
     *
     * string img url
     * @var string $img
     */
    protected $imgUrl;
    
    /**
     *
     * string current counter
     * @var string $counter
     */
    protected $counter;

    /**
     *
     * string search mask
     * @var string $_mask
     */
    protected $mask = '/(\d+)\D*$/';
     
    /**
     *
     * string counter mask zero dimension
     * str_pad($counter,$counterDimension,'0',STR_PAD_LEFT);
     * @var string $counterDimension
     */
    protected $counterDimension;

     /**
     *
     * string counter position offset from left side
     * @var string $counterPositionOffset
     */
    protected $counterPositionOffset;
    
    /**
     * Parse filename and write data to object properties.
     * @param string $filename the filename
     * @return Imagename
     */
    public function parse($url = NULL){
        if($url)
            $this->url=$url;
        if(preg_match($this->mask,$this->url,$matches,PREG_OFFSET_CAPTURE)){
            $matches=array_reverse($matches);
            $this->counter=(int)$matches[0][0];
            $this->counterDimension=strlen($matches[0][0]);
            $this->counterPositionOffset=$matches[0][1];
        }
        return $this;
    }
    
    /**
     * Returns img url with offset.
     * @return string
     */
    public function __invoke($offset=NULL){
        return substr($this->url,0,$this->counterPositionOffset).str_pad($this->counter+(int)$offset,$this->counterDimension,'0',STR_PAD_LEFT).substr($this->url,$this->counterPositionOffset+$this->counterDimension);
    }
    
    /**
     * Change url with offset.
     * @return string
     */
    public function shift($offset=NULL){
	$this->parse(self::__invoke($offset));
    }
    
    /**
     * get id from entity
     *
     * @return String
     */
    public function getId() {
	return $this->id;
    }
    /**
     * set id to entity
     *
     * @param String $id
     */
    public function setId($id) {
	$this->id = $id;
    }
    /**
     * get url from entity
     *
     * @return String
     */
    public function getUrl() {
	return $this->url;
    }
    /**
     * set url to entity
     *
     * @param String $url
     */
    public function setUrl($url) {
	$this->url = $url;
    }
    /**
     * get current counter from entity
     *
     * @return Integer
     */
    public function getCur() {
	return $this->counter;
    }
    /**
     * set current counter to entity
     *
     * @param Integer $cur
     */
    public function setCur($cur) {
	$this->counter = $cur;
    }
    /**
     * get real path to img from entity
     *
     * @return String
     */
    public function getImgUrl() {
	return $this->imgUrl;
    }
    /**
     * set real path to img to entity
     *
     * @param String $cur
     */
    public function setImgUrl($imgUrl) {
	$this->imgUrl = $imgUrl;
    }
}

?>
