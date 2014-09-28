<?php
/**
 * BSCheshir
 *
 * form for add img object
 * @copyright Copyright (c) 2014 BSCheshir
 * @license   New BSD License
 */

namespace SeqArtMix\Form;

use Zend\Form\Form;

/**
 * form for add img object
 */
class ImgAdd extends Form
{
    /**
     * Constructor of img form.
     */
    public function __construct() {
	parent::__construct('img-add-form');
	$this->setAttribute('method', 'post');
	
	$this->add(array(
	    'type'=>'SeqArtMix\Form\ImgFieldset',
	    'options'=>array(
		'use_as_base_fieldset'=>true
	    )
	));
	$this->add(array(
	    'name'=>'submit',
	    'attributes'=>array(
		'type'=>'submit',
		'value'=>'Добавить'
	    )
	));
    }
}
