<?php

    namespace Masterkey\Presenter\Providers;

    use Illuminate\Filesystem\Filesystem;
    use Illuminate\Support\ServiceProvider;
    use Masterkey\Presenter\Commands\MakePresenterCommand;
    use Masterkey\Presenter\Generators\PresenterGenerator;

    class PresenterServiceProvider extends ServiceProvider
    {
        protected $defer = true;

        public function boot()
        {
            $config_path = $this->getConfigPath();

            $this->publishes([
                $config_path => config_path('presenter.php')
            ], 'presenters');
        }

        public function register()
        {
            $this->registerMakePresenterCommand();

            $this->commands([
                MakePresenterCommand::class
            ]);

            $this->mergeConfigFrom($this->getConfigPath(), 'presenters');
        }

        protected function getConfigPath()
        {
            return __DIR__ . '/../../config/presenter.php';
        }

        protected function registerMakePresenterCommand()
        {
            $this->app['command.presenter.make'] = $this->app->singleton(MakePresenterCommand::class, function($app){
                $fs = new Filesystem;
                $generator = new PresenterGenerator($fs);

                return new MakePresenterCommand($generator);
            });
        }

        public function provides()
        {
            return [
                'command.presenter.make'
            ];
        }
    }
