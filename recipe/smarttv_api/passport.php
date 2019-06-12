<?php

namespace Deployer;

desc('Install API Authentication (Passport) dependencies ');

task('api:passport',[
    'artisan:passport:install',
    'artisan:passport:init',
]);

desc('Init passport for project');
task('artisan:passport:install',function (){
    $output = run('cd {{release_path}} && {{bin/php}} artisan passport:install');
    writeln('<info>' . $output . '</info>');
});
desc('Create client for default account');
task('artisan:passport:init',function (){
    $output = run('cd {{release_path}} && {{bin/php}} artisan token:user --username={{username}} --pass={{pass}} --email={{email}}');
    writeln('<info>' . $output . '</info>');
});
