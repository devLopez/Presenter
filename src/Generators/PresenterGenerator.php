<?php

    namespace Masterkey\Presenter\Generators;

    use Illuminate\Filesystem\Filesystem;

    /**
     * PresenterGenerator
     *
     * Realiza a geração de um novo presenter
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotail.com>
     * @version 1.0.0
     * @since   12/07/2017
     */
    class PresenterGenerator extends Generator
    {
        /**
         * @var Filesystem
         */
        protected $files;

        /**
         * @var string
         */
        protected $presenterName;

        /**
         * @param   Filesystem  $file
         */
        public function __construct(Filesystem $file)
        {
            $this->files = $file;

            parent::__construct();
        }

        /**
         * @param   string  $presenterName
         * @return  bool
         */
        public function create($presenterName)
        {
             return $this->setPresenterName($presenterName)
                         ->createDirectory()
                         ->createClass();
        }

        /**
         * @param   string  $presenterName
         * @return  $this
         */
        public function setPresenterName($presenterName)
        {
            $this->presenterName = $presenterName;

            return $this;
        }

        /**
         * @return  string
         */
        public function getPresenterName()
        {
            $name = str_replace('Presenter', '', $this->presenterName);
            return $name . 'Presenter';
        }
    }
