<div>
    <div class="card p-3 my-5">
        <div class="mb-3 text-center">
            <h3 for="comment" class="form-label ">Aggiungi commento</h3>
            {{-- wire:model.lazy in modo da fare una ciamata ajax unica e non per ogni lettera che si scrive --}}
            <input type="text" class="form-control" id="comment" wire:model.lazy="newComment">
        </div>
        <button type="submit" class="btn btn-primary" wire:click="addComment">Invia</button>
    </div>

    @foreach ($comments as $comment)
        <div class="card my-2 shadow">
            <div class="card-header">
               Commento di <strong>{{ $comment['creator'] }}</strong> - creato il: <strong>{{ $comment['created_at'] }}</strong>
            </div>
            
            <div class="card-body">
                {{ $comment['body'] }}
            </div>
        </div>
    @endforeach
</div>