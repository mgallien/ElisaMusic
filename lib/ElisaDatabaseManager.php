<?php
/** lib/ElisaDatabaseManager.php */
declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa;

use OCP\Files\IRootFolder;
use OCP\Files\Folder;
use OCP\Files\File;
use OCP\Accounts\IAccount;
use OCP\ILogger;
use OCP\Files\NotFoundException;

class ElisaDatabaseManager {
	private string $databaseFolder = '/database';

	public function __construct(private IRootFolder $rootFolder,
	                            private ILogger $logger) {
	}

	public function getDatabase(): ElisaDatabase {
		try {
			$appDataRootFolder = $this->rootFolder-> get('/Musique');
			$this->logger->warning($appDataRootFolder->getName());

			return new ElisaDatabase($this->logger, $appDataRootFolder . '/elisaDatabase.db');
		}
		catch (NotFoundException $ex)
		{
			return new ElisaDatabase($this->logger, '');
		}
	}
}
