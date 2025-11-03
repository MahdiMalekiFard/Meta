<?php

namespace App\Repositories\Blog;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Blog;
    
    public function getLatestActiveWithLimit(int $limit,array $payload=[]): Collection;
}
