<?php
/** lib/Hooks/ElisaFilesHooks.php */
declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa\Hooks;

use OCP\ILogger;
use OCA\Elisa\ElisaDatabaseManager;
use OCP\BackgroundJob\IJobList;
use OCA\Elisa\Jobs\ElisaDatabaseUpdateJob;

class ElisaFilesHooks {
	private ILogger $logger;
	private IJobList $jobList;

	public function __construct(IJobList $jobList,
	                            ILogger $logger) {
		$this->jobList = $jobList;
		$this->logger = $logger;
	}

	public function fileCreate($path): void {
		$this->logger->info('file create: ' . $path);
		$this->logger->info('add DB update job: ' . $path);
		$this->jobList->add(ElisaDatabaseUpdateJob::class, [$path]);
	}

	public function fileUpdate($path): void {
		$this->logger->info('file update: ' . $path);
		// $this->jobList->add(ElisaDatabaseUpdateJob::class, [$path]);
	}

	public function fileDelete($path): void {
		$this->logger->info('file delete: ' . $path);
		// $this->jobList->add(ElisaDatabaseUpdateJob::class, [$path]);
	}

	public function fileMove($oldpath, $newpath): void {
		$this->logger->info('file move: from ' . $oldpath . ' to ' . $newpath);
		// $this->jobList->add(ElisaDatabaseUpdateJob::class, [$oldpath]);
		// $this->jobList->add(ElisaDatabaseUpdateJob::class, [$newpath]);
	}

	public function fileMovePost($oldpath, $newpath): void {
		$this->logger->info('file move post: from ' . $oldpath . ' to ' . $newpath);
	}
}
