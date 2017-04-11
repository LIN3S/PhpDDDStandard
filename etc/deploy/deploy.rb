# This file is part of the Php DDD Standard project.
#
# Copyright (c) 2017 LIN3S <info@lin3s.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
#
# @author Beñat Espiña <benatespina@gmail.com>
# @author Gorka Laucirica <gorka.lauzirika@gmail.com>
# @author Jon Torrado <jontorrado@gmail.com>

############################################
# Setup project
############################################

set :application,   "project-name"
set :repo_url,      "git@github.com:organization/project.git"

set :infr_path, "src/App/Infrastructure"
set :symfony_path, fetch(:infr_path) + "/Symfony/Framework"

set :app_path, fetch(:symfony_path)
set :web_path, fetch(:infr_path) + "/Ui/Http/Symfony"
set :bin_path, fetch(:infr_path) + "/Ui/Cli/Symfony"

set :ui_path, fetch(:infr_path) + "/Ui"
set :assets_path, fetch(:ui_path) + "/Assets"
set :build_path, fetch(:assets_path) + "/build"

set :sessions_path, fetch(:var_path) + "/sessions"

############################################
# Setup Capistrano
############################################

set :log_level, :info
set :format_options, log_file: "var/logs/capistrano.log"
set :use_sudo, false

set :ssh_options, {
  forward_agent: true
}

set :keep_releases, 3

############################################
# Linked files and directories (symlinks)
############################################

set :linked_files,           ["parameters.yml", fetch(:web_path) + "/.htaccess", fetch(:web_path) + "/robots.txt"]
set :linked_dirs,            [fetch(:log_path), fetch(:sessions_path), fetch(:web_path) + "/uploads"]
set :file_permissions_paths, [fetch(:cache_path), fetch(:log_path), fetch(:sessions_path)]

set :composer_install_flags, '--no-interaction --optimize-autoloader'

namespace :deploy do
  before :starting, 'git:check_branch'
  after :starting, 'composer:install_executable'
  after :updated, 'compile_and_upload:webpack'
  after :updated, 'compile_and_upload:upload'
  after :updated, 'database:migrate'
  after :finishing, 'cache:clear'
end
