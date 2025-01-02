<?php

declare(strict_types=1);

namespace App\Enums;

enum Platform: string
{
    case IOS = 'ios';
    case ANDROID = 'android';
    case PHP = 'php';
    case LARAVEL = 'laravel';
    case PYTHON = 'python';
    case RUBY = 'ruby';
    case RUST = 'rust';
    case SWIFT = 'swift';
    case TYPESCRIPT = 'typescript';
    case VUE = 'vue';

    public static function all(): array
    {
        return array_map(fn($case) => [
            'id' => $case->value,
            'name' => $case->getFullName(),
        ], self::cases());
    }

    public function getFullName(): string
    {
        return match ($this) {
            self::IOS => 'iOS',
            self::ANDROID => 'Android',
            self::PHP => 'PHP',
            self::LARAVEL => 'Laravel',
            self::PYTHON => 'Python',
            self::RUBY => 'Ruby',
            self::RUST => 'Rust',
            self::SWIFT => 'Swift',
            self::TYPESCRIPT => 'TypeScript',
            self::VUE => 'Vue',
        };
    }

}
