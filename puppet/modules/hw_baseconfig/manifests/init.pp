class hw_baseconfig (
    $user = 'ec2-user'
) {
    $system_packages = ['curl', 'git', 'procps', 'yum', 'rpm', 'ca-certificates']
    
    exec { 'yum-reset-cache':
        command => 'yum clean expire-cache',
    }
    
    package { $system_packages:
    	ensure => latest,
    	require => Exec['yum-reset-cache'],
    }
    
    file { "/opt/data":
        ensure => directory
    }
    
    file { "/opt/hw":
        ensure => directory,
        mode => 775,
    }

    file { "/opt/hw/www":
        ensure => directory,
        mode => 775,
        owner => $user,
        group => $user,
        require => [File['/opt/hw']],
    }

    file { "/opt/hw/www/releases":
        ensure => directory,
        mode => 775,
        owner => $user,
        group => $user,
        require => [File['/opt/hw/www']],
    }

    file { "/opt/hw/data":
        ensure => directory,
        mode => 775,
        require => [File['/opt/hw']],
    }
}
