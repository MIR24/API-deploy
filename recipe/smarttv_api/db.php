<?php

namespace Deployer;

task('smarttv_api:db', [
    'db:create',
    'db:pipe',
    'db:init',
    'db:clone',
// TODO? 'artisan:migrate',
]);

//desc('Executing initial dump may took a minute');
//task('db:init', function () {
//    writeln('<info>Check if {{dump_file}} exists</info>');
//
//    if (test('[ ! -r {{dump_file}} ]')) {
//        writeln('<comment>No dump file found, proceed</comment>');
//
//        return;
//    }
//    writeln('<info>SQL dump execution, please wait..</info>');
//    run('cd {{deploy_path}} && mysql -h{{dbhost}} -u{{dbuser}} -p{{dbpass}} mir24_7 < {{dump_file}}');
//})->onStage('test');
////})->onHosts('test-frontend')->onStage('test');
//
//
//desc('Cloning database repository');
//task('db:clone', function () {
//    run('cd {{release_path}} && git clone git@github.com:MIR24/database.git');
//})->onHosts(
//    'test-frontend',
//    'prod-frontend',
//    'test-backend',
//    'prod-backend');
//
//desc('Create new database to proceed release');
//task('db:create', function () {
//    writeln('<info>Trying to create database ' . get('db_name_releasing') . '</info>');
//    run('mysql -h{{dbhost}} -u{{dbuser}} -p{{dbpass}} -e "CREATE DATABASE ' . get('db_name_releasing') . '"');
//})->onHosts('prod-frontend');
//
//
//desc('Inflate database with data from current released version');
//task('db:pipe', function () {
//    $releaseList = get('releases_list');
//    $prevReleaseName = array_shift($releaseList);
//    if ($prevReleaseName) {
//        writeln('<info>Trying to inflate database ' . get('db_name_releasing') . ' with release data from mir24_dep_' . $prevReleaseName . '</info>');
//        run('mysqldump --single-transaction --insert-ignore -u{{dbuser}} -p{{dbpass}} mir24_dep_' . $prevReleaseName .
//            ' | mysql  -u{{dbuser}} -p{{dbpass}} -h{{dbhost}} ' . get('db_name_releasing'));
//    } else {
//        writeln('<error>No previous release found, can`t inflate database, stop.</error>');
//        die;
//    }
//})->onHosts('prod-frontend');
