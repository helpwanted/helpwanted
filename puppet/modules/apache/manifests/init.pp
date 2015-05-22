class apache {
    package {'httpd24':
        ensure => present
    }
    
    package {'mod24_ssl':
    	ensure => present,
    	require => Package['httpd24'],
    }
    
    service {'httpd':
        ensure => 'running',
        require => [Package['httpd24'], Package['mod24_ssl']],
    }
    
    file {'/etc/httpd/conf.d/enablesendfile.conf':
        owner  => root,
        group  => root,
        mode   => 664,
        source => "puppet:///modules/apache/enablesendfile.conf",
        notify => Service['httpd'],
        require => Package['httpd24'],
    }
}
