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

			$publicPath = str_replace('\\', '/', $this->assetManager->getPublicPath());
			$file = str_replace('\\', '/', $file);

			return strtr($file, [
				$publicPath => '',
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

		$path = str_replace('@', '', array_shift($nameParts));
		$filename = implode('/', $nameParts);

		foreach ($this->assetManager->getThemes() as $theme)
		{
			$file = $publishPath . '/' . $path . '/' . $theme . '/' . $filename;
			if (file_exists($file)) {
				return $file;
			}
		}

		return '';
	}


}
