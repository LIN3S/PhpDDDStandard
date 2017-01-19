# Php DDD Standard
> The "Php DDD Standard" distribution in the LIN3S way.

## Why?
TODO

## Getting Started
To create a new project based on this *Php DDD Standard*, you should follow these steps.

Firstly, you need to **create the project**:
```
$ composer create-project lin3s/php-ddd-standard <project-name> && cd <project-name>
```

## Symfony as infrastructure tool
###Useful shortcuts
In order to use the built-in server, use the following scripts:
```
$ sh etc/bash/server_start.sh
$ sh etc/bash/server_stop.sh
```
By default the symfony console is in `src/App/Infrastructure/Ui/Cli/Symfony/console` but to make your life more easy
this repo provides a symlink of this file inside `etc/bin` directory so you can access to Symfony's console like this: 
```
$ etc/bin/symfony-console
```

[1]: http://symfony.com/
[2]: http://www.lin3s.com/
