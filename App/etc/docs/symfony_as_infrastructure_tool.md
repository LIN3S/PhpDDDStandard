# Symfony as infrastructure tool
## Useful shortcuts
In order to use the built-in server, use the following scripts:
```
$ sh etc/bash/server_start.sh
$ sh etc/bash/server_stop.sh
```
In order to delete current db and load an empty one with its migrations using Doctrine:
```bash
$ sh etc/bash/drop_and_reload_db.sh
```

By default the symfony console is in `src/App/Infrastructure/Ui/Cli/Symfony/console` but to make your life more easy
this repo provides a symlink of this file inside `etc/bin` directory so you can access to Symfony's console like this: 
```
$ etc/bin/symfony-console
```
