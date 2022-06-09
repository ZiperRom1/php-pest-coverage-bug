<?php

use App\Console\App;
use App\Crawler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\ApplicationTester;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpClient\MockHttpClient;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses()->beforeAll(function () {
    // Load env file
    $dotenv = new Dotenv();

    $dotenv->usePutenv()->bootEnv(__DIR__ . '/../.env');

    // Create the Application and dependency injection services
    $container        = new ContainerBuilder;
    $configFileLoader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config'));

    $configFileLoader->load('services.yaml');
    $configFileLoader->load('services_test.yaml');

    $container->registerForAutoconfiguration(Command::class)->addTag('console.command');
    $container->compile();

    // Create testing profile
    $applicationTester = new ApplicationTester($container->get(App::class));

    // Save the application and application tester in GLOBALS
    $GLOBALS['application_tester'] = $applicationTester;
    $GLOBALS['application']        = $container->get(App::class);
})->in('Feature/Commands');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
