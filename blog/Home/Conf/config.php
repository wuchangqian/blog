<?php
return array(
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        '/^category\/([-a-zA-Z0-9_.]+)$/' => 'Home/Post/category?url=:1',
        '/^tag\/([-a-zA-Z0-9_.]+)$/' => 'Home/Post/tag?url=:1',
        '/^post\/([-a-zA-Z0-9_.]+)$/' => 'Home/Post/view?url=:1',
    ),
    'DEFAULT_THEME'    =>    'tmp2',

);