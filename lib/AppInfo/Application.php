<?php

declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\Elisa\AppInfo;

use OCA\Elisa\Hooks\ElisaFilesHooksStatic;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\Util;

class Application extends App implements IBootstrap {
	public const APP_ID = 'elisa';

	/** @psalm-suppress PossiblyUnusedMethod */
	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	public function register(IRegistrationContext $context): void {
		Util::connectHook('OC_Filesystem', 'post_create', ElisaFilesHooksStatic::class, 'fileCreate');
		Util::connectHook('OC_Filesystem', 'post_update', ElisaFilesHooksStatic::class, 'fileUpdate');
		Util::connectHook('OC_Filesystem', 'delete', ElisaFilesHooksStatic::class, 'fileDelete');
		Util::connectHook('OC_Filesystem', 'rename', ElisaFilesHooksStatic::class, 'fileMove');
		Util::connectHook('OC_Filesystem', 'post_rename', ElisaFilesHooksStatic::class, 'fileMovePost');
	}

	public function boot(IBootContext $context): void {
	}
}
