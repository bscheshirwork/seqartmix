<?php
/**
 * BSCheshir
 *
 * fieldset for form img object
 * @copyright Copyright (c) 2014 BSCheshir
 * @license   New BSD License
 */

namespace SeqArtMix\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class ImgFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * Constructor of img fieldset.
     */
    public function __construct() {
	parent::__construct('img');
	
	$this->add(array(
	    'name'=>'id',
	    'attributes'=>array(
		'type'=>'text',
	    ),
	    'options'=>array(
		'label'=>'ID изображений'
	    )
	));
	
	$this->add(array(
	    'name'=>'url',
	    'attributes'=>array(
		'type'=>'text',
	    ),
	    'options'=>array(
		'label'=>'url изображения'
	    )
	));
    }
    
    /**
     * Specifies the filter and validators rules.
     * @return array of input filter
     */
    public function getInputFilterSpecification() {
	return array(
	    'id'=>array(
		'required'=>true,
		'filters'=>array(
		    array(
			'name'=>'StringTrim'
		    )
		),
		'validators'=>array(
		    array(
			'name'=>'NotEmpty',
			'options'=>array(
			    'message'=>'Пожалуйста, введите идентификатор изображений'
			)
		    )
		)
	    ),
	    'url'=>array(
		'required'=>true,
		'filters'=>array(
		    array(
			'name'=>'StringTrim'
		    )
		),
		'validators'=>array(
		    array(
			'name'=>'NotEmpty',
			'options'=>array(
			    'message'=>'Пожалуйста, введите url последнего просмотренного изображения'
			)
		    )
		)
	    )
	);
    }
}
