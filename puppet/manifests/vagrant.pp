Exec { path => [ "/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/" ] }

class disable_firewall {
    exec { "disable-firewall":
        command => 'service iptables save && service iptables stop && chkconfig iptables off',
    }
}

class apache_vagrant {
    package {[
    	'httpd',
    	'mod_ssl',
    	]: 
        ensure => present,
        require => Class['repos'],
    }
    
    service {'httpd':
        ensure => 'running',
        require => [Package['httpd'], Package['mod_ssl']],
    }
    
    exec { "sed -i 's/User apache/User vagrant/g' /etc/httpd/conf/httpd.conf":
        onlyif => "/bin/grep -qFx 'User apache' '/etc/httpd/conf/httpd.conf'",
        notify => Service['httpd'],
        require => Package['httpd'],
    }
 
    exec { "sed -i 's/Group apache/Group vagrant/g' /etc/httpd/conf/httpd.conf":
        onlyif => "/bin/grep -qFx 'Group apache' '/etc/httpd/conf/httpd.conf'",
        notify => Service['httpd'],
        require => Package['httpd'],
    }
 
    file {'/etc/httpd/conf.d/vhost.conf':
        owner  => root,
        group  => root,
        mode   => 664,
        source => "/vagrant/puppet/conf/httpd/vhost.conf",
        notify => Service['httpd'],
        require => Package['httpd'],
    }
}

class bootstrap-hw {
  $user = 'vagrant'
  
    exec { 'install-composer':
        cwd => '/vagrant',
        unless => '[ `stat --format=%Y composer.phar` -ge $(( `date +%s` - 864000 )) ]',
        user => $user,
        command => "/bin/sh -c '/usr/bin/curl -sS https://getcomposer.org/installer | /usr/bin/php'",
        require => [Class['php']],
    }

    exec { 'update-composer':
        command => '/usr/bin/php composer.phar install --prefer-dist',
        cwd => '/vagrant',
        user => $user,
        environment => [
            'COMPOSER_HOME=/home/vagrant',
            'COMPOSER_PROCESS_TIMEOUT=4000',
            'HOME=/home/vagrant',
        ],
        require => Exec['install-composer'],
        timeout => 0,
        tries => 10,
    }
}

class { '::hw_baseconfig':
    user => 'vagrant'
}

class { '::repos':
    useRemi => true
}

include disable_firewall
include apache_vagrant

class { '::php':
    useRemi => true,
    includeDev => true,
    forWeb => true,
}

include gems
include stdlib
include hw_npm
include elasticsearch
include bootstrap-hw
