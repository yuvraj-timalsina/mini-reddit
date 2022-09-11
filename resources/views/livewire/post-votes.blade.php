<div class="col-1 text-center">
    <div>
        <a wire:click.prevent="vote(1)" href="#"><i
                class="fa-solid fa-sort-up fa-2x"></i></a>
    </div>
    <h2 class="fw-bold">{{$post->votes}}</h2>
    <div><a wire:click.prevent="vote(-1)" href="#"><i
                class="fa-solid fa-sort-down fa-2x"></i></a></div>
</div>
