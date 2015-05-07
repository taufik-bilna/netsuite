<?php

namespace Ns\Netsuite\Libraries\Grid\Renderer;

use Ns\Core\Libraries\Grid\GridItem;

class Xml
{
	public function render(GridItem $item, $di, $column)
	{
		$value = $item[$column['colname']];

		if(!trim($value)) return '';

		$dom = new \DOMDocument;
        $dom->preserveWhiteSpace = false;
        @$dom->loadXML($value);
        $dom->formatOutput = true;
        
        return "<textarea style='width: 400px;height:200px;'>".$dom->saveXML()."</textarea>";
	}
}