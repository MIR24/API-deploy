<?php

namespace Deployer;

desc('Install basic vendors for onair');
task('onair:vendor', function () {
    run('cd {{release_path}} &&  curl -s https://octobercms.com/api/installer | php');
});

desc('Update database');
task('onair:db', function () {
    if (has('dump')) {
        run("cd {{release_path}} && mysql -u{{dbuser}} -p'{{dbpass}}' -h{{dbhost}} {{dbname}} < {{release_path}}/{{dump}}");
    }
});

desc('Torn on theme onair');
task('onair:theme', function () {
    run('cd {{release_path}} && {{bin/php}} artisan theme:use onair');
});

desc('Propagate configuration onair file');
task('config:clone', function () {
    run('cp {{config_path}} {{release_path}}/config/database.php');
});

desc('Create mirror');
task('onair:mirror', function () {
    if (has('public')) {
        run('cd {{release_path}} && {{bin/php}} artisan october:mirror public/');
    }
});

desc('Add simlinks ');
task('onair:images', function () {
    if (has('public')) {
        run('cd {{release_path}}/public && ln -s {{images_path}} images');
    } else {
        run('cd {{release_path}} && ln -s {{images_path}} images');
    }
});