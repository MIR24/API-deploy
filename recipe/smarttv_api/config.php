<?php

namespace Deployer;

function escapeForSed($value) {
    return addcslashes($value, '/|&?!"\'');
}

desc('Add config for application (clone .env and app key)');
task('smarttv_api:config', [
    'config:clone',
    'artisan:key:generate',
    'config:inject',
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

desc('Propagate configuration file');
task('config:inject', function () {
    if(has('inject_env')){
        $customEnv = get('inject_env', []);
        foreach ($customEnv as $key => $value) {
            $escapedValue = escapeForSed($value);
            run("sed -i -E 's/^$key=.*/$key=$escapedValue/g' {{release_path}}/.env");
        }
    }
});