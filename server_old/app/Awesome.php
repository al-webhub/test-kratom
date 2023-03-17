<?php
namespace App;

use ImageOptimizer;

class Awesome extends \League\Flysystem\Adapter\Local {
	public function write($path, $contents, \League\Flysystem\Config $config) {
		$location = $this->applyPathPrefix($path);
		$this->ensureDirectory(dirname($location));

		if (($size = file_put_contents($location, $contents, $this->writeFlags)) === false) {
			return false;
		}

		ImageOptimizer::optimize($location, $location);
		if(($size = filesize($location)) === false) {
			return false;
		}

		$type = 'file';
		$result = compact('contents', 'type', 'size', 'path');

		if ($visibility = $config->get('visibility')) {
			$result['visibility'] = $visibility;
			$this->setVisibility($path, $visibility);
		}

		return $result;
	}

	public function update($path, $contents, \League\Flysystem\Config $config) {
		$location = $this->applyPathPrefix($path);
		$size = file_put_contents($location, $contents, $this->writeFlags);

		if ($size === false) {
			return false;
		}

		ImageOptimizer::optimize($location, $location);

		if(($size = filesize($location)) === false) {
			return false;
		}

		$type = 'file';

		$result = compact('type', 'path', 'size', 'contents');

		if ($mimetype = Util::guessMimeType($path, $contents)) {
			$result['mimetype'] = $mimetype;
		}

		return $result;
	}
}