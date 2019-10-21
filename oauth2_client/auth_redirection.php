<?php

$query = http_build_query(array(
    'client_id' => '1',
    'redirect_uri' => 'http://pl1-client.loc/oauth2_client/callback.php',
    'response_type' => 'code',
    'scope' => '',
));

header('Location: http://pl1.loc/oauth/authorize?'.$query);