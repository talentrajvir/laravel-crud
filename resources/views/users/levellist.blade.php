@extends('layouts.AdminLTE.index')
@section('menu_pagina')	
		
	<li role="presentation">
		<a href="{{ route('addlevel') }}" class="link_menu_page">
			<i class="fa fa-plus"></i> Add
		</a>								
	</li>


@endsection

@section('content')    
        
    <div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>			 
									<th>Name</th>			 
								</tr>
							</thead>
							<tbody>
								@foreach($list as $record)
										<tr>
											<td>
												{{ $record->problem_level }}
											</td>             
											<td class="text-center"> 
												 <a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $record->problem_level}}" data-toggle="modal" data-target="#modal-delete-{{ $record->id }}"><i class="fa fa-trash"></i></a> 
											</td> 
										</tr>
										<div class="modal fade" id="modal-delete-{{ $record->id }}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
													</div>
													<div class="modal-body">
														<p>Do you really want to delete ({{ $record->problem_level }}) ?</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
														<a href="{{ route('destroylevel', $record->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
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
					{{ $list->links() }}
				</div>
			</div>
		</div>
	</div>    

@endsection

@include('layouts.AdminLTE._includes._data_tables')