[![Build Status](https://travis-ci.org/devLopez/Presenter.svg?branch=master)](https://travis-ci.org/devLopez/Presenter)

Masterkey Presenter
===================

O pacote Masterkey presenter foi desenvolvido pensando em uma estrutura unificada para exibição de dados. Claro que, a lógica de transfomação fica por conta do desenvolvedor, mas este pacote permite um *bootstrap* para tais atividades. desenvolvido e pensado para trabalhar com o Laravel 5.4

Instalação
----------
 Instale-o via composer:

 ```sh
 $ composer require masterkey/presenter
 ```

 Após instalado, registre o service provider do package

 ```php
    [
        'providers' => [
            // Outros providers
            Masterkey\Presenter\Providers\PresenterServiceProvider::class,
        ]
    ]
 ```

 e publique o arquivo de configuração:

 ```sh
 $ php artisan vendor:publish
 ```

 Neste arquivo de configuração você pode definir o *path* onde os *presenters* serão criados, além do namespace que eles receberão.

 Utilização
 ----------
 A utilização do pacote é muito simples. Para criar um novo presenter, utilize o comando:

 ```sh
 $ php artisan make:presenter UsersPresenter
 ```

 Este comando irá criar uma classe, por padrão, em ***app/Presenters*** com o namespace definido por você no arquivo de configuração.

 Arquitetura
 -----------
 O package gera uma classe que implementa um contrato, a interface `Masterkey\Presenter\Contracts\PresenterContract`. Para passar dados para o presenter, deve ser passada uma instância do contrato `Ìlluminate\Contracts\Support\Arrayable`. Em geral, as *Collections* do Laravel implementam este contrato.

 Após implementar sua lógica, basta recuperar os dados utilizando o método `getFormatedData()`. Feito isso, basta chutar para o gol e partir para o abraço!

 Qualquer contribuição a este pacote é muito bem vinda!
