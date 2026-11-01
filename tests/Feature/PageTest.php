<?php

it('renders the home page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('NOVA')
        ->assertSee('Техника, которая');
});

it('renders the catalog page', function () {
    $this->get(route('catalog'))
        ->assertOk()
        ->assertSee('Каталог')
        ->assertSee('Nova Phone 14')
        ->assertSee('Pulse Buds Air');
});

it('renders the about page', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('О компании')
        ->assertSee('Начали с одного склада');
});

it('renders the registration page', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('Регистрация')
        ->assertSee('Создать аккаунт');
});
