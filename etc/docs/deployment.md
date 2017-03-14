# Deployment
This package comes with **Symfony as infrastructure tool** so, this section is about automatized deployment process with
Capistrano using Symfony as web framework.

To automatize the deployment process this project is using **Capistrano** with **capistrano-symfony** plugin. You can
find the whole configuration within the `etc/deploy` directory. Customize deploy tasks modifying the
`etc/deploy/deploy.rb` file.

You should update the *php-ddd-standard* application name for your awesome project name and the repo url with your
Git project url.

Inside `etc/deploy/stages` directory there are two files that can be considered as pre-production stage and production
stage. There is no logic, these files only contain few parameters that you should customize for your proper deployment.

After all, and following the Capistrano [documentation][1] to configure the server, you can deploy executing:
```
$ cap <stage> deploy    # <stage> can be dev1, prod or whatever file inside stages directory
```

> In the Capistrano shared directory you should create the `parameters.yml`,
> `src/App/Infrastructure/Ui/Http/Symfony/.htaccess` and `src/App/Infrastructure/Ui/Http/Symfony/robots.txt` files
> and `var/logs`, `var/sessions` and `src/App/Infrastructure/Ui/Http/Symfony/uploads` folders should be created for you.

## Clearing remote caches
When working with PHP7 & Opcache, for example, you won't see all changes after deploying. Caches need to be flushed
with the correct website domain. If you need this feature, just open the `deploy.rb` file and remove the commented line:

```
# after :finishing, 'cache:clear'
```

This is done by [Smart-Core/AcceleratorCacheBundle][2]. If you need different configurations for your deployment
stages, feel free to create a variable and add the required parameters to the `etc/deploy/stages/*.rb` files.

[1]: http://capistranorb.com/
[2]: https://github.com/Smart-Core/AcceleratorCacheBundle
