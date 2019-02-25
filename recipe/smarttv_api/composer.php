<?php

namespace Deployer;

task('composer:update',function (){
    $output = run('cd {{release_path}} &&  composer update');
    writeln('<info>' . $output . '</info>');
});