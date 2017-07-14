<?php

    namespace Masterkey\Presenter\Contracts;

    /**
     * PresenterContract
     *
     * Ccntrato que rege as classes de presenters do sistema
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.1.0
     * @since   13/07/2017
     */
    interface PresenterContract
    {
        public function getFormattedData();

        public function toArray();

        public function toJson();
    }
