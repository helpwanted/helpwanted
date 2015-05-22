class elasticsearch {
    package { [
            'java-1.7.0-openjdk',
        ]:
        ensure => present
    }
    
    user { 'elasticsearch':
        ensure => present,
        system => true,
    }
    
    exec { 'install-elasticsearch':
      creates => '/opt/elasticsearch-1.5.2',
      cwd => '/opt',
      command => "/bin/sh -c '/usr/bin/curl https://download.elasticsearch.org/elasticsearch/elasticsearch/elasticsearch-1.5.2.tar.gz | /bin/tar xvz'",
      require => [Package['curl']],
    }
    
    file { "/opt/elasticsearch":
        ensure => link,
        target => '/opt/elasticsearch-1.5.2',
        require => [Exec['install-elasticsearch']],
    }
    
    file { "/opt/data/elasticsearch":
        ensure => directory,
        owner => 'elasticsearch',
        require => [File['/opt/data'], User['elasticsearch']],
    }
    
    file { "/opt/data/elasticsearch/logs":
        ensure => directory,
        owner => 'elasticsearch',
        require => [File['/opt/data/elasticsearch'], User['elasticsearch']],
    }
    
    file { "/opt/elasticsearch/config/elasticsearch.yml":
        require => [Exec['install-elasticsearch']],
        ensure => present,
        source => 'puppet:///modules/elasticsearch/elasticsearch.yml'
    }
    
    exec { 'start-elasticsearch':
      unless => 'pgrep -u `id elasticsearch -u`',
      command => '/opt/elasticsearch/bin/elasticsearch -d',
      require => [Package['procps'], Exec['install-elasticsearch'], Package['java-1.7.0-openjdk'], File['/opt/data/elasticsearch/logs'], File['/opt/elasticsearch/config/elasticsearch.yml']],
      user => 'elasticsearch',
    }
}

