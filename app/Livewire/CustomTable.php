<?php

namespace App\Livewire;

use Livewire\Component;

class CustomTable extends Component
{
    public $config = [
        'columns' => [],
        'data' => [],
        'actions' => [],
        'emptyMessage' => 'No records found.',
    ];

    public function mount($config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    public function triggerAction($action, $id)
    {
        $this->dispatch($action, id: $id);
    }

    public function render()
    {
        return view('livewire.custom-table');
    }
}
