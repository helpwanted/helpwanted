<?php

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

include '../vendor/autoload.php';

$directoryIterator = new \DirectoryIterator('../module');
$nameSpaces        = [];

foreach ($directoryIterator as $directory) {
    if ($directory->isDot()) {
        continue;
    }

    $nameSpaces[$directory->getFilename()] = $directory->getPathname() . '/src/' . $directory->getFilename();
    $nameSpaces[$directory->getFilename() . 'Test'] =
        $directory->getPathname() . '/test/' . $directory->getFilename() . 'Test';
}

$nameSpaces['IntegrationTest'] = './IntegrationTest';
\Zend\Loader\AutoloaderFactory::factory([
    'Zend\Loader\StandardAutoloader' => [
        'namespaces' => $nameSpaces
    ]
]);

$config   = include '../config/autoload/settings.global.php';
$clusters   = include '../config/autoload/mongo.local.php';
$settings = array_merge(['account_clusters' =>$clusters['mongo']], $config['ads-settings']);
\Application\Utils\SettingsRegistry::setSettings($settings);

unset($settings, $nameSpaces, $directory, $directoryIterator);
