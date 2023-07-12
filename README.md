# VanPHP

A mechanism to build a VanJS (or HTML) DOM tree using PHP.

## Example

The following PHP code:

```php
require(__DIR__ . '/../vendor/autoload.php');

use Dup\VanPHP\DomElement;
use Dup\VanPHP\DomElement\Renderer\JsFunc;

$v = new DomElement\Factory(new DomElement\Output\VanJs);

echo $v->label(
	['for' => 'testInput'],
	$v->div('Label text wrapped in nested div'),
	'Label text not wrapped in div',
	$v->input(['type' => 'text', 'id' => 'testInput']),
	$v->button(['onclick' => fn() => new JsFunc(__DIR__ . '/OnClickFunc.js')], 'Click Me')
) . "\n";
```

Outputs the following VanJS DOM tree (indented for readability):

```javascript
label(
	{ for: "testInput" },
	div("Label text wrapped in nested div"),
	"Label text not wrapped in div",
	input({ type: "text", id: "testInput" }),
	button(
		{
			onclick: (e) => {
				e.preventDefault()
				alert(document.getElementById('testInput').value)
			}
		},
		"Click Me"
	)
)
```

The following PHP code with the same input syntax:

```php
echo $h->label(
	['for' => 'testInput'],
	$h->div('Label text wrapped in div'),
	'Label text not wrapped in div',
	$h->input(['type' => 'text', 'id' => 'testInput']),
	$h->button(['onclick' => fn() => new JsFunc(__DIR__ . '/OnClickInline.js')], 'Click Me')
) . "\n";
```

Outputs the following HTML DOM tree (indented for readability):

```html
<label for="testInput">
    <div>Label text wrapped in div</div>
    Label text not wrapped in div
    <input type="text" id="testInput" />
    <button onclick="alert(document.getElementById('testInput').value);">Click Me</button>
</label>
```

## Why?

One possible use case that comes to mind is SSR for VanJS generated from PHP, since this can generate both HTML and VanJS with the same style of input.

Consider this example:

```php
function renderOutput($e) {
	return $e->label(
		['for' => 'testInput'],
		$e->div('Label text wrapped in nested div'),
		'Label text not wrapped in div',
		$e->input(['type' => 'text', 'id' => 'testInput']),
		$e->button(['onclick' => fn() => new JsFunc(__DIR__ . '/OnClickFunc.js')], 'Click Me')
	) . "\n";
}

$e = new DomElement\Factory(new DomElement\Output\Html);
echo renderOutput($e);

$e->output = new DomElement\Output\VanJs;
echo renderOutput($e);
```

In this case, the same input from `renderOutput()` is being used to generate both HTML and VanJS DOM.

## Getting started

Via Composer:

```shell
mkdir VanPHP && cd VanPHP
composer require groovenectar/vanphp
php vendor/groovenectar/vanphp/test/test.php
```

Via Git:

```shell
git clome https://github.com/groovenectar/VanPHP.git && cd VanPHP
php test/test.php

# Optionally use Composer for autoloading
composer dump-autoload
```
