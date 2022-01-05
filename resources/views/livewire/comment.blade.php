<div>
    @if ($comments->count())
        @foreach ($comments as $comment)
            <div class="row mt-3 align-items-center">
                <div class="col-md-1 col-3">
                    @if ($comment->user->url_photo)
                        <img src="{{ asset('uploads/' . $comment->user->url_photo) }}" alt="Foto Profil"
                            class="img-fluid rounded-circle">
                    @else

                        <img src="{{ asset('uploads/profile-image/blank.png') }}" alt="Foto Profil"
                            class="img-fluid rounded-circle">
                    @endif
                </div>
                <div class="col-md-11 col-9">
                    <p class="fs-md-1">{{ $comment->user->name }}</p>
                </div>
            </div>
            <p class="mt-md-3 mt-5">{{ $comment->comment }}</p>
            <hr class="mt-2">
        @endforeach

        {{ $comments->links() }}
    @else
        <p class="text-muted text-center fs-1 mt-4">Belum Ada Komentar</p>
    @endif

</div>
