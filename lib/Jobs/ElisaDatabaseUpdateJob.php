<?php
/** lib/Jobs/ElisaDatabaseUpdateJob.php */
declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa\Jobs;

use \OCP\BackgroundJob\QueuedJob;

class ElisaDatabaseUpdateJob extends QueuedJob {
	private ILogger $logger;
	private IAppData $appData;
	private string $databaseFolder = '/database';

	public function __construct(IAppData $appData,
	                            ILogger $logger) {
		parent::__construct();
		$this->appData = $appData;
		$this->logger = $logger;
	}
}
