<?php
/** lib/Jobs/ElisaDatabaseUpdateJob.php */
declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa\Jobs;

use \OCP\BackgroundJob\QueuedJob;
use OCP\Files\IRootFolder;
use OCP\Files\IAppData;
use OCP\ILogger;
use OCA\Elisa\ElisaDatabaseManager;
use Psr\Log\LoggerInterface;

class ElisaDatabaseUpdateJob extends QueuedJob {
	private string $databaseFolder = '/database';
	private ElisaDatabaseManager $dbManager;

	public function __construct(ITimeFactory $time,
	                            private IAppData $appData,
	                            private IRootFolder $rootFolder,
	                            private LoggerInterface $logger) {
		parent::__construct($time);
		$this->appData = $appData;
		$this->rootFolder = $rootFolder;
		$this->logger = $logger;
		$this->logger->info('new DB update job');
	}

	 protected function run(mixed $argument) : void {
		[$path] = $argument;

		$this->dbManager = \OC::$server->query(ElisaDatabaseManager::class);

		$allAudioFiles = $this->rootFolder->searchByMime('audio');

		$this->dbManager->getDatabase()->addAudioFiles($allAudioFiles);
	 }
}
