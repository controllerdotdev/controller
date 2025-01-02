<?php

declare(strict_types=1);

namespace App\Http\Requests\Issue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'event_id' => 'required|uuid',
            'project_id' => 'required|uuid|exists:projects,id',
            'timestamp' => 'required|date',
            'platform' => 'required|string',
            'environment' => 'required|string',
            'release' => 'nullable|string',

            'exception' => 'required|array',
            'exception.type' => 'required|string',
            'exception.value' => 'required|string',
            'exception.mechanism' => 'required|array',
            'exception.stacktrace' => 'required|array',
            'exception.stacktrace.frames' => 'required|array',

            'tags' => 'nullable|array',
            'extra' => 'nullable|array',
            'user' => 'nullable|array',
            'request' => 'nullable|array',
            'contexts' => 'nullable|array',
            'transaction' => 'nullable|string',
        ];
    }
}
