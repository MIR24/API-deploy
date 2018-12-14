<?php
namespace Deployer;

require 'recipe/common.php';

inventory('hosts.yml');

$releaseDate = date('Y_m_d_H_i');

set('release_name', function () use ($releaseDate) {
    return $releaseDate;
});

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);


// Writable dirs by web server
set('writable_dirs', []);


task('env:config',function (){
 run('cp ./.env  {{deploy_path}}/shared/.env');
});

task('composer:install', function () {
    run('cd  {{deploy_path}}/release && composer install');
});

task('artisan:migrate', function () {
//    run('cd  {{deploy_path}}/release && php artisan migrate --seed');
    run('cd  {{deploy_path}}/release && php artisan migrate');
});

task('user:permission',function (){
    run('cd {{deploy_path}} && chown -R {{http_user}} current/');
});



// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'composer:install',
    'env:config',
    'artisan:migrate',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

