class gems {
    package { ['ruby-devel', 'rubygems'] :
        ensure => present,
    }
    
    package { ['sass', 'less', 'compass'] :
        ensure => present,
        provider => 'gem',
        require => Package['ruby-devel'],
    }
}
