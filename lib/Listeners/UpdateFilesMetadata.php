<?php
/** lib/Listeners/UpdateFilesMetadata.php */
declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa\Listeners;

use OCP\ILogger;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\FilesMetadata\Event\MetadataBackgroundEvent;
use OCP\FilesMetadata\Event\MetadataLiveEvent;

class UpdateFilesMetadata implements IEventListener {
	private ILogger $logger;

	public function __construct(ILogger $logger) {
		$this->logger = $logger;
	}

	public function handle(Event $event): void {
		if (!($event instanceof MetadataLiveEvent) &&
		    !($event instanceof MetadataBackgroundEvent)) {
			return;
		}

		$this->logger->info('hello world');

		$node = $event->getNode();

		// my-first-meta is light enough
		$metadata = $event->getMetadata();
		$metadata->setString('my-first-meta', 'yes');

		if ($event instanceof MetadataLiveEvent) {
			$event->requestBackgroundJob();
			return;
		}

		// my-second-meta is too heavy and should be run on a background job
		$metadata->setInt('my-second-meta', 1234, true);
	}
}
