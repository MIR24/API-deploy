<?php

namespace Deployer;

require 'recipe/laravel.php';

desc('Deploy specific Laravel');
task('smarttv_api:laravel', [
    'artisan:storage:link',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
// TODO? 'artisan:migrate',
//    'symlink:uploaded',
]);

//desc('Creating symlink to uploaded folder at backend server');
//task('symlink:uploaded', function () {
//    // Will use simple≤ two steps switch.
//    run("cd {{release_path}} && {{bin/symlink}} {{uploaded_path}} public/uploaded"); // Atomic override symlink.
//});
