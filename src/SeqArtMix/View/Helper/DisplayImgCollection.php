<?php
/**
 *
 * @author BSCheshir
 */
namespace SeqArtMix\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\PartialLoop;

/**
 * Helper for rendering a template fragment in its own variable scope; iterates
 * over data provided and renders for each iteration.
 */
class DisplayImgCollection extends PartialLoop
{
    /**
     * Renders a template fragment within a variable scope distinct from the
     * calling View object.
     *
     * If no arguments are provided, returns object instance.
     *
     * @param  string $name   Name of view script
     * @param  array  $values Variable to populate in the view
     * @param  array  $key with it Variable populate in the view
     * @throws Exception\InvalidArgumentException
     * @return string
     */
    public function __invoke($name = null, $values = null, $key = null)
    {
	$nvalues=Array();
	foreach ((array)$values as $value)
	    $nvalues[][$key]=$value;
        return parent::__invoke($name, $nvalues);
    }
}

?>
