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
		$folders = $this->assetManager->getFolders();
		foreach ($folders as $namespace => $folder) {

			if (!$this->filesystem->exists($folders))
			{
				continue;
			}

			$themeFolders = $this->getThemeFolders($folder);

			foreach ($themeFolders as $themeFolder) {

				$from = $folder . '/' . $themeFolder . '/assets/';
				$to = $publishPath . '/' . $namespace . '/' . $themeFolder . '/';

				$this->filesystem->mirror($from, $to);
			}

		}

	}


	private function getThemeFolders($folder) {

		$themeFolders = [];
		foreach (new \DirectoryIterator($folder) as $info)
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
