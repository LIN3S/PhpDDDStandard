# Domain-Driven Design
This projects follows the architecture proposed by [Domain-Driven Design][1]. Make sure you understand the basic 
concepts before you start meshing around with this projects.

## Infrastructure
Folder naming conventions used in [LIN3S][2] for infrastructure folders.
 
Symfony:
* `Symfony\Framework`: Contains code required by the framework to work. Is the code usually found at the `app` folder in
 [SymfonyStandard][4].
* `Symfony\HttpAction`: Contains controller actions based in Symfony's Http components. 

Persistence:
* `Persistence\Doctrine`: Contains DBAL, ORM and Migrations implementations required to persist the domain layer.

Ui:
* `UI\Assets`: Will contain assets required in the frontend (css, js, svg...)
* `UI\Cli`: Contains scripts that can be run in the command line.
* `Ui\Http`: Contains frontend controllers that will be set as a document root in the web server (apache, nginx...)
* `UI\Templates`: Contains template engine implementations

> In case other infrastructure implementations are required place them in the Ui (if they are user interaction related),
Persistence (if they manage and store data) or under vendor name (f.e Laravel) in case it does not meet the two other 
descriptions.

[1]: https://en.wikipedia.org/wiki/Domain-driven_design
[2]: http.//lin3s.com
