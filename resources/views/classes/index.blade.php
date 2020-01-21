@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Classes</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('classes.classe.create') }}" class="btn btn-success" title="Create New Classe">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($classes) == 0)
            <div class="panel-body text-center">
                <h4>No Classes Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Neveau</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($classes as $classe)
                        <tr>
                            <td>{{ optional($classe->section)->name }}</td>
                            <td>{{ $classe->neveau }}</td>

                            <td>

                                <form method="POST" action="{!! route('classes.classe.destroy', $classe->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('classes.classe.show', $classe->id ) }}" class="btn btn-info" title="Show Classe">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('classes.classe.edit', $classe->id ) }}" class="btn btn-primary" title="Edit Classe">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Classe" onclick="return confirm(&quot;Click Ok to delete Classe.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $classes->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection