<?php

namespace Inkl\AssetManager\Manager;

class AssetManager
{
	const BASE_THEME = 'base';

	/** @var array */
	private $paths = [];

	/** @var string */
	private $publicPath;

	/** @var string */
	private $publishFolder;

	/** @var string */
	private $publishPath;

	/** @var string */
	private $theme;


	/**
	 * AssetManagerLoader constructor.
	 * @param $publicPath
	 * @param string $publishFolder
	 * @param string $theme
	 */
	public function __construct($publicPath, $publishFolder = 'assets', $theme = 'base')
	{
		$this->publicPath = realpath($publicPath);
		$this->publishFolder = $publishFolder;
		$this->publishPath = $publicPath . '/' . $publishFolder;
		$this->theme = $theme;
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


	public function getBaseTheme() {
		return self::BASE_THEME;
	}


	public function getTheme() {
		return $this->theme;
	}


	public function addPath($namespace, $path)
	{
		$this->paths[$namespace] = $path;
	}

	public function getPaths() {
		return $this->paths;
	}

}
