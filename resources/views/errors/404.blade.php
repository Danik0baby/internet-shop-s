@extends('layouts.app')

@section('title', 'Страница не найдена — '.config('shop.name', 'NOVA'))

@section('content')
    <section class="container-page py-24">
        <div class="mx-auto max-w-xl text-center">
            <p class="text-7xl font-bold tracking-tight text-indigo-600">404</p>
            <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Страница не найдена</h1>
            <p class="mt-4 text-base leading-7 text-slate-600">
                Возможно, ссылка устарела или товар был удалён. Попробуйте вернуться на главную или открыть каталог.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('home') }}" class="btn-primary">На главную</a>
                <a href="{{ route('catalog') }}" class="btn-secondary">В каталог</a>
            </div>
        </div>
    </section>
@endsection
