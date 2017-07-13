<?php

    namespace Masterkey\Presenter\Generators;

    use Illuminate\Support\Facades\Config;
    use Illuminate\Filesystem\Filesystem;
    use Masterkey\Presenter\Exceptions\PresenterExistsException;

    /**
     * Generator
     *
     * Classe que realiza a geração dos Presenters
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotail.com>
     * @version 1.1.0
     * @since   13/07/2017
     */
    class Generator
    {
        /**
         * @var Stub
         */
        protected $stub;

        /**
         * @var Filesystem
         */
        protected $files;

        public function __construct()
        {
            $this->stub = new Stub($this->files);
        }

        /**
         * Create the Presenter file
         *
         * @return  bool
         * @throws  PresenterExistsException
         */
        protected function createClass()
        {
            $file = $this->getPath();

            if($this->files->exists($file)) {
                throw new PresenterExistsException();
            } else {
                return $this->files->put(
                    $file,
                    $this->stub->populateStub($this->getPopulatedData())
                );
            }
        }

        /**
         * Create the directory that will be used to receive the Presenters
         *
         * @return  $this
         */
        protected function createDirectory()
        {
            $dir = $this->getDirectory();

            if (!$this->files->isDirectory($dir)) {
                $this->files->makeDirectory($dir, 0755, true);
            }

            return $this;
        }

        /**
         * @return  string
         */
        protected function getDirectory()
        {
            return Config::get('presenter.presenter_path');
        }

        /**
         * @return  string
         */
        protected function getPath()
        {
            return $this->getDirectory() . DIRECTORY_SEPARATOR . $this->getPresenterName() . '.php';
        }

        /**
         * @return  array
         */
        protected function getPopulatedData()
        {
            return [
                'presenter_namespace' => Config::get('presenter.presenter_namespace'),
                'presenter_class' => $this->getPresenterName()
            ];
        }
    }
