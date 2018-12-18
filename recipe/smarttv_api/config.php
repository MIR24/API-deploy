<?php

namespace Deployer;

task('smarttv_api:config', [
    'config:clone',
    'artisan:key:generate',
]);


desc('Propagate configuration file');
task('config:clone', function () {
    run('cp {{env_example_file}} {{release_path}}/.env');
});

task('artisan:key:generate', function () {
    $output = run('cd {{release_path}} && {{bin/php}} artisan key:generate');
    writeln('<info>' . $output . '</info>');
});
