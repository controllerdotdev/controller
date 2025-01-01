<?php

declare(strict_types=1);

namespace App\Enums\Issue;

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

}
