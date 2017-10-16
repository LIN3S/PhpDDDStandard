# Php DDD Standard
> The "Php DDD Standard" distribution in the [LIN3S][1] way.

## Why?
In order to cooperate between different development teams we needed a foundation for projects based in a Domain-Driven
Design approach. This serves as an opinionated PHP project base with an already available [Symfony][2] infrastructure to 
reduce the recurring task of creating the project skeleton. Finally, this repo contains some popular CMS ready to use
that simplifies the content management. The main idea is to use the CMS as headless microservice that the main
application consumes its information via REST API.

## Getting Started
To create a new project based on this *Php DDD Standard*, you should do with composer:
```
$ composer create-project lin3s/php-ddd-standard <project-name> && cd <project-name>
```

## Documentation
All the documentation is stored in the `docs` folder.

[Show me the docs!](docs/index.md)

## Licensing Options
[![License](https://poser.pugx.org/lin3s/php-ddd-standard/license.svg)](https://github.com/LIN3S/PhpDDDStandard/blob/master/LICENSE)
 
[1]: http://www.lin3s.com/
[2]: http://symfony.com/
[3]: https://github.com/LIN3S/PhpDDDStandard/tree/admin-cms
