<?php

namespace Dup\VanPHP\DomElement\Renderer;

class JsFunc {
	public array $params;
	public function __construct(public string $file, ...$params) {
		$this->params = $params;
	}
	public function renderFunc() : string {
		return preg_replace('/^const fn\s*=\s*/', '', $this->renderRequire());
	}
	public function renderRequire() : string {
		return trim(file_get_contents($this->file));
	}
}
