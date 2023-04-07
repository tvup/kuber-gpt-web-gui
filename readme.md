<p align="center">
<img src="https://laravel.com/assets/img/components/logo-laravel.svg">
<img src="https://docs.openvpn.net/wp-content/uploads/ovpntech_logo-s.png">

</p>

## OpenVPN web gui manager - Laravel

OpenVPN user certificate web manager.

Goal: create quick and easy to use solution to manage users and certificate and their password for openvpn already working system

## Prerequisite

* GNU/Linux with Bash and root access
* Fresh install of OpenVPN
* Web server (NGinx, Apache...)
* MySQL
* PHP >= 7.1
* Laravel

### CentOS 7
````
# yum install epel-release
# yum install openvpn httpd nodejs unzip git wget sed npm
# rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

# yum remove php-common-5.4.16-45.el7.x86_64
#  yum remove php*
# yum remove php
# yum install mod_php71w php71w-opcache
# yum install yum-plugin-replace
# yum replace php-common --replace-with=php71w-common
# yum install php71w-gdphp71w-ldap  php71w-mbstring php71w-mcrypt php71w-pear php71w-pecl-imagickphp71w-pecl-memcachedphp71w-pecl-mongodbphp71w-pecl-redis php71w-soapphp71w-tidyphp71w-xml php71w-xmlrpc
# yum install yum install php71w-mysqlnd.x86_64 php71w-pdo.x86_64 php71w-pecl-imagick.x86_64 php71w-pecl-redis.x86_64 php71w-soap.x86_64 php71w-ldap.x86_64

# yum remove mariadb-5.5.60-1.el7_5.x86_64 mariadb-libs-5.5.60-1.el7_5.x86_64 mariadb-server-5.5.60-1.el7_5.x86_64
  
# vi /etc/yum.repos.d/mariadb.repo

# MariaDB 10.2 CentOS repository
# http://downloads.mariadb.org/mariadb/repositories/
[mariadb]
name = MariaDB
baseurl = http://yum.mariadb.org/10.2/centos7-amd64
gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB
gpgcheck=1


# yum clean all
# yum makecache fast

# yum -y install MariaDB-server MariaDB-client


# npm install -g bower
# systemctl enable mariadb
# systemctl start mariadb
````


## Installation

* Setup openvpn server with your parameter and preferences or use your already working openvpn server
* go to /etc/openvpn/easy-rsa/pki: cd /etc/openvpn/easy-rsa/pki
* git clone https://github.com/MaoX17/openvpn-web-gui.git
* cd openvpn-web-gui
* chmod ugo+x addon/*
* cp addon/* ../
* mysql
* CREATE DATABASE openvpn DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
* GRANT ALL ON openvpn.* TO 'openvpn'@'localhost'  IDENTIFIED BY 'your_pass' WITH GRANT OPTION;
* set your .env file
* edit .env  (vi .env) :
* INDEX_PATH="/etc/openvpn/easy-rsa/pki/private/"
* INDEX_FULL_PATH="/etc/openvpn/easy-rsa/pki/private/index.txt"
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=openvpn
* DB_USERNAME=openvpn
* DB_PASSWORD=your_pass
* 
* php artisan migrate
* php artisan command:CreateFirstAdminUser
* user: admin@admin.admin
* visudo
* paste in visudo:
* apache ALL = (ALL) NOPASSWD: /etc/openvpn/easy-rsa/pki/script-revoke-web.sh, /etc/openvpn/easy-rsa/pki/revoke-full, /etc/openvpn/easy-rsa/pki/pkitool, /usr/bin/mailx, /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web.sh, /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web_FULLTCP.sh, /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web_TS.sh
* make sure your openvpn's "index.txt" path is set correctly in .env
* 

## Issue






## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p><a href="https://www.buymeacoffee.com/MaoX17"> <img align="left" src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" height="50" width="210" alt="MaoX17" /></a></p><br><br>
