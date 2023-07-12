<?php

namespace Dup\VanPHP\DomElement\Output;

use Dup\VanPHP\DomElement;

class Html extends AbstractOutput {
	public function render(DomElement\Factory $element) : string {
		return $element->isSelfClosing() ?
			'<' . $element->tag . $this->attributesToString($element->attributes) . ' />' :
			'<' . $element->tag . $this->attributesToString($element->attributes) . '>' .
			implode('', $element->children) .
			'</' . $element->tag .  '>';
	}

	public function attributesToString(array $attributes) : string {
		$string = '';
		foreach($attributes as $name => $value) {
			if (is_callable($value)) {
				$value = $value();
				if ($value instanceof DomElement\Renderer\JsFunc) {
					$value = $value->renderRequire();
				}
			}
			$string .= ' ' . $name . '="' . htmlentities($value, ENT_COMPAT, $this->encoding) .'"';
		}
		return $string;
	}
}
