<?php
/** lib/ElisaDatabaseManager.php */
declare(strict_types=1);

namespace OCA\Elisa;

use OCP\Files\IAppData;
use OCP\Files\SimpleFS\ISimpleRoot;
use OCP\Files\SimpleFS\ISimpleFolder;
use OCP\Files\SimpleFS\ISimpleFile;
use OCP\ILogger;
use OCP\Files\NotFoundException;
use OCP\IConfig;

class ElisaDatabaseManager {
	private IAppData $appData;
	private IConfig $config;
	private ILogger $logger;
	private string $databaseFolder = '/database';
    
	public function __construct(IAppData $appData,
	                            IConfig $config,
	                            ILogger $logger) {
		$this->appData = $appData;
		$this->config = $config;
		$this->logger = $logger;
	}

	public function getDatabase(): ElisaDatabase {
		$appDataRootFolder = $this->appData->getFolder('/');
		if (!$appDataRootFolder->fileExists($this->databaseFolder)) {
			$appDataRootFolder->newFolder($this->databaseFolder);
		}
		$this->logger->warning($appDataRootFolder->getName());
		$dataDirPath = $this->config->getSystemValue('datadirectory');
		$instanceId = $this->config->getSystemValue('instanceid');
		$this->logger->warning($dataDirPath . '/appdata_' . $instanceId . '/elisa' . $this->databaseFolder);
		return new ElisaDatabase($this->logger, $dataDirPath . '/appdata_' . $instanceId . '/elisa' . $this->databaseFolder . '/elisaDatabase.db');
	}
}
