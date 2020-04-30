<?php

$router = $di->getRouter();

// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);

$router->add(
    "/admin/updatePC/([0-9])/:params",
    array(
        "controller" => "pc",
        "action"     => "update",
        "id"       => 1, // ([0-9]
    )
);

$router->add(
    "/admin/editPC/([0-9])/:params",
    array(
        "controller" => "admin",
        "action"     => "editpc",
        "id"       => 1, // ([0-9]
    )
);

$router->add(
    "/admin/hapusPC/([0-9])/:params",
    array(
        "controller" => "pc",
        "action"     => "hapus",
        "id"       => 1, // ([0-9]
    )
);

$router->add(
    "/admin/confirmReservasiPC/([0-9])/:params",
    array(
        "controller" => "PermohonanPc",
        "action"     => "confirm",
        "id"       => 1, // ([0-9]
    )
);

$router->add(
    "/admin/jadwalPemakaianRuangan/([0-9])/:params",
    array(
        "controller" => "PermohonanRuangan",
        "action"     => "listpr",
        "id"       => 1, // ([0-9]
    )
);

$router->add(
    "/mahasiswa/reservepc",
    array(
        "controller" => "PermohonanPc",
        "action"     => "reserve",
    )
);
