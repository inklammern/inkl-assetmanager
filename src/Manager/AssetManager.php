<?php

namespace Inkl\AssetManager\Manager;

class AssetManager
{
	const BASE_THEME = 'base';

	/** @var array */
	private $folders = [];

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
		$this->publishPath = realpath($publicPath . '/' . $publishFolder);
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


	public function addFolder($namespace, $folder)
	{
		$this->folders[$namespace] = $folder;
	}

	public function getFolders() {
		return $this->folders;
	}

}
