<?php

namespace Dup\VanPHP\DomElement\Output;

use Dup\VanPHP\DomElement;

abstract class AbstractOutput {
	public string $encoding = 'UTF-8';
	abstract public function render(DomElement\Factory $element) : string;
	abstract public function attributesToString(array $attributes) : string;
}
