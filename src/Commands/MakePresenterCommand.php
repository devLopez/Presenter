<?php

    namespace Masterkey\Presenter\Commands;

    use Illuminate\Console\Command;
    use Masterkey\Presenter\Generators\PresenterGenerator;
    use Symfony\Component\Console\Input\InputArgument;

    class MakePresenterCommand extends Command
    {
        protected $name = 'make:presenter';

        protected $description = 'Creates a new Presenter';

        protected $generator;

        public function __construct(PresenterGenerator $generator)
        {
            $this->generator = $generator;
        }

        public function handle()
        {
            $arguments = $this->arguments();

            $this->writePresenter($arguments);
        }

        public function writePresenter($name)
        {
            if($this->generator->create($name)) {
                $this->info('Presenter Class Was Created');
            }

            $this->error('An Error was occurred on presenter creation. Try again');
        }

        public function arguments()
        {
            return [
                ['repository', InputArgument::REQUIRED, 'The presenter name']
            ];
        }


    }