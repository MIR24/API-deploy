<?php

namespace Deployer;

desc('Import tables from mir24');
task('import:mir24', function () {
    $output = run('cd {{release_path}} &&  php artisan import:mir24:initial');
    writeln('<info>' . $output . '</info>');
    $output = run('cd {{release_path}} &&  php artisan import:mir24');
    writeln('<info>' . $output . '</info>');
});


desc('Import data for SmartTv and fix duration');
task('import:smarttv', function () {
    $output = run('cd {{release_path}} &&  php artisan import:smarttv');
    writeln('<info>' . $output . '</info>');
    $output = run('cd {{release_path}} &&  php artisan import:video');
    writeln('<info>' . $output . '</info>');
});