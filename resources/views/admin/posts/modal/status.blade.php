{{-- Hidden MODAL --}}
<div class="modal fade" id="hide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i>Hide Post
                </h3>
            </div>


            <div class="modal-body">
                <p class=""> Are you sure you want to hide this post?</p>
                <img src="{{ $post->image }}" alt="" class="d-block mx-auto admin-post-img">
                <p>Post{{$post->id}}</p>
            </div>

            <div class="modal-footer border-0">
                <form action="{{route('admin.posts.hide',$post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"class="btn btn-danger btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--UNHIDE MODAL --}}
<div class="modal fade" id="unhide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-check"></i>Unhide <u>Post</u>
                </h3>
            </div>


            <div class="modal-body">
                <p>Are you sure you want to unhide this post?</p>
                <img src="{{ $post->image }}" alt="" class="d-block mx-auto admin-post-img">
                <p>Post{{$post->id}}</p>
            </div>

            <div class="modal-footer border-0">
                <form action="{{route('admin.posts.unhide',$post->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-success btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"class="btn btn-success btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>
