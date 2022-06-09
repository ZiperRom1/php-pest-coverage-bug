<?php

use App\Console\App;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Store the add account command
 */
beforeEach(function () {
    /** @var App $app */
    $app = $GLOBALS['application'];

    $this->testCommand = new CommandTester($app->find('test'));
});

test('Test command is successful', function () {
    // Populate the list
    $this->testCommand->execute([]);
    $this->testCommand->assertCommandIsSuccessful();
});

test('Test command correctly output `test`', function () {
    $this->testCommand->execute([]);

    expect($this->testCommand->getDisplay(true))->toBe("\n test\n");
});
