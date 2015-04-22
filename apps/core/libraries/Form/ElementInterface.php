<?php

namespace Ns\Core\Libraries\Form;

interface ElementInterface
{
	/**
     * Element constructor.
     *
     * @param string $name       Element name.
     * @param array  $options    Element options.
     * @param array  $attributes Element attributes.
     */
    public function __construct($name, array $options = [], array $attributes = []);

    /**
     * If element is need to be rendered in default layout.
     *
     * @return bool
     */
    public function useDefaultLayout();

    /**
     * If element is ignored in $form->getValues().
     *
     * @return bool
     */
    public function isIgnored();

    /**
     * Sets the element option.
     *
     * @param string $value  Element value.
     * @param bool   $escape Try to escape html in value.
     *
     * @return AbstractForm
     */
    public function setValue($value, $escape = true);

    /**
     * Returns the element's value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Returns element's options.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Sets the element option.
     *
     * @param string $name  Option name.
     * @param string $value Options value.
     *
     * @return AbstractForm
     */
    public function setOption($name, $value);

    /**
     * Returns the element's option.
     *
     * @param string $name Option name.
     *
     * @return mixed
     */
    public function getOption($name);

    /**
     * Returns the attributes for the element.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Sets the element option.
     *
     * @param string $name  Option name.
     * @param string $value Options value.
     *
     * @return AbstractForm
     */
    public function setAttribute($name, $value);

    /**
     * Returns the element's option.
     *
     * @param string $name Option name.
     *
     * @return string
     */
    public function getAttribute($name);

    /**
     * Sets the element's name.
     *
     * @param string $name Element name.
     *
     * @return AbstractForm
     */
    public function setName($name);

    /**
     * Returns the element's name.
     *
     * @return string
     */
    public function getName();

    /**
     * Render element.
     *
     * @return string
     */
    public function render();

    /**
     * Get element html template.
     *
     * @return string
     */
    public function getHtmlTemplate();

    /**
     * Get allowed options for this element.
     *
     * @return array
     */
    public function getAllowedOptions();

    /**
     * Get element default options.
     *
     * @return array
     */
    public function getDefaultOptions();

    /**
     * Get element default attribute.
     *
     * @return array
     */
    public function getDefaultAttributes();
}