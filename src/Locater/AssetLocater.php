<?php

namespace Inkl\AssetManager\Locater;

use Inkl\AssetManager\Manager\AssetManager;

class AssetLocater
{

	/** @var AssetManager */
	private $assetManager;

	/**
	 * AssetManager constructor.
	 * @param AssetManager $assetManager
	 */
	public function __construct(AssetManager $assetManager)
	{
		$this->assetManager = $assetManager;
	}


	public function getUrl($name)
	{
		if ($file = $this->find($name)) {

			return strtr($file, [
				$this->assetManager->getPublicPath() => '',
				'\\' => '/'
			]);
		}

		return '';
	}

	public function getPath($name)
	{
		return $this->find($name);
	}


	private function find($name)
	{
		$nameParts = explode('/', $name);
		if (count($nameParts) < 2)
		{
			return '';
		}

		$publishPath = $this->assetManager->getPublishPath();

		$baseTheme = $this->assetManager->getBaseTheme();
		$theme = $this->assetManager->getTheme();

		$path = str_replace('@', '', array_shift($nameParts));
		$filename = implode('/', $nameParts);

		// current theme
		$file = $publishPath . '/' . $path . '/' . $theme . '/' . $filename;
		if ($file = realpath($file)) {
			return $file;
		}

		// fallback to base
		if ($theme != $baseTheme) {
			$file = $publishPath . '/' . $path . '/' . $baseTheme . '/' . $filename;
			if ($file = realpath($file)) {
				return $file;
			}
		}

		return '';
	}


}
