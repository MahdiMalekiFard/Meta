<?php

declare(strict_types=1);

namespace App\Pipelines\User\Data;

use App\Pipelines\PipelineInterface;
use Closure;

class CheckUserExistPipeline implements PipelineInterface
{

    /**
     * @param array   $payload
     * @param Closure $next
     * @return array
     */
    public function handle(array $payload, Closure $next): array
    {

        return $next($payload);
    }
}
