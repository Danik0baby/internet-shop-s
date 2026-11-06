<?php

namespace App\Enums;

enum OrderStatus: string
{
    case New = 'new';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    /**
     * Human readable status label.
     */
    public function label(): string
    {
        return match ($this) {
            self::New => 'Новый',
            self::Processing => 'В обработке',
            self::Shipped => 'Отправлен',
            self::Completed => 'Выполнен',
            self::Cancelled => 'Отменён',
        };
    }
}
