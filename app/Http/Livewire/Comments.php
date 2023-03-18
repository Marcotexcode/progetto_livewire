<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Commento;

class Comments extends Component
{
    /**
     * Variabili.
     */
    public $nuovoCommento;
    public $commenti = [];

    /**
     * validazione. 
     */
    protected $rules = [
        'nuovoCommento' => 'required || max:100'
    ];

    /**
     * Customizzo messaggi validazione.
     */
    protected $messages = [
        'nuovoCommento.required'=> 'Campo obbligatorio.',
        'nuovoCommento.max'     => 'Massimo 100 caratteri.',
    ];

    /**
     * Il metodo render restituisce la vista blade.
     */
    public function render()
    {
        return view('livewire.comments');
    }

    /**
     * Metodo per aggiungere commento
     */
    public function aggiungiCommento()
    {
        $dati = $this->validate();

        $nuovoCommento = Commento::create([
            'corpo'     => $dati['nuovoCommento'],
            'user_id'   => auth()->user()->id
        ]); 

        $this->commenti->prepend($nuovoCommento);

        $this->nuovoCommento = '';

        session()->flash('message', 'Commento aggiunto');
    }

    /**
     * Elimina commento.
     */
    public function elimina($commentoId) 
    {
        Commento::find($commentoId)->delete();

        $this->commenti = $this->commenti->except($commentoId);

        session()->flash('message', 'Commento eliminato');
    }

    /**
     * In questo metodo vengono passati di dati per il componente,
     * viene chiamato solo all'inizializzazione del componente.
     */
    public function mount()
    {
        $this->commenti = Commento::latest()->get();
    }
}
