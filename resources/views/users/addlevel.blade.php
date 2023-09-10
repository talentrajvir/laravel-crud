@extends('layouts.AdminLTE.index')
@section('menu_pagina')	
		
	<li role="presentation">
		<a href="{{ route('levellist') }}" class="link_menu_page">
			<i class="fa fa-user"></i> Problem Levels
		</a>								
	</li>

@endsection

@section('content')    
        
    <div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					 <form action="{{ route('level') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="active" value="1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('problem_level') ? 'has-error' : '' }}">
                                    <label for="nome">problem_level</label>
                                    <input type="text" name="problem_level" class="form-control" maxlength="30" minlength="4" placeholder="Problem Level" required="" value="{{ old('problem_level') }}" autofocus>
                                    @if($errors->has('problem_level'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('problem_level') }}</strong>
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