<?php

    namespace Masterkey\Presenter\Exceptions;

    use Exception;

    /**
     * PresenterExistsException
     *
     * @author  Mastheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   13/017/2017
     * @package Masterkey\Presenter\Exeptions
     */
    class PresenterExistsException extends Exception
    {
        /**
         * @var string
         */
        protected $message = 'The presenter class already exists!';
    }