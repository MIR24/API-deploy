<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/common.php';
require 'recipe/smarttv_api/config.php';
require 'recipe/smarttv_api/passport.php';
require 'recipe/smarttv_api/import.php';
require 'recipe/onair/common.php';

inventory('hosts.yml');

$releaseDate = date('Y_m_d_H_i_s');

set('release_name', function () use ($releaseDate) {
    return $releaseDate;
});

set('use_relative_symlinks', false);
set('ssh_multiplexing', false);

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);


// Tasks
desc('Deploy api project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'smarttv_api:config',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:migrate',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'php-fpm:restart',
    'success',
]);

desc('Deploy onair project');
task('deploy_onair', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'onair:vendor',
    'onair:db',
    'config:clone',
    'onair:theme',
    'onair:mirror',
    'onair:images',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
//   'php-fpm:restart',
    'success',
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// The user must have rights for restart service
// /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
desc('Restart PHP-FPM service if set php_version');
task('php-fpm:restart', function () {
    if(has('php_version')){
        run('sudo systemctl restart php{{php_version}}-fpm.service');
    }
});
