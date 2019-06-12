<?php

namespace Deployer;

desc('Add config for application (clone .env and app key)');
task('smarttv_api:config', [
    'config:clone',
    'artisan:key:generate',
]);

desc('Propagate configuration file');
task('config:clone', function () {
    run('cp {{env_example_file}} {{release_path}}/.env');
});

desc('Create app key');
task('artisan:key:generate', function () {
    $output = run('cd {{release_path}} && {{bin/php}} artisan key:generate');
    writeln('<info>' . $output . '</info>');
});
