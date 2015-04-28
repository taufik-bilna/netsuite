<?php

namespace Ns\Core\Libraries\Form\Element;

use Ns\Core\Libraries\Form\AbstractElement;
use Ns\Core\Libraries\Form\ElementInterface;

class DateRange extends AbstractElement implements ElementInterface
{
    /**
     * Get element default attribute.
     *
     * @return array
     */
    public function getDefaultAttributes()
    {
        $default = ['id' => $this->getName(), 'name' => $this->getName(), 'type' => $this->getInputType()];
        if ($this->getOption('required')) {
            $default['required'] = 'required';
        }
        return $default;
    }
    /**
     * Get this input element type.
     *
     * @return string
     */
    public function getInputType()
    {
        return 'text';
    }

    /**
     * Get element default attribute.
     *
     * @return array
     */
    /*
public function getDefaultAttributes()
    {
        return array_merge(parent::getDefaultAttributes(),   ['type' => $this->getInputType()]);
    }
*/

    /**
     * Get element html template.
     * <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
     *                                    <input type="text" class="form-control dpd1" name="from">
     *                                     <span class="input-group-addon">To</span>
     *                                     <input type="text" class="form-control dpd1" name="to">
     *                                 </div>
     * @return string
     */
    public function getHtmlTemplate()
    {
        return $this->getOption('htmlTemplate', '<div class="input-group input-large .default-date-picker" data-date="13/07/2013" data-date-format="mm-dd-yyyy"><input data-between="from" class="form-control dpd1" ' . $this->_renderAttributes('from') . ' value="%s"><span class="input-group-addon">To</span><input data-between="to" class="form-control dpd2" ' . $this->_renderAttributes('to') . ' value="%s"></div>');
    }
    
    /**
     * Get attributes as html.
     *
     * @return string
     */
    protected function _renderAttributes($suffix='from')
    {
        $html = '';
        foreach ($this->_attributes as $key => $attribute) {
            /*if($key == 'id' || $key == 'name')
                $attribute = $attribute.'['.$suffix.']';*/
            //else
            //    $suffix = "";

            $html .= sprintf(' %s="%s"', $key , $attribute );
        }

        return $html;
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
            $this->getValue(),
            $this->getValue()
        );
    }
}