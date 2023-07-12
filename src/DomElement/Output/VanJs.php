<?php

namespace Dup\VanPHP\DomElement\Output;

use Dup\VanPHP\DomElement;

class VanJs extends AbstractOutput {
	public function render(DomElement\Factory $element) : string {
		$html = $element->tag . '(';
		if (count($element->attributes)) {
			$html .= $this->attributesToString($element->attributes);
			if (!empty($element->content)) {
				$html .= ', ';
			}
		}
		$contentCollection = [];
		foreach ($element->content as $content) {
			if ($content instanceof DomElement\Factory) {
				$contentCollection[] = (string)$content;
			} else {
				$contentCollection[] = json_encode($content);
			}
		}
		$html .= implode(', ', $contentCollection);
		return $html . ')';
	}

	public function attributesToString(array $attributes) : string {
		if (empty($attributes)) {
			return '';
		}
		$collection = [];
		foreach ($attributes as $attribute => $value) {
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
