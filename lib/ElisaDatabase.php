<?php
/** lib/ElisaDatabase.php */
declare(strict_types=1);

namespace OCA\Elisa;

use SQLite3;
use OCP\ILogger;

class ElisaDatabase extends SQLite3
{
	private ILogger $logger;

	function __construct(ILogger $logger,
                         string $dbName)
	{
		parent::__construct($dbName);
		$this->logger = $logger;
	}

	public function addMusicFile($path): void {
		$this->logger->info('add ' . $path . 'to db file');
	}

	public function removeMusicFile($path): void {
		$this->logger->info('remove ' . $path . 'from db file');
	}

	public function updateMusicFile($path): void {
		$this->logger->info('update ' . $path . 'in db file');
	}
}
