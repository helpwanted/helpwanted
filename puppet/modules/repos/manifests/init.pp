class repos(
    $useRemi = false
) {
    file { "/etc/yum.repos.d/epel.repo":
        owner  => root,
        group  => root,
        mode   => 664,
        source => "puppet:///modules/repos/epel.repo",
    }
    
    if $useRemi {
        file { "/etc/yum.repos.d/remi.repo":
            owner  => root,
            group  => root,
            mode   => 664,
            source => "puppet:///modules/repos/remi.repo",
        }
        
        $files = File["/etc/yum.repos.d/epel.repo", "/etc/yum.repos.d/remi.repo"]
    } else {
        $files = File["/etc/yum.repos.d/epel.repo"]
    }
    
    
    exec { "yum-clear-cache":
        command => 'yum clean expire-cache',
        require => $files,
    }
}
