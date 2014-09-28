<?php
namespace SeqArtMix\Mapper;

use Zend\Stdlib\Hydrator\Reflection;
use SeqArtMix\Entity\Img as ImgEntity;

/**
 * Description of ImgHydrator
 *
 * @author BSCheshir
 */
class ImgHydrator extends Reflection
{
    /**
     * get Reflection hydrate and fill some another field
     *
     * @param  array $data
     * @param  \SeqArtMix\Entity\Img $object
     * @return String
     */
    public function hydrate(array $data, $object)
    {
	if (!$object instanceof ImgEntity){
	    throw new \InvalidArgumentException(
		'$object must be an instance of SeqArtMix\Entity\Img'
	    );
	}
	$result=parent::hydrate($data, $object);
	$object->parse();
	return $result;
    }

}
