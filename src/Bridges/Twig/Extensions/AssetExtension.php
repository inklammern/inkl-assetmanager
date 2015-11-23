<?php

namespace Inkl\AssetManager\Bridges\Twig\Extensions;

use Inkl\AssetManager\Locater\AssetLocater;

class AssetExtension extends \Twig_Extension
{
	/** @var AssetLocater */
	private $assetLocater;

	/**
	 * AssetExtension constructor.
	 * @param AssetLocater $assetLocater
	 */
	public function __construct(AssetLocater $assetLocater)
	{
		$this->assetLocater = $assetLocater;
	}


	public function getFunctions()
	{
		return [
			new \Twig_SimpleFunction('asset_url', [$this, 'getAssetUrl']),
			new \Twig_SimpleFunction('asset_path', [$this, 'getAssetPath']),
		];
	}


	public function getAssetUrl($name)
	{
		return $this->assetLocater->getUrl($name);
	}


	public function getAssetPath($name)
	{
		return $this->assetLocater->getPath($name);
	}


	public function getName()
	{
		return 'asset';
	}

}
