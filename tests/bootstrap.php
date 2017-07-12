<?php

    require_once __DIR__ . '/../vendor/autoload.php';

    use Illuminate\Config\Repository as Config;
    use Illuminate\Container\Container;
    use Illuminate\Support\Facades\Facade;
    use Illuminate\Support\Collection;

    $config = require __DIR__ . '/../config/presenter.php';

    $app = new Container();
    $collection = new Collection();
    Facade::setFacadeApplication($app);

    $app->singleton('config', function($app) use($config) {
        return new Config(['presenter' => $config]);
    });