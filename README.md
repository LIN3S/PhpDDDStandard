# Symfony Standard DDD
> The "Symfony Standard DDD" distribution in the LIN3S way.

## Why?
[**Symfony**][1] is a set of reusable PHP components and a PHP framework for web projects. In [*LIN3S*][2] we implement
this solution together with Domain-Driven Design. This standard edition of Symfony serves a foundation for this 
kind of projects.

## Getting Started
To create a Symfony project based on this *Symfony Standard*, you should follow these steps.

Firstly, you need to **create the project**:
```
$ composer create-project lin3s/symfony-standard-ddd <project-name> && cd <project-name>
```

> If your `src/App/Infrastructure/Symfony/Framework/config/parameters.yml` file was not created right after finishing 
the composer process, the system will ask you some questions in order to create the needed file. Otherwise you can 
create the file by yourself.

In order to use the built-in server, use the following command:
```
$ sh etc/bash/server_start.sh
```

[1]: http://symfony.com/
[2]: http://www.lin3s.com/
