<div>
    <div class="card p-3 my-5 ">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <form wire:submit.prevent="aggiungiCommento">
            <div class="mb-3 text-center">
                <h3 for="comment" class="form-label ">Aggiungi commento</h3>
                <input type="text" class="form-control {{ $errors->has('nuovoCommento') ? 'is-invalid' : '' }}" id="comment" wire:model.lazy="nuovoCommento">
                @error('nuovoCommento') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
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
            
            <div class="card-body">
                {{ $commento->corpo }}
            </div>
        </div>
    @endforeach
</div>