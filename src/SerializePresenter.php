<?php

    namespace Masterkey\Presenter;

    /**
     * SerializePresenter
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   13/07/2017
     * @package Masterkey\Presenter
     */
    trait SerializePresenter
    {
        /**
         * @return  array
         */
        public function toArray()
        {
            return $this->getFormattedData()->toArray();
        }

        /**
         * @return  array
         */
        public function toJson()
        {
            return $this->getFormattedData()->toJson();
        }
    }