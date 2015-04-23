<?php

namespace Ns\Core\Libraries\Form\Element;

use Ns\Core\Libraries\Form\AbstractElement;
use Ns\Core\Libraries\Form\ElementInterface;

//abstract class AbstractInput extends AbstractElement implements ElementInterface
abstract class AbstractInput extends AbstractElement implements ElementInterface
{
	/**
     * Get this input element type.
     *
     * @return string
     */
    abstract public function getInputType();

    /**
     * Get element default attribute.
     *
     * @return array
     */
    public function getDefaultAttributes()
    {
        return array_merge(parent::getDefaultAttributes(), ['type' => $this->getInputType()]);
    }

    /**
     * Get element html template.
     *
     * @return string
     */
    public function getHtmlTemplate()
    {
        return $this->getOption('htmlTemplate', '<input' . $this->_renderAttributes() . ' value="%s">');
    }

    /**
     * Render element.
     *
     * @return string
     */
    public function render()
    {
        return sprintf(
            $this->getHtmlTemplate(),
            $this->getValue()
        );
    }
}