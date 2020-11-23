<?php

require 'google-login.php';

$googleClient->revokeToken();

session_destroy();

header("Location: http://php-docker.com:9070");