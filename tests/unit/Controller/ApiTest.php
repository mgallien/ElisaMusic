<?php

declare(strict_types=1);

// SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace Controller;

use OCA\Elisa\AppInfo\Application;
use OCA\Elisa\Controller\ApiController;
use OCP\IRequest;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase {
	public function testIndex() {
		$request = $this->createMock(IRequest::class);
		$controller = new ApiController(Application::APP_ID, $request);

		$this->assertEquals($controller->index()->getData()['message'], 'Hello world!');
	}
}
