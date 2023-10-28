<?php

define ('HOST', $_ENV['MYSQL_HOST']);
define ('PORT', $_ENV['MYSQL_PORT']);
define ('USER', $_ENV['MYSQL_WBD_USER']);
define ('DB_NAME', $_ENV['MYSQL_DATABASE']);
define ('PASSWORD', $_ENV['MYSQL_ROOT_PASSWORD']);
define ('STORAGE_URL', '/media');

define ('LIMIT_PAGE', 10);

// 2xx
define ('STATUS_OK', 200);
define ('STATUS_CREATED', 201);
define ('STATUS_ACCEPTED', 202);

// 4xx
define ('STATUS_UNAUTHORIZED', 401);
define ('STATUS_NOT_FOUND', 404);
define ('STATUS_METHOD_NOT_ALLOWED', 405);

// 5xx
define ('STATUS_INTERNAL_SERVER_ERROR', 500);
define ('STATUS_NOT_IMPLEMENTED', 501);
define ('STATUS_BAD_GATEWAY', 502);