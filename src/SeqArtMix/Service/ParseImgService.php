<?php
namespace SeqArtMix\Service;

/**
 * Description of ParseImgService
 *
 * @author BSCheshir
 */
class ParseImgService 
{
    
    /**
     * get img url form url collection
     *
     * @param  array of \SeqArtMix\Entity\Img $entity
     * @return array of \SeqArtMix\Entity\Img
     */
    public function parseCollection($entityCollection){
	foreach ($entityCollection as $entity)
	    $this->parseUrl($entity);
	return $entityCollection;
    }
    
    /**
     * get img url form url
     *
     * @param  \SeqArtMix\Entity\Img $entity
     * @return \SeqArtMix\Entity\Img
     */
    public function parseUrl(\SeqArtMix\Entity\Img $entity){
	$entity->setImgUrl(self::analyzeContent($entity->getUrl()));
	return $entity;
    }
    
    /**
    * Returns MIME-type of url.
    * @return string
    */
    protected static function getUrlMIMEType($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	curl_exec($ch);
        return curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    }
    /**
    * Returns html representation of object.
    * @return string
    */
   protected static function analyzeContent($src){
        $mimetype=  self::getUrlMIMEType($src);
        if(strpos($mimetype,'text/html')!==false){
            $html=  file_get_contents($src);
            $doc = new \DOMDocument();
            @$doc->loadHTML($html);
            $xml=simplexml_import_dom($doc); // just to make xpath more simple
            $images=$xml->xpath('//img');
            $max=0;
            foreach ($images as $img) {
		if(!parse_url($img['src'],PHP_URL_HOST)){
		    $purl=parse_url($src);
		    $img['src']=($purl['scheme'].'://'.$purl['host']).$img['src'];
		}
                $imagesize = @getimagesize($img['src']);
                $current=$imagesize[0]*$imagesize[1];
                if($max<$current=$imagesize[0]*$imagesize[1]){
                    $max=$current;
                    $src=(string)$img['src'];
                }
            }
        }
        return $src;
    }
    
}
