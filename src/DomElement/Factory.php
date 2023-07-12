<?php

namespace Dup\VanPHP\DomElement;

use Dup\VanPHP\DomElement\Output\AbstractOutput;

/**
 * # Root Element
 * @method html (mixed ...$attrsOrContent)
 *
 * # Metadata
 * @method base (mixed ...$attrsOrContent)
 * @method head (mixed ...$attrsOrContent)
 * @method link (mixed ...$attrsOrContent)
 * @method meta (mixed ...$attrsOrContent)
 * @method style (mixed ...$attrsOrContent)
 * @method title (mixed ...$attrsOrContent)
 *
 * # Sections
 * @method address (mixed ...$attrsOrContent)
 * @method article (mixed ...$attrsOrContent)
 * @method aside (mixed ...$attrsOrContent)
 * @method body (mixed ...$attrsOrContent)
 * @method footer (mixed ...$attrsOrContent)
 * @method header (mixed ...$attrsOrContent)
 * @method h1 (mixed ...$attrsOrContent)
 * @method h2 (mixed ...$attrsOrContent)
 * @method h3 (mixed ...$attrsOrContent)
 * @method h4 (mixed ...$attrsOrContent)
 * @method h5 (mixed ...$attrsOrContent)
 * @method h6 (mixed ...$attrsOrContent)
 * @method nav (mixed ...$attrsOrContent)
 * @method section (mixed ...$attrsOrContent)
 *
 * # Grouping
 * @method blockquote (mixed ...$attrsOrContent)
 * @method dd (mixed ...$attrsOrContent)
 * @method div (mixed ...$attrsOrContent)
 * @method dl (mixed ...$attrsOrContent)
 * @method dt (mixed ...$attrsOrContent)
 * @method figcaption (mixed ...$attrsOrContent)
 * @method figure (mixed ...$attrsOrContent)
 * @method hr (mixed ...$attrsOrContent)
 * @method li (mixed ...$attrsOrContent)
 * @method main (mixed ...$attrsOrContent)
 * @method ol (mixed ...$attrsOrContent)
 * @method p (mixed ...$attrsOrContent)
 * @method pre (mixed ...$attrsOrContent)
 * @method ul (mixed ...$attrsOrContent)
 *
 * # Text
 * @method a (mixed ...$attrsOrContent)
 * @method abbr (mixed ...$attrsOrContent)
 * @method b (mixed ...$attrsOrContent)
 * @method bdi (mixed ...$attrsOrContent)
 * @method bdo (mixed ...$attrsOrContent)
 * @method br (mixed ...$attrsOrContent)
 * @method cite (mixed ...$attrsOrContent)
 * @method code (mixed ...$attrsOrContent)
 * @method data (mixed ...$attrsOrContent)
 * @method dfn (mixed ...$attrsOrContent)
 * @method em (mixed ...$attrsOrContent)
 * @method i (mixed ...$attrsOrContent)
 * @method kbd (mixed ...$attrsOrContent)
 * @method mark (mixed ...$attrsOrContent)
 * @method q (mixed ...$attrsOrContent)
 * @method rb (mixed ...$attrsOrContent)
 * @method rp (mixed ...$attrsOrContent)
 * @method rt (mixed ...$attrsOrContent)
 * @method rtc (mixed ...$attrsOrContent)
 * @method ruby (mixed ...$attrsOrContent)
 * @method s (mixed ...$attrsOrContent)
 * @method samp (mixed ...$attrsOrContent)
 * @method small (mixed ...$attrsOrContent)
 * @method span (mixed ...$attrsOrContent)
 * @method strong (mixed ...$attrsOrContent)
 * @method sub (mixed ...$attrsOrContent)
 * @method sup (mixed ...$attrsOrContent)
 * @method time (mixed ...$attrsOrContent)
 * @method u (mixed ...$attrsOrContent)
 * @method var (mixed ...$attrsOrContent)
 * @method wbr (mixed ...$attrsOrContent)
 *
 * # Edits
 * @method del (mixed ...$attrsOrContent)
 * @method ins (mixed ...$attrsOrContent)
 *
 * # Interactive Elements
 * @method details (mixed ...$attrsOrContent)
 * @method dialog (mixed ...$attrsOrContent)
 * @method menu (mixed ...$attrsOrContent)
 * @method menuitem (mixed ...$attrsOrContent)
 * @method summary (mixed ...$attrsOrContent)
 *
 * # Scripting
 * @method canvas (mixed ...$attrsOrContent)
 * @method noscript (mixed ...$attrsOrContent)
 * @method script (mixed ...$attrsOrContent)
 * @method template (mixed ...$attrsOrContent)
 *
 * # Tables
 * @method caption (mixed ...$attrsOrContent)
 * @method col (mixed ...$attrsOrContent)
 * @method colgroup (mixed ...$attrsOrContent)
 * @method table (mixed ...$attrsOrContent)
 * @method tbody (mixed ...$attrsOrContent)
 * @method td (mixed ...$attrsOrContent)
 * @method tfoot (mixed ...$attrsOrContent)
 * @method th (mixed ...$attrsOrContent)
 * @method thead (mixed ...$attrsOrContent)
 * @method tr (mixed ...$attrsOrContent)
 *
 * # Forms
 * @method button (mixed ...$attrsOrContent)
 * @method datalist (mixed ...$attrsOrContent)
 * @method fieldset (mixed ...$attrsOrContent)
 * @method form (mixed ...$attrsOrContent)
 * @method input (mixed ...$attrsOrContent)
 * @method label (mixed ...$attrsOrContent)
 * @method legend (mixed ...$attrsOrContent)
 * @method meter (mixed ...$attrsOrContent)
 * @method optgroup (mixed ...$attrsOrContent)
 * @method option (mixed ...$attrsOrContent)
 * @method output (mixed ...$attrsOrContent)
 * @method progress (mixed ...$attrsOrContent)
 * @method select (mixed ...$attrsOrContent)
 * @method textarea (mixed ...$attrsOrContent)
 *
 * # Embedded Content
 * @method area (mixed ...$attrsOrContent)
 * @method audio (mixed ...$attrsOrContent)
 * @method embed (mixed ...$attrsOrContent)
 * @method iframe (mixed ...$attrsOrContent)
 * @method img (mixed ...$attrsOrContent)
 * @method map (mixed ...$attrsOrContent)
 * @method object (mixed ...$attrsOrContent)
 * @method param (mixed ...$attrsOrContent)
 * @method picture (mixed ...$attrsOrContent)
 * @method source (mixed ...$attrsOrContent)
 * @method track (mixed ...$attrsOrContent)
 * @method video (mixed ...$attrsOrContent)
 */
class Factory {
	public string $tag;
	public array $attributes = [];
	public array $children = [];
	protected static array $selfClosingTags = ['area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta'];

	public function __construct(public AbstractOutput $output) { }

	// __call magic method https://www.php.net/manual/en/language.oop5.overloading.php#object.call
	// Allows arbitrary elements to be created e.g. $this->div($param1, $param2, $param3...)
	// $param1, $param2, etc are stored in array $attributes
	public function __call(string $name, array $attributes) : self {
		// Instantiate a new Factory for returning
		$element = new $this($this->output);
		$element->tag = $name;
		if (empty($attributes)) {
			return $element;
		}
		// If the first (and only the first) parameter is an array, those are the element's attributes
		if (is_array($attributes[0])) {
			// array_shift returns the first $attribute and also removes it from the array
			$element->attributes = array_shift($attributes);
		}
		// The rest of the parameters will be the child elements. If none, it's an empty array
		$element->children = $attributes;
		return $element;
	}

	public function isSelfClosing() : bool {
		return in_array($this->tag, self::$selfClosingTags);
	}

	public function __toString() : string {
		return $this->output->render($this);
	}
}
