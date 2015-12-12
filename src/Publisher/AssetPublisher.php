<?php

namespace Inkl\AssetManager\Publisher;

use Inkl\AssetManager\Manager\AssetManager;
use Symfony\Component\Filesystem\Filesystem;

class AssetPublisher
{
	/** @var Filesystem */
	private $filesystem;

	/**
	 * AssetManagerPublisher constructor.
	 * @param AssetManager $assetManager
	 * @param Filesystem $filesystem
	 */
	public function __construct(AssetManager $assetManager, Filesystem $filesystem)
	{
		$this->assetManager = $assetManager;
		$this->filesystem = $filesystem;
	}


	public function publish()
	{
		$this->preparePublishFolder();

		$this->copyFiles();

		return true;
	}


	private function copyFiles() {

		$publishPath = $this->assetManager->getPublishPath();
		$paths = $this->assetManager->getPaths();
		foreach ($paths as $namespace => $path) {

			if (!$this->filesystem->exists($path))
			{
				continue;
			}

			$themeFolders = $this->getThemeFolders($path);

			foreach ($themeFolders as $themeFolder) {

				$from = $path . '/' . $themeFolder . '/assets/';
				$to = $publishPath . '/' . $namespace . '/' . $themeFolder . '/';

				$this->filesystem->symlink($from, $to);
			}

		}

	}


	private function getThemeFolders($path) {

		$themeFolders = [];
		foreach (new \DirectoryIterator($path) as $info)
		{
			if (!$info->isDot() && $info->isDir())
			{
				$themeFolders[] = $info->getBasename();
			}
		}

		return $themeFolders;
	}


	private function preparePublishFolder() {
		$publishPath = $this->assetManager->getPublishPath();

		if ($this->filesystem->exists($publishPath)) {
			$this->filesystem->remove($publishPath);
		}

		$this->filesystem->mkdir($publishPath);
	}

}
