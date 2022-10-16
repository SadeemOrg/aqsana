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
    public $books ;
    public $book_type ;

    public function mount()
    {
        $this->goals = Book::all();
    }

    public function updatedGoal($value)
    {
        if($value==0)
        {
            $Book= Book::all();
            $this->books = $Book;
        }
        else
        {
        $Book= Book::where('type',$value)->get();
        $this->books = $Book;
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
