<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */


/**
 * Default Configuration
 */
$mysql = [
    'host' => env('RDS_ENDPOINT', '127.0.0.1'),
    'port' => env('RDS_PORT', '3306'),
    'database' => env('DB_DATABASE', 'tribecarexercise'),
    'username' => env('RDS_USERNAME', ''),
    'password' => env('RDS_PASSWORD', ''),
];

/**
 * Lando Configuration
 */
if (isset($_ENV['LANDO']) && $_ENV['LANDO'] == "ON") {
    // If project is running within Lando
    if (!defined("LANDO_INFO")) {
        define('LANDO_INFO', json_decode($_ENV['LANDO_INFO'], TRUE));
    }
    // /*DEBUG*/ echo "<pre>" . print_r(LANDO_INFO, true) . "</pre>";exit;

    $mysql["host"] = LANDO_INFO["database"]["internal_connection"]["host"];
    $mysql["port"] = LANDO_INFO["database"]["internal_connection"]["port"];
    $mysql["database"] = LANDO_INFO["database"]["creds"]["database"];
    $mysql["username"] = LANDO_INFO["database"]["creds"]["user"];
    $mysql["password"] = LANDO_INFO["database"]["creds"]["password"];
}

return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', 'bf6f7f6a049bb23fcef083937c1ad14ca03b7321fcc7efbba2d5a55ec228def0'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => $mysql["host"],
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            'port' => $mysql["port"],

            'username' => $mysql["username"],
            'password' => $mysql["password"],

            'database' => $mysql["database"],
            /*
             * If not using the default 'public' schema with the PostgreSQL driver
             * set it here.
             */
            //'schema' => 'myapp',

            /*
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tests.sqlite'),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
];
