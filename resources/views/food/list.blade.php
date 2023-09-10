@extends('layouts.AdminLTE.index') 

@section('icon_page', 'user') 

@section('title', 'Food Details') 

@section('content') 

<div class="row">
	<div class="col-md-12">    
        <div class="table-responsive">
            <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
                <thead>
                    <tr>             
                        <th>Product Code</th>            
                        <th>Product Name</th>            
                        <th>Product Type</th>            
                        <th>Ingredients</th>            
                        <th>Time</th>            
                        <th>Delete</th>            
                    </tr>
                </thead>
                <tbody>
                    @foreach($foodList as $food)
                            <tr>
                                <td>{{ $food->pcode }}</td>             
                                <td>{{ $food->pname }}</td>             
                                <td>{{ $food->receipe }}</td>             
                                <td>{{ $food->ingredients }}</td>             
                                <td>{{ $food->time }}</td>             
                                <td class="text-center"> 
                                     <a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $food->pname}}" data-toggle="modal" data-target="#modal-food-delete-{{ $food->id }}"><i class="fa fa-trash"></i></a> 
                                </td> 
                            </tr>
                            <div class="modal fade" id="modal-food-delete-{{ $food->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete ({{ $food->pname }}) ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            <a href="{{ route('food.destroy', $food->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
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
        {{ $foodList->links() }}
    </div>
</div>

@endsection