<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    // Variabili. 
    public $comments = [];

    public $newComment;



    // Function. 
    public function render()
    {
        return view('livewire.comments');
    }

    public function addComment()
    {
        array_unshift($this->comments, [
            'body'      =>  $this->newComment,
            'created_at'=> Carbon::now()->format('d-m-Y h:m'),
            'creator'   => ucwords(auth()->user()->name) 
        ]);

        $this->newComment = '';
    }



}
