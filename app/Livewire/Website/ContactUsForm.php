<?php

namespace App\Livewire\Website;

use App\Actions\Ticket\StoreTicketAction;
use App\Enums\TicketDepartmentEnum;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ContactUsForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $comment;
    
    public $result_message;
    
    private UserRepositoryInterface $userRepository;
    
    public function boot(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function rules(): array
    {
        return [
            'name'    => [Rule::requiredIf(!auth()->check()), 'max:255'],
            'email'   => [Rule::requiredIf(!auth()->check()),'nullable', 'email', 'max:255'],
            'subject' => 'required|max:255',
            'comment' => 'required',
        ];
    }
    
    public function submit(): void
    {
        $this->reset('result_message');
        $this->validate();
        if (!auth()->check()) {
            $user = $this->userRepository->firstOrCreate([
                'email' => $this->email,
            ], [
                'name' => $this->name,
            ]);
        } else {
            $user = auth()->user();
        }
        
        StoreTicketAction::run([
            'user_id'     => $user->id,
            'subject'     => $this->subject,
            'description' => $this->comment,
            'department'  => TicketDepartmentEnum::CONTACT,
        ]);
        $this->reset(['name', 'email', 'subject', 'comment']);
        $this->dispatch('notify', message:__('core.contact_us_form_success'));
        $this->result_message = __('core.contact_us_form_success');
    }
    
    public function render()
    {
        return view('livewire.website.contact-us-form');
    }
}
