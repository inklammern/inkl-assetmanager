<?php

namespace Inkl\AssetManager\Manager;

class AssetManager
{
	/** @var array */
	private $paths = [];

	/** @var string */
	private $publicPath;

	/** @var string */
	private $publishFolder;

	/** @var string */
	private $publishPath;

	/** @var string */
	private $themes = [];


	/**
	 * AssetManagerLoader constructor.
	 * @param $publicPath
	 * @param string $publishFolder
	 * @param array $themes
	 */
	public function __construct($publicPath, $publishFolder, array $themes)
	{
		$this->publicPath = realpath($publicPath);
		$this->publishFolder = $publishFolder;
		$this->publishPath = $publicPath . '/' . $publishFolder;
		$this->themes = $themes;
	}


	public function getPublicPath() {
		return $this->publicPath;
	}


	public function getPublishFolder() {
		return $this->publishFolder;
	}


	public function getPublishPath() {
		return $this->publishPath;
	}


	public function getThemes() {
		return $this->themes;
	}


	public function addPath($path, $namespace)
	{
		$this->paths[$namespace] = $path;
	}

	public function getPaths() {
		return $this->paths;
	}

}
