<?php

namespace Ns\Core\Libraries\Form\Element;

use Ns\Core\Libraries\Form\ElementInterface;

class Text extends AbstractInput implements ElementInterface
{
	/**
     * Get this input element type.
     *
     * @return string
     */
    public function getInputType()
    {
        return 'text';
    }
}