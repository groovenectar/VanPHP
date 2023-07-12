<?php

namespace Dup\VanPHP\DomElement\Renderer;

class JsFunc {
	public function __construct(public string $file) {}
	public function renderFunc() : string {
		return preg_replace('/^const fn\s*=\s*/', '', $this->renderRequire());
	}
	public function renderRequire() : string {
		return trim(file_get_contents($this->file));
	}
}
