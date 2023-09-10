@extends('layouts.AdminLTE.index') 

@section('icon_page', 'user') 

@section('title', 'List Of Health Issues') 

@section('content') 

<div class="row">
	<div class="col-md-12">    
        <div class="table-responsive">
            <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                <thead>
                    <tr>             
                        <th>Health Issue Name</th>            
                        <th>Health Issue Level</th>            
                        <th>Time</th>            
                        <th>Delete</th>            
                    </tr>
                </thead>
                <tbody>
                    @foreach($issueList as $issue)
                            <tr>
                                <td>{{ $issue->problem_type->problem_type }}</td>             
                                <td>{{ $issue->problem_level->problem_level }}</td>             
                                <td>{{ $issue->time }}</td>             
                                <td class="text-center"> 
                                     <a class="btn btn-danger  btn-xs" href="#" title="Delete" data-toggle="modal" data-target="#modal-issue-delete-{{ $issue->id }}"><i class="fa fa-trash"></i></a> 
                                </td> 
                            </tr>
                            <div class="modal fade" id="modal-issue-delete-{{ $issue->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete this item ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            <a href="{{ route('issue.destroy', $issue->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>              
    <div class="col-md-12 text-center">
        {{ $issueList->links() }}
    </div>
</div>

@endsection