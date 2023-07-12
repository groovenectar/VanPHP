<?php

namespace Dup\VanPHP\DomElement\Output;

use Dup\VanPHP\DomElement;

class VanJs extends AbstractOutput {
	public function render(DomElement\Factory $element) : string {
		$html = $element->tag . '(';
		if (count($element->attributes)) {
			$html .= $this->attributesToString($element->attributes);
			if (!empty($element->children)) {
				$html .= ', ';
			}
		}
		$childrenCollection = [];
		foreach ($element->children as $children) {
			if ($children instanceof DomElement\Factory) {
				$childrenCollection[] = (string)$children;
			} else {
				$childrenCollection[] = json_encode($children);
			}
		}
		$html .= implode(', ', $childrenCollection);
		return $html . ')';
	}

	public function attributesToString(array $attributes) : string {
		if (empty($attributes)) {
			return '';
		}
		$collection = [];
		foreach ($attributes as $attribute => $value) {
			// Determine whether the key will have quotes around it. E.g., "data-*" attributes
			$key = preg_match('/^[a-zA-Z_][a-zA-Z_0-9]+$/', $attribute) ? $attribute : '"' . $attribute . '"';
			if (is_callable($value)) {
				$value = $value();
				if ($value instanceof DomElement\Renderer\JsFunc) {
					$value = $value->renderFunc();
				}
			} else {
				$value = json_encode($value);
			}
			$collection[] = $key . ': ' . $value;
		}
		return '{' . implode(', ', $collection) . '}';
	}
}
