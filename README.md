jpf
========

### Introduction

Just write some php util classes which are used frequently.
With them you will save a lot of your time in developing php
projects.

I use [phpbrew](https://github.com/c9s/phpbrew) to manage my php versions,
with it you can install multi-versions of php in your HOME directory.

Install phpbrew:

    $ curl -O https://raw.github.com/c9s/phpbrew/master/phpbrew

    $ chmod +x phpbrew

    $ sudo cp phpbrew /usr/bin/phpbrew

I use [composer](https://github.com/composer/composer) to manange
dependency and Composer requires PHP5.3.2+ to run.

Install composer:

    $ curl -sS https://getcomposer.org/installer | php -- --install-dir=$HOME/Bin

    $ mv $HOME/composer.phar $HOME/composer

### Guide

$ cd jpf

$ script/bootstrap

