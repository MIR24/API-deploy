<?php
namespace Deployer;

require 'recipe/common.php';

inventory('hosts.yml');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);


// Writable dirs by web server
set('writable_dirs', []);


task('env:config',function (){
 run('cp ./.env  {{deploy_path}}/shared/.env');
});

task('composer:update',function (){
run('cd  {{deploy_path}}/release && composer update');

});

task('artisan:migration:seed',function (){
run('cd  {{deploy_path}}/release && php artisan migrate --seed');
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
    'composer:update',
    'env:config',
    'artisan:migration:seed',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

