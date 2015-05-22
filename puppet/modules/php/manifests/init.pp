class php (
    $useRemi = false,
    $includeDev = false,
    $forWeb = false,
    
    $configPath = '/etc/php-5.6.d/hw.ini',
    
    $packages = [
        'php56',
        'php56-cli',
        'php56-devel',
        'php56-mbstring',
        'php56-mcrypt',
        'php56-intl',
        'php56-process',
        'php-pear',
        'php56-opcache',
    ],
    
    $devPackages = [
        'php56-pecl-xdebug',
        'phpunit',
    ],
    
    $remiConfigPath = '/etc/php.d/hw.ini',
    
    $remiPackages = [
        'php',
        'php-cli',
        'php-devel',
        'php-mbstring',
        'php-mcrypt',
        'php-intl',
        'php-process',
        'php-pear',
        'php-opcache',
    ],
    
    $remiDevPackages = [
        'php-pecl-xdebug',
        #'phpunit', //We should have phpunit, but there's no package for it available
    ]
) {
    if $useRemi {
        $usePackages = $remiPackages
        $useDevPackages = $remiDevPackages
        $useConfigPath = $remiConfigPath
    } else {
        $usePackages = $packages
        $useDevPackages = $devPackages
        $useConfigPath = $configPath
    }
    
    package { $usePackages:
        ensure => present,
        require => Class['repos'],
    }
    
    if $includeDev {
        package { $useDevPackages:
            ensure => present,
        }
    }
    
    if $forWeb {
        $notify = Service['httpd']
    } else {
        $notify = []
    }
    
    file {$useConfigPath:
        owner  => root,
        group  => root,
        mode   => 664,
        source => "puppet:///modules/php/hw.ini",
        notify => $notify,
    }
}
