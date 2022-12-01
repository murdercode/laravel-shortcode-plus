<?php

namespace Murdercode\LaravelShortcodePlus\Http\Livewire\Modals;

use Livewire\Component;

class ModalImage extends Component
{
    public $show;

    public $path;

    public $title;

    protected $listeners = [
        'showImageModal' => 'showImageModal',
        'doCloseModal' => 'doCloseModal',
    ];

    public function mount($path = null, $title = null)
    {
        $this->path = $path;
        $this->title = $title;
        $this->show = false;
    }

    public function showImageModal($path, $title)
    {
        $this->path = $path;
        $this->title = $title;

        $this->doShow();
    }

    public function doShow()
    {
        $this->show = true;
    }

    public function doClose()
    {
        $this->show = false;
    }

    public function doCloseModal()
    {
        $this->doClose();
    }

    public function doSomething()
    {
        $this->doClose();
    }

    public function render()
    {
        return view('livewire.modals.modal-image');
    }
}
