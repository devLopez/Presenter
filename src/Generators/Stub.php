<?php

    namespace Masterkey\Presenter\Generators;

    use Illuminate\Filesystem\Filesystem;

    /**
     * Stub
     *
     * Classe desenvolvida para encapsular métodosn referentes aos stubs utilizados
     * na geração de classes
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotail.com>
     * @version 1.0.0
     * @since   12/07/2017
     */
    class Stub
    {
        /**
         * @var Filesystem
         */
        protected $files;

        /**
         * @param   Filesystem  $files
         */
        public function __construct(Filesystem $files)
        {
            $this->files = $files;
        }

        /**
         * @return  string
         */
        public function getStubPath()
        {
            return __DIR__ . '/../../resources/stubs/';
        }

        /**
         * @return  string
         */
        public function getStub()
        {
            return $this->files->get($this->getStubPath() . 'presenter.stub');
        }

        /**
         * @param   array  $populate_data
         * @return  string
         */
        public function populateStub(array $populate_data)
        {
            $stub = $this->getStub();

            foreach ($populate_data as $search => $replace) {
                $stub = str_replace($search, $replace, $stub);
            }

            return $stub;
        }
    }
