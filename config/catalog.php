<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Catalog categories
    |--------------------------------------------------------------------------
    */

    'categories' => [
        'smartphones' => [
            'label' => 'Смартфоны',
            'icon' => '📱',
            'description' => 'Флагманы и доступные модели',
        ],
        'laptops' => [
            'label' => 'Ноутбуки',
            'icon' => '💻',
            'description' => 'Для работы, учёбы и игр',
        ],
        'audio' => [
            'label' => 'Аудио',
            'icon' => '🎧',
            'description' => 'Наушники и колонки',
        ],
        'gadgets' => [
            'label' => 'Гаджеты',
            'icon' => '⌚',
            'description' => 'Умные часы и трекеры',
        ],
        'accessories' => [
            'label' => 'Аксессуары',
            'icon' => '🔌',
            'description' => 'Зарядки, кабели, чехлы',
        ],
        'smart-home' => [
            'label' => 'Умный дом',
            'icon' => '💡',
            'description' => 'Свет, климат и безопасность',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Catalog products
    |--------------------------------------------------------------------------
    */

    'products' => [
        [
            'slug' => 'nova-phone-14',
            'name' => 'Nova Phone 14',
            'category' => 'smartphones',
            'description' => '6.7" AMOLED, 256 ГБ, камера 50 Мп',
            'price' => 79990,
            'old_price' => 89990,
            'rating' => 4.9,
            'reviews' => 214,
            'badge' => 'Хит',
            'emoji' => '📱',
            'gradient' => 'from-indigo-500 via-violet-500 to-purple-600',
        ],
        [
            'slug' => 'aurora-book-pro-14',
            'name' => 'Aurora Book Pro 14',
            'category' => 'laptops',
            'description' => '14" Liquid Retina, 16 ГБ, SSD 512 ГБ',
            'price' => 129990,
            'old_price' => 139990,
            'rating' => 4.9,
            'reviews' => 132,
            'badge' => 'Новинка',
            'emoji' => '💻',
            'gradient' => 'from-sky-500 via-blue-500 to-indigo-600',
        ],
        [
            'slug' => 'pulse-buds-air',
            'name' => 'Pulse Buds Air',
            'category' => 'audio',
            'description' => 'Активное шумоподавление, 30 ч автономности',
            'price' => 9990,
            'old_price' => 12990,
            'rating' => 4.8,
            'reviews' => 389,
            'badge' => 'Скидка',
            'emoji' => '🎧',
            'gradient' => 'from-rose-500 via-pink-500 to-fuchsia-600',
        ],
        [
            'slug' => 'orbit-watch-s',
            'name' => 'Orbit Watch S',
            'category' => 'gadgets',
            'description' => 'AMOLED, GPS, до 7 дней без зарядки',
            'price' => 24990,
            'old_price' => null,
            'rating' => 4.8,
            'reviews' => 96,
            'badge' => null,
            'emoji' => '⌚',
            'gradient' => 'from-emerald-500 via-teal-500 to-cyan-600',
        ],
        [
            'slug' => 'nova-phone-se',
            'name' => 'Nova Phone SE',
            'category' => 'smartphones',
            'description' => '6.1" OLED, 128 ГБ, двойная камера',
            'price' => 49990,
            'old_price' => null,
            'rating' => 4.7,
            'reviews' => 178,
            'badge' => null,
            'emoji' => '📱',
            'gradient' => 'from-blue-500 via-cyan-500 to-sky-600',
        ],
        [
            'slug' => 'flux-powerbank-20k',
            'name' => 'Flux PowerBank 20K',
            'category' => 'accessories',
            'description' => '20 000 мА·ч, USB-C 65 Вт, быстрая зарядка',
            'price' => 4590,
            'old_price' => null,
            'rating' => 4.6,
            'reviews' => 512,
            'badge' => null,
            'emoji' => '🔋',
            'gradient' => 'from-amber-500 via-orange-500 to-red-500',
        ],
        [
            'slug' => 'beam-speaker-mini',
            'name' => 'Beam Speaker Mini',
            'category' => 'audio',
            'description' => 'Портативная колонка, 360°, IP67',
            'price' => 6990,
            'old_price' => null,
            'rating' => 4.7,
            'reviews' => 241,
            'badge' => null,
            'emoji' => '🔊',
            'gradient' => 'from-fuchsia-500 via-purple-500 to-indigo-600',
        ],
        [
            'slug' => 'halo-lamp-smart',
            'name' => 'Halo Lamp Smart',
            'category' => 'smart-home',
            'description' => 'Умная лампа, 16 млн цветов, Wi-Fi',
            'price' => 8990,
            'old_price' => null,
            'rating' => 4.5,
            'reviews' => 87,
            'badge' => null,
            'emoji' => '💡',
            'gradient' => 'from-yellow-400 via-amber-500 to-orange-600',
        ],
    ],

];
