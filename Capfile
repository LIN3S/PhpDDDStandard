# This file is part of the Php DDD Standard project.
#
# Copyright (c) 2017 LIN3S <info@lin3s.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
#
# @author Gorka Laucirica <gorka.lauzirika@gmail.com>
# @author Jon Torrado <jontorrado@gmail.com>
# @author Beñat Espiña <benatespina@gmail.com>

set :deploy_config_path, 'etc/deploy/deploy.rb'
set :stage_config_path, 'etc/deploy/stages/'

# Load DSL and Setup Up Stages
require 'capistrano/setup'

# Includes default deployment tasks
require 'capistrano/deploy'
require 'capistrano/scm/git'
install_plugin Capistrano::SCM::Git
require 'capistrano/symfony'

# Override the default path to bundle deployments scripts and tasks
Dir.glob('etc/deploy/tasks/*.cap').each { |r| import r }
