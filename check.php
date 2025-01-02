<?php

$required_php_version = '8.2.0';
$required_extensions = [
    'bcmath',
    'ctype',
    'curl',
    'dom',
    'fileinfo',
    'filter',
    'hash',
    'mbstring',
    'openssl',
    'pcre',
    'pdo',
    'session',
    'tokenizer',
    'xml',
    'json'
];

$missing_extensions = [];

// ANSI color codes
$green = "\033[32m";
$red = "\033[31m";
$reset = "\033[0m";

// Get full path to PHP binary and php.ini file
$php_binary = PHP_BINARY;
$php_ini = php_ini_loaded_file();

echo "PHP binary path: $php_binary\n";
echo "php.ini path: $php_ini\n";

// Check PHP version
$current_php_version = phpversion();
$php_version_status = version_compare($current_php_version, $required_php_version, '>=');
if ($php_version_status) {
    echo "{$green}OK{$reset} - PHP version is $current_php_version\n";
} else {
    echo "{$red}FAIL{$reset} - PHP version is $current_php_version (Required: $required_php_version or higher)\n";
}

// Check PHP extensions
foreach ($required_extensions as $extension) {
    if (!extension_loaded($extension)) {
        $missing_extensions[] = $extension;
    }
}

if (empty($missing_extensions)) {
    echo "{$green}OK{$reset} - All required PHP extensions are installed\n";
} else {
    echo "{$red}FAIL{$reset} - The following required PHP extensions are missing:\n";
    foreach ($missing_extensions as $missing) {
        echo "- $missing\n";
    }
}

// Check database connections
$db_connections = [
    'PostgreSQL' => function() {
        return extension_loaded('pdo_pgsql');
    },
    'MySQL' => function() {
        return extension_loaded('pdo_mysql');
    },
    'SQLite' => function() {
        return extension_loaded('pdo_sqlite');
    },
];

foreach ($db_connections as $db_name => $check) {
    if ($check()) {
        echo "{$green}OK{$reset} - Connection to $db_name is available\n";
    } else {
        echo "{$red}FAIL{$reset} - Connection to $db_name is not available\n";
    }
}
