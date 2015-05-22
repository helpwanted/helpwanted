class hw_npm {
    class {'nodejs':
      manage_repo => true
    }
    
    package { ['bower', 'grunt', 'grunt-cli', 'grunt-sass']:
        ensure => present,
        provider => 'npm',
        require => Class['nodejs'],
    }
}
