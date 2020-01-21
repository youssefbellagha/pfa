@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Post' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('posts.post.destroy', $post->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('posts.post.index') }}" class="btn btn-primary" title="Show All Post">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('posts.post.create') }}" class="btn btn-success" title="Create New Post">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('posts.post.edit', $post->id ) }}" class="btn btn-primary" title="Edit Post">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Post" onclick="return confirm(&quot;Click Ok to delete Post.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Club</dt>
            <dd>{{ optional($post->club)->name }}</dd>
            <dt>Titre</dt>
            <dd>{{ $post->Titre }}</dd>
            <dt>Description</dt>
            <dd>{{ $post->description }}</dd>
            <dt>Photo</dt>
            <dd>{{ asset('storage/' . $post->photo) }}</dd>
            <dt>Date</dt>
            <dd>{{ $post->date }}</dd>
            <dt>Lieu</dt>
            <dd>{{ $post->lieu }}</dd>
            <dt>Etudiant</dt>
            <dd>{{ optional($post->etudiant)->name }}</dd>

        </dl>

    </div>
</div>

@endsection