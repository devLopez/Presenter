<?php

    use PHPUnit\Framework\TestCase;
    use Masterkey\Presenter\Generators\PresenterGenerator;
    use Illuminate\Filesystem\Filesystem;

    class GeneratorTest extends TestCase
    {
        public function testSetInstanceOfGenerator()
        {
            $fs = new Filesystem();
            $generator = new PresenterGenerator($fs);

            $this->assertInstanceOf(PresenterGenerator::class, $generator);
        }

        public function testCreationOfClass()
        {
            $fs = new Filesystem();
            $fs->deleteDirectory(__DIR__ . '/../app');

            $generator = new PresenterGenerator($fs);

            $generator->create('User');
            $generator->create('Movie');

            $this->assertFileExists(__DIR__ . '/../app/Presenters/UserPresenter.php');
            $this->assertFileExists(__DIR__ . '/../app/Presenters/MoviePresenter.php');
        }

        /**
         * @expectedException  \Masterkey\Presenter\Exceptions\PresenterExistsException
         */
        public function testException()
        {
            $fs = new Filesystem();
            $generator = new PresenterGenerator($fs);

            $generator->create('User');
            $generator->create('Movie');
        }
    }