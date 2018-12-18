<?php

namespace Deployer;

require 'recipe/common.php';
require 'recipe/smarttv_api/config.php';
require 'recipe/smarttv_api/db.php';
require 'recipe/smarttv_api/laravel.php';

inventory('hosts.yml');

$releaseDate = date('Y_m_d_H_i_s');

set('release_name', function () use ($releaseDate) {
    return $releaseDate;
});

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);


// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'smarttv_api:config',
//    'smarttv_api:laravel',
// TODO    'smarttv_api:db',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
