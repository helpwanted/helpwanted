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

unset($settings, $nameSpaces, $directory, $directoryIterator);
