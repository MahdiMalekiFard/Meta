<?php

namespace App\Livewire;

use App\Actions\Comment\StoreCommentAction;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddComment extends Component
{
    #[Validate('required|max:255', message: 'Please provide a post title')]
    public $comment;
    public $item;
    public $message;
    public $comments;
    
    public function mount($item)
    {
        $this->item = $item;
        $this->comments = $this->item->comments()->active()->latest()->get();
    }
    
    public function submit(): void
    {
        $this->reset('message');
        $this->validate();
        StoreCommentAction::run([
            'commentable_id'   => $this->item->id,
            'commentable_type' => $this->item::class,
            'comment'          => $this->comment,
            'user_id'          => auth()->id(),
        ]);
        $this->reset('comment');
        $this->dispatch('notify', message: __('comment.comment_added_successfully_show_comment_after_approve_by_admin'));
        $this->message = __('comment.comment_added_successfully_show_comment_after_approve_by_admin');
    }
    
    public function render()
    {
        return view('livewire.add-comment');
    }
}
