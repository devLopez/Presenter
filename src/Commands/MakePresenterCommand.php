<?php

    namespace Masterkey\Presenter\Commands;

    use Illuminate\Console\Command;
    use Masterkey\Presenter\Generators\PresenterGenerator;

    /**
     * MakePresenterCommand
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 2.0.0
     * @since   13/07/2017
     */
    class MakePresenterCommand extends Command
    {
        /**
         * @var string
         */
        protected $signature = 'make:presenter {presenter}';

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
            $presenter = $this->argument('presenter');

            if($this->generator->create($presenter)) {
                $this->info('Presenter Class created!');
                return;
            }

            $this->error('An Error was occurred on presenter creation. Try again');
        }
    }
