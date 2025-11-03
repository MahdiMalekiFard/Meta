<?php

namespace App\Livewire\Website;

use App\Models\Blog;
use Livewire\Component;

class BlogSearch extends Component
{
    public $search;
    public $results;
    
    public function updatedSearch($value)
    {
        $this->results = Blog::with('translations')->search($value)->limit(5)->get()->map(function (Blog $blog) {
            $item['id'] = $blog->id;
            $item['title'] = $blog->title;
            $item['url'] = route('blog.show', ['blog' => $blog->slug,'locale' => app()->getLocale()]);
            return $item;
        })->toArray();
    }
    
    public function render()
    {
        return view('livewire.website.blog-search');
    }
}
