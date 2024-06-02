<?php
/** lib/Hooks/ElisaFilesHooks.php */
declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa\Hooks;

use OCP\ILogger;
use OCA\Elisa\ElisaDatabaseManager;

class ElisaFilesHooks {
	private ILogger $logger;
	private ElisaDatabaseManager $dbManager;

	public function __construct(ILogger $logger) {
		$this->logger = $logger;
		$this->dbManager = \OC::$server->query(ElisaDatabaseManager::class);
	}

	public function fileCreate($path): void {
		$this->logger->info('file create: ' . $path);
		$this->dbManager->getDatabase()->addMusicFile($path);
	}

	public function fileUpdate($path): void {
		$this->logger->info('file update: ' . $path);
		$this->dbManager->getDatabase()->updateMusicFile($path);
	}

	public function fileDelete($path): void {
		$this->logger->info('file delete: ' . $path);
		$this->dbManager->getDatabase()->removeMusicFile($path);
	}

	public function fileMove($oldpath, $newpath): void {
		$this->logger->info('file move: from ' . $oldpath . ' to ' . $newpath);
		$this->dbManager->getDatabase()->removeMusicFile($oldpath);
		$this->dbManager->getDatabase()->addMusicFile($newpath);
	}

	public function fileMovePost($oldpath, $newpath): void {
		$this->logger->info('file move post: from ' . $oldpath . ' to ' . $newpath);
	}
}
