<?php

namespace Deployer;

desc('Start migration for database');
task('smarttv_api:db:migrate',[
    'artisan:migrate'
]);

desc('Start migration for database');
task('artisan:migrate',function (){
    $output = run('cd {{release_path}} && {{bin/php}} artisan migrate');
    writeln('<info>' . $output . '</info>');
});

