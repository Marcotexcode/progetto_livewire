<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Commento;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    /**
     * Variabili.
     */
    protected $paginationTheme = 'bootstrap';
    public $nuovoCommento;
    public $immagine;

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
        return view('livewire.comments', [
            'commenti' => Commento::orderBy('posizione', 'ASC')->paginate(20)
        ]);
    }

    /**
     * Metodo per aggiungere commento
     */
    public function aggiungiCommento(Commento $commento)
    {
        $dati = $this->validate();

        $img = $this->immagine->store('immagine', 'public');

        $commento = $commento->orderBy('posizione', 'DESC')->first();

        $nuovoCommento = $commento->create([
            'corpo'     => $dati['nuovoCommento'],
            'foto'      => $this->immagine->hashName(),
            'user_id'   => auth()->user()->id,
            'posizione' => $commento->posizione + 1
        ]); 

        $this->nuovoCommento = '';

        $this->resetPage();

        session()->flash('message', 'Commento aggiunto');
    }

    /**
     * Elimina commento.
     */
    public function elimina($commentoId) 
    {
        $commento = Commento::find($commentoId);

        Storage::disk('public')->delete('immagine/'. $commento->foto);
        
        $commento->delete();

        $this->resetPage();

        session()->flash('message', 'Commento eliminato');
    }

    public function updateCommentOrder($items) 
    {
      foreach ($items as $item) {
            Commento::find($item['value'])->update([
                'posizione' => $item['order']
            ]);
      }
    }

}
