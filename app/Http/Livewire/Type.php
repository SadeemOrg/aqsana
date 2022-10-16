<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class Type extends Component
{
    public $count ;
    public $size = 'mercedes';
    public $goals;
    public $goal;
    public $Books ;

    public function mount()
    {
        $this->goals = Book::all();
    }

    public function updatedGoal($value)
    {
        if($value==0)
        {
            $Book= Book::all();
            $this->Books = $Book;
        }
        else
        {
        $Book= Book::where('type',$value)->get();
        $this->Books = $Book;
    }
}
    public function increment()
    {
        $this->count++;
    }

    public function type($size)
    {
        $this->count = $size;
    }
    public function render()
    {

        return view('livewire.type');

    }
}
