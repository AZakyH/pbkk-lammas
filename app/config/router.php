<?php

$router = $di->getRouter();

// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);

$router->add(
    "/admin/hapusPC/([0-9])/:params",
    array(
        "controller" => "pc",
        "action"     => "hapus",
        "id"       => 1, // ([0-9]{4})
    )
);
