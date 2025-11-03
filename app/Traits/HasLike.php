<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLike
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    public function like(): void
    {
        if (auth()->user()) {
            $model = $this->Likes()->where('user_id', auth()->id())->first();
            if ($model) {
                $model->delete();
            } else {
                $model->total_like = ($this->total_like??0) + 1;
                $model->save();
                $this->Likes()->create([
                    'user_id' => auth()->id(),
                ]);
            }
        } else {
            abort(400, 'وارد سایت شوید');
        }
    }
    
    public function isLiked(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
