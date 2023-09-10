@extends('layouts.AdminLTE.index')
@section('menu_pagina')	
		
	<li role="presentation">
		<a href="{{ route('problemlist') }}" class="link_menu_page">
			<i class="fa fa-user"></i> Problem Types
		</a>								
	</li>

@endsection

@section('content')    
        
    <div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					 <form action="{{ route('problem') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="active" value="1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('problem_type') ? 'has-error' : '' }}">
                                    <label for="nome">Name</label>
                                    <input type="text" name="problem_type" class="form-control" maxlength="30" minlength="4" placeholder="Problem Type" required="" value="{{ old('problem_type') }}" autofocus>
                                    @if($errors->has('problem_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('problem_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                               <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>    

@endsection

@section('layout_js')
    


@endsection