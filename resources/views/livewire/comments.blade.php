<div>
    <div class="mt-3">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="card mb-5">
        <div class="card-header text-center">
            <h3 for="comment" class="form-label ">Aggiungi commento</h3>  
        </div>
       
        <div class="card-body">
            <div class="mb-3">
                @if ($immagine)
                <div class="mb-3">
                    <img class="img-thumbnail" src="{{ $immagine->temporaryUrl() }}" style="width: 300px">
                </div>
                @endif
                <label class="form-label">Immagine</label>
                <input class="form-control" type="file" wire:model="immagine">
            </div>
         
            <form wire:submit.prevent="aggiungiCommento">
                <div class="mb-3">
                    <label class="form-label">Testo</label>
                    <input type="text" class="form-control {{ $errors->has('nuovoCommento') ? 'is-invalid' : '' }}" id="comment" wire:model.lazy="nuovoCommento">
                    @error('nuovoCommento') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Invia</button>
            </form>
        </div>
    </div>
    @foreach ($commenti as $commento)
        <div class="card my-2 shadow">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <strong>{{ ucwords($commento->utente->name) }}</strong> <span class="text-secondary mx-4">{{ $commento->created_at->diffForHumans() }}</span>
                </div>
                <div>
                    <button type="button" class="btn-close h6" data-bs-dismiss="modal" aria-label="Close" wire:click="elimina({{ $commento->id }})"></button>
                </div>    
            </div>
            
            <div class="card-body d-flex">
                <div class="me-4">
                    <img class="card-img-top img-thumbnail" src="{{ url('storage/immagine/'.$commento->foto) }}" style="width: 200px">
                </div>
                <div>
                    {{ $commento->corpo }}
                </div>
            </div>
        </div>
    @endforeach
    {{ $commenti->links() }}
</div>

