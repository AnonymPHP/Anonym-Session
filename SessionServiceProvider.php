<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Session;

use Anonym\Bootstrap\ServiceProvider;
use Anonym\Facades\Session;
use Anonym\Facades\Config;
use Anonym\Support\Arr;
use Anonym\Facades\App;
use Anonym\Facades\Stroge;

/**
 * Class SessionServiceProvider
 * @package Anonym\Components\Session
 */
class SessionServiceProvider extends ServiceProvider
{

    /**
     * register the provider
     */
    public function register()
    {


        Session::extend(
            'cookie',
            function (array $configs = []) {
                $lifetime = Arr::get($configs, 'cookie.lifetime', 1800);

                $cookie = App::make('cookie');
                return new CookieSessionHandler($configs, $lifetime);
            }
        );

        Session::extend(
            'database',
            function (array $configs = []) {
                $table = Arr::get($configs, 'database.table');

                $base = App::make('database.base');
                return new DatabaseSessionHandler($base, $table);
            }
        );

        Session::extend(
            'file',
            function (array $configs = []) {
                $filesystem = Stroge::disk('local');

                $path = Arr::get($configs, 'file.path', RESOURCE. 'sessions/');
                return new FileSessionHandler($filesystem, $path);
            }
        );

        Session::extend('cache', function(){
            $configs = Config::get('stroge.cache');
            $driver = isset($configs['driver']) ? $configs['driver'] : '';
            return new CacheSessionHandler((new \Anonym\Components\Cache\Cache())->driver($driver, $configs));
        });

    }

}
