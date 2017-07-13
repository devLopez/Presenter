<?php

    namespace Masterkey\Presenter\Providers;

    use Illuminate\Filesystem\Filesystem;
    use Illuminate\Support\ServiceProvider;
    use Masterkey\Presenter\Commands\MakePresenterCommand;
    use Masterkey\Presenter\Generators\PresenterGenerator;

    /**
     * PresenterServiceProvider
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.1.0
     * @since   13/07/2017
     * @package Masterkey\Presenter\Providers
     */
    class PresenterServiceProvider extends ServiceProvider
    {
        /**
         * @var bool
         */
        protected $defer = true;

        /**
         * @return void
         */
        public function boot()
        {
            $config_path = $this->getConfigPath();

            $this->publishes([
                $config_path => config_path('presenter.php')
            ], 'presenters');
        }

        /**
         * @return void
         */
        public function register()
        {
            $this->registerMakePresenterCommand();

            $this->commands([
                MakePresenterCommand::class
            ]);

            $this->mergeConfigFrom($this->getConfigPath(), 'presenters');
        }

        /**
         * @return string
         */
        protected function getConfigPath()
        {
            return __DIR__ . '/../../config/presenter.php';
        }

        /**
         * @return void
         */
        protected function registerMakePresenterCommand()
        {
            $this->app->singleton(MakePresenterCommand::class, function(){
                $fs = new Filesystem;
                $generator = new PresenterGenerator($fs);

                return new MakePresenterCommand($generator);
            });
        }

        /**
         * @return array
         */
        public function provides()
        {
            return [
                MakePresenterCommand::class
            ];
        }
    }
