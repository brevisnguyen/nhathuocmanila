<?php

namespace App\Livewire;

use Livewire\Component;

class QuestionAnswerPage extends Component
{
    public function render()
    {
        return view('livewire.question-answer-page')
            ->title('Câu hỏi thường gặp');
    }
}
