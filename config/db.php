<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=db_basic_crm',
    'username' => 'seeker',
    'password' => '_h4ndl3r_',
    'charset' => 'utf8',
    'tablePrefix' => 'tbl_'

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
