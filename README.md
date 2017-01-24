# Php DDD Standard
> The "Php DDD Standard" distribution in the [LIN3S][2] way.

## Why?
In order to cooperate between different development teams we needed a foundation for projects based in a Domain-Driven
Design approach. This serves as an opinionated PHP project base with an already available [Symfony][1] infrastructure to 
reduce the recurring task of creating the project skeleton.

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

## Domain-Driven Design
This projects follows the architecture proposed by [Domain-Driven Design][3]. Make sure you understand the basic 
concepts before you start meshing around with this projects.

### Infrastructure

Folder naming conventions used in [LIN3S][2] for infrastructure folders.
 
Symfony:
* `Symfony\Framework`: Contains code required by the framework to work. Is the code usually found at the `app` folder in
 [SymfonyStandard][4].
* `Symfony\HttpAction`: Contains controller actions based in Symfony's Http components. 

Persistence:
* `Persistence\Doctrine`: Contains DBAL and ORM implementations required to persist the domain layer.

Ui:
* `UI\Assets`: Will contain assets required in the frontend (css, js, svg...)
* `UI\Cli`: Contains scripts that can be run in the command line.
* `Ui\Http`: Contains frontend controllers that will be set as a document root in the web server (apache, nginx...)
* `UI\Templates`: Contains template engine implementations

> In case other infrastructure implementations are required place them in the Ui (if they are user interaction related),
Persistence (if they manage and store data) or under vendor name (f.e Laravel) in case it does not meet the two other 
descriptions.

## Bonus
Also `admin-cms` branch is available implementing bridges with the LIN3SAdminBundle and CMSKernel projects we use for 
our developments in [LIN3S][2].
 
[1]: http://symfony.com/
[2]: http://www.lin3s.com/
[3]: https://en.wikipedia.org/wiki/Domain-driven_design
[4]: https://github.com/symfony/symfony-standard
