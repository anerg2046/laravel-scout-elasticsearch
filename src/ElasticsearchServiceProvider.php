<?php

namespace anerg2046\LaravelScoutElasticsearch;

use anerg2046\LaravelScoutElasticsearch\Console\FlushCommand;
use anerg2046\LaravelScoutElasticsearch\Console\ImportCommand;
use anerg2046\LaravelScoutElasticsearch\Engine\ElasticsearchEngine;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;

class ElasticsearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // 注册命令
        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportCommand::class,
                FlushCommand::class,
            ]);
        }

        app(EngineManager::class)->extend('elasticsearch', function ($app) {
            return new ElasticsearchEngine();
        });
    }

    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/laravel-scout-elasticsearch.php', 'scout'
        );
    }
}
