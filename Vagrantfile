# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "centos-64-x64-nrel"
    config.vm.box_url = "http://developer.nrel.gov/downloads/vagrant-boxes/CentOS-6.4-x86_64-v20131103.box"

    config.vm.provider :virtualbox do |vb|
        vb.gui = false

        # Use VBoxManage to customize the VM. For example to change memory:
        vb.customize ["modifyvm", :id, "--memory", "1024"]
        vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/vagrant-root", "1"]
    end
    
    config.vm.network :private_network, ip: "192.168.42.10"
    config.vm.network :forwarded_port, guest: 80, host: 8080

    config.vm.provision :puppet do |puppet|
        puppet.manifests_path = "puppet/manifests"
        puppet.manifest_file  = "vagrant.pp"
        puppet.module_path = "puppet/modules"
        puppet.options = ['--verbose']
    end
    
    config.vm.synced_folder ".", "/vagrant", type: "nfs"
end
