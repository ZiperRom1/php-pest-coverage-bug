#!/usr/bin/env php
<?php

use App\Console\App;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

try {
    // Load env file
    $dotenv = new Dotenv();

    $dotenv->usePutenv()->bootEnv(__DIR__ . '/.env');

    // Create the Application and dependency injection services
    $container        = new ContainerBuilder;
    $configFileLoader = new YamlFileLoader($container, new FileLocator(__DIR__ . DIRECTORY_SEPARATOR . 'config'));

    $configFileLoader->load('services.yaml');

    $container->registerForAutoconfiguration(Command::class)->addTag('console.command');
    $container->compile();

    // Run it
    exit($container->get(App::class)->run());
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(-1);
}
