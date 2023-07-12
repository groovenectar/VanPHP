<?php

require_once(__DIR__ . '/../src/DomElement/Factory.php');
require_once(__DIR__ . '/../src/DomElement/Output/AbstractOutput.php');
require_once(__DIR__ . '/../src/DomElement/Output/Html.php');
require_once(__DIR__ . '/../src/DomElement/Output/VanJs.php');
require_once(__DIR__ . '/../src/DomElement/Renderer/JsFunc.php');

use Dup\VanPHP\DomElement;
use Dup\VanPHP\DomElement\Renderer\JsFunc;

$h = new DomElement\Factory(new DomElement\Output\Html);
$v = new DomElement\Factory(new DomElement\Output\VanJs);

echo $v->label(
	['for' => 'testInput'],
	$v->div('Label text wrapped in nested div'),
	'Label text not wrapped in div',
	$v->input(['type' => 'text', 'id' => 'testInput']),
	$v->button(['onclick' => fn() => new JsFunc(__DIR__ . '/OnClickFunc.js')], 'Click Me')
) . "\n";

echo $h->label(
	['for' => 'testInput'],
	$h->div('Label text wrapped in div'),
	'Label text not wrapped in div',
	$h->input(['type' => 'text', 'id' => 'testInput']),
	$h->button(['onclick' => fn() => new JsFunc(__DIR__ . '/OnClickInline.js')], 'Click Me')
) . "\n";
