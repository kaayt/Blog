@extends ('layouts.master')


@section('content')

    <div class="col-sm-9 ml-sm-auto blog-sidebar">

        <h1>Publish a post</h1>

        <hr>

            <form method="post" action="{!! route('posts.store') !!}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" >
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Body</label>
                    <textarea id="body" name="body" class="form-control" ></textarea>
                </div>

                <div class="form-group">
                     <button type="submit" class="btn btn-primary">Publish</button>
                </div>
            </form>

       @include('layouts.errors')

    </div>
@endsection
