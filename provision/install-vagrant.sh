#!/bin/bash

# update and upgrade
sudo apt-get update
sudo apt-get upgrade

# install apache2
sudo apt-get install -y apache2

# install php7.0
sudo apt-get install -y php7.0
sudo apt-get install -y libapache2-mod-php7.0

# display errors
sudo sed -i 's/display_errors = Off/display_errors = On/g' /etc/php/7.0/apache2/php.ini
sudo sed -i 's/display_startup_errors = Off/display_startup_errors = On/g' /etc/php/7.0/apache2/php.ini

# restart apache2
sudo service apache2 restart