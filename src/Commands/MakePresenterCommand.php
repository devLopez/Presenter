<?php

    namespace Masterkey\Presenter\Commands;

    use Illuminate\Console\Command;
    use Masterkey\Presenter\Generators\PresenterGenerator;
    use Symfony\Component\Console\Input\InputArgument;

    /**
     * MakePresenterCommand
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.1
     * @since   13/07/2017
     */
    class MakePresenterCommand extends Command
    {
        /**
         * @var string
         */
        protected $name = 'make:presenter';

        /**
         * @var string
         */
        protected $description = 'Create a new Presenter';

        /**
         * @var PresenterGenerator
         */
        protected $generator;

        /**
         * @param   PresenterGenerator  $generator
         */
        public function __construct(PresenterGenerator $generator)
        {
            parent::__construct();

            $this->generator = $generator;
        }

        /**
         * @return  void
         */
        public function handle()
        {
            $arguments = $this->arguments();

            $this->writePresenter($arguments);
        }

        /**
         * Generates a new Presenter Class with given name
         *
         * @param   string  $name
         * @return  void
         */
        public function writePresenter($arguments)
        {
            $name = $arguments['presenter'];

            if($this->generator->create($name)) {
                $this->info('Presenter Class Was Created');
            }

            $this->error('An Error was occurred on presenter creation. Try again');
        }

        /**
         * Return the args inputed on console
         *
         * @return  array
         */
        public function arguments()
        {
            return [
                ['presenter', InputArgument::REQUIRED, 'The presenter name']
            ];
        }
    }
