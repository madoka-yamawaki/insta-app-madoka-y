<div class="mt-3">
    {{--show comments here--}}
    @if ($post->comments->isNotEmpty())
        <ul class="list-group mt-2">
            @foreach ($post->comments as $comment)
            {{--this will only take 3 comments--}}
            <li class="list-group-item border-0 p-0 mb-2">
                <a href="{{route('profile.show',$comment->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$comment->user->name}}</a>
                &nbsp;
                <p class="d-inline fw-light">{{$comment->body}}</p>

                <form action="{{route('comment.destroy',$comment->id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <span class="text-uppercase text-muted xsmall">{{$comment->created_at->diffForHumans()}}</span>

                    {{--if logged user is owner of the comment--}}
                    @if (Auth::user()->id === $comment->user->id)
                    &middot;
                    <button class="border-0 bg-transparent text-danger p-0 csmall">Delete</button>
                    @endif
                </form>
            </li>
            @endforeach
        </ul>
    @endif

    {{--comment form--}}
    <form action="{{route('comment.store',$post->id)}}" method="POST">
        @csrf
        <div class="input-group">
            <textarea name="comment_body{{$post->id}}" id="comment_body{{$post->id}}" rows="1" class="form-control form-control-sm"  placeholder="Add a comment...">{{old('comment_body'.$post->id)}}</textarea>
            <button class="btn btn-outline-secondary btn-sm">Post</button>
        </div>
        @error('comment_body' .$post->id)
            <div class="small text-danger">{{$message}}</div>
        @enderror
    </form>
</div>
