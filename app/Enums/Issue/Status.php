<?php

declare(strict_types=1);

namespace App\Enums\Issue;

enum Status: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
    case UNRESOLVED = 'unresolved';
    case IGNORED = 'ignored';
}
