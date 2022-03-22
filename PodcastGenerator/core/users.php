<?php

############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella and Emil Engler
# http://www.podcastgenerator.net
#
# This is Free Software released under the GNU/GPL License.
############################################################

function addUser($username, $password_plain)
{
    global $config;
    $users =  json_decode($config['users_json'], true);
    // Check if user exists
    if (array_key_exists($username, $users)) {
        return false;
    }
    $users[$username] = password_hash($password_plain, PASSWORD_DEFAULT);
    return updateConfig(
        $config['absoluteurl'] . 'config.php',
        'users_json',
        str_replace('"', '\"', json_encode($users))
    );
}

function deleteUser($username)
{
    global $config;
    $users =  json_decode($config['users_json'], true);
    unset($users[$username]);
    return updateConfig(
        $config['absoluteurl'] . 'config.php',
        'users_json',
        str_replace('"', '\"', json_encode($users))
    );
}

function changeUserPassword($username, $new_password_plain)
{
    global $config;
    $users = json_decode($config['users_json'], true);
    // Check if user exists
    if (!array_key_exists($username, $users)) {
        return false;
    }
    $users[$username] = password_hash($new_password_plain, PASSWORD_DEFAULT);
    return updateConfig(
        $config['absoluteurl'] . 'config.php',
        'users_json',
        str_replace('"', '\"', json_encode($users))
    );
}

function getUsers()
{
    global $config;
    return json_decode($config['users_json'], true);
}
