<?php

    namespace Masterkey\Presenter\Generators;

    use Illuminate\Filesystem\Filesystem;
    use Illuminate\Support\Facades\Config;

    class PresenterGenerator
    {
        protected $files;

        protected $presenterName;

        public function __construct(Filesystem $file)
        {
            $this->files = $file;
        }

        public function create($presenterName)
        {
             return $this->setPresenterName($presenterName)
                         ->createDirectory()
                         ->createClass();
        }

        public function setPresenterName($presenterName)
        {
            $this->presenterName = $presenterName;

            return $this;
        }

        public function getPresenterName()
        {
            $name = str_replace('Presenter', '', $this->presenterName);
            return $name . 'Presenter';
        }

        public function createDirectory()
        {
            $dir = $this->getDirectory();

            if (!$this->files->isDirectory($dir)) {
                $this->files->makeDirectory($dir, 0755, true);
            }

            return $this;
        }

        private function getDirectory()
        {
            return Config::get('presenter.presenter_path');
        }

        private function createClass()
        {
            return $this->files->put($this->getPath(), $this->populateStub());
        }

        private function getPath()
        {
            return $this->getDirectory() . DIRECTORY_SEPARATOR . $this->getPresenterName() . '.php';
        }

        private function getStubPath()
        {
            return __DIR__ . '/../../resources/stubs/';
        }

        private function getStub()
        {
            return $this->files->get($this->getStubPath() . 'presenter.stub');
        }

        private function populateStub()
        {
            $populate_data = $this->getPopulatedData();
            $stub = $this->getStub();

            foreach ($populate_data as $search => $replace) {
                $stub = str_replace($search, $replace, $stub);
            }

            return $stub;
        }

        public function getPopulatedData()
        {
            return [
                'presenter_namespace' => Config::get('presenter.presenter_namespace'),
                'presenter_class' => $this->getPresenterName()
            ];
        }
    }