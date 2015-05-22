class hw_npm {
    class {'nodejs':
      manage_repo => true
    }
    
    package { ['bower', 'grunt', 'grunt-cli']:
        ensure => present,
        provider => 'npm',
        require => Class['nodejs'],
    }
}
