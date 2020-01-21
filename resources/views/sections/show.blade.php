@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($section->name) ? $section->name : 'Section' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('sections.section.destroy', $section->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('sections.section.index') }}" class="btn btn-primary" title="Show All Section">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('sections.section.create') }}" class="btn btn-success" title="Create New Section">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('sections.section.edit', $section->id ) }}" class="btn btn-primary" title="Edit Section">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Section" onclick="return confirm(&quot;Click Ok to delete Section.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $section->name }}</dd>

        </dl>

    </div>
</div>

@endsection