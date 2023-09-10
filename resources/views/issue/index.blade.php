@extends('layouts.AdminLTE.index') 

@section('icon_page', 'user') 

@section('title', 'Add Health Issue') 

@section('content') 

<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#adddata" data-toggle="tab"><i class="fa-solid fa-burger"></i>Add Health Issue</a></li>
				
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="adddata">
					<form action="{{ route('saveHealthIssueDetails')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="post">
                        <div class="form-group {{ $errors->has('problem_type') ? 'has-error' : '' }}">
                            <label for="nome">Select Problem</label>
                            <select class="form-control" name="problem_type" required>
                                <option value="">Select Problem</option>
                                @if(isset($problemTypes) && !empty($problemTypes))
                                    @foreach($problemTypes as $ptype)
                                    <option value="{{$ptype->id}}">{{$ptype->problem_type}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('problem_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('problem_type') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('problem_level') ? 'has-error' : '' }}">
                            <label for="nome">Select Problem Level</label>
                            <select class="form-control" name="problem_level" required>
                                <option value="">Select Problem Level</option>
                                @if(isset($problemLevels) && !empty($problemLevels))
                                    @foreach($problemLevels as $plevel)
                                    <option value="{{$plevel->id}}">{{$plevel->problem_level}}</option>
                                    @endforeach
                                @endif
                            </select>
                             @if($errors->has('problem_level'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('problem_level') }}</strong>
                                </span>
                            @endif
                        </div>
						<div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                            <label for="nome">Time</label>
                            <div class="container12">
                               <div class="row">
                                  <div class='col-sm-6'>
                                     <div class="form-group">
                                        <div class='input-group date' id='datetimepicker1'>
                                           <input type='text' class="form-control" name="time"/>
                                           <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                           </span>
                                        </div>
                                     </div>
                                  </div>
                                  <script type="text/javascript">
                                      $(function () {
                                        var dateNow = new Date();
                                        
                                        $('#datetimepicker1').datetimepicker({
                                            format: 'YYYY-MM-DD HH:mm:ss',
                                            defaultDate:dateNow
                                        });
                                    });
                                  </script>
                               </div>
                            </div>
                             @if($errors->has('time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('time') }}</strong>
                                </span>
                            @endif
                        </div>	
                        <div class="form-group text-right">
                           <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Save Details</button>
                        </div>
					</form>						
				</div>
			</div>
		</div>
	</div>
</div>

@endsection