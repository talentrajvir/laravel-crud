@extends('layouts.AdminLTE.index') 

@section('icon_page', 'user') 

@section('title', 'Food Details') 

@section('content') 

<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#adddata" data-toggle="tab"><i class="fa-solid fa-burger"></i>Add Food Details</a></li>
				
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="adddata">
					<form action="{{ route('saveFoodDetails') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="post">
						<div class="form-group {{ $errors->has('pcode') ? 'has-error' : '' }}">
                            <label for="nome">Product Code</label>
                            <input type="text" name="pcode" class="form-control" maxlength="30" minlength="4" placeholder="Product Code" required="" value="">
                            @if($errors->has('pcode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pcode') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nome">Choose Food Or Drinks</label></br>
                            <label class="radio-inline">
                            <input type="radio" name="food_or_drink" checked value='1'>Foods
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="food_or_drink" value='2'>Drinks
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group {{ $errors->has('pname') ? 'has-error' : '' }}">
                                    <label for="nome">Product Name</label>
                                     <input type="text" id="pname" name="pname" class="form-control" maxlength="30" minlength="4" placeholder="Product Name" required="" value="">
                                    @if($errors->has('pname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="nome">Search Receipe</label>
                                    <button type="button" class="btn btn-primary" id="lookfood"><i class="fa fa-fw fa-save"></i> Search Receipe</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <select class="form-control" name="food_type" required id="food_type_search">
                                <option value="">Select Food</option>
                            </select>
                        </div>
                        <script type="text/javascript">
                            var FOOD_API_KEY = '{{ env('FOOD_API_KEY') }}';
                            var DRINK_API_KEY = '{{ env('DRINK_API_KEY') }}';
                           
                          $(function () {
                                $('#lookfood').on('click', function () {
                                    $('#food_type_search option:not(:first)').remove();
                                    var choice = $('input[name="food_or_drink"]:checked').val();
                                    var food = $("#pname").val();
                                    $('#ingredients').val('');
                                    if(choice==2)
                                    {
                                        $.ajax({
                                        url: 'https://api.nal.usda.gov/fdc/v1/foods/search?api_key='+DRINK_API_KEY+'&query='+food+'',
                                         success:function(responsedata){
                                               // process on data
                                              var res = responsedata.foods;
                                              $.each(res, function(key,val) {    
                                                if(val.brandOwner!='' && val.brandOwner!='undefined' && val.brandOwner!=undefined)
                                                {
                                                    var drinkDetail =val.description+ '('+val.brandOwner+')';
                                                }
                                                else{
                                                    var drinkDetail =val.description;
                                                }
                                                $('#food_type_search').append('<option data-val="'+val.fdcId+'" value="'+val.description+'">'+drinkDetail+'</option>');    
                                            }); 

                                        }
                                        });
                                    }
                                    else
                                    {
                                        $.ajax({
                                        url: 'https://api.spoonacular.com/recipes/complexSearch?apiKey='+FOOD_API_KEY+'&query='+food+'&number=50',
                                         success:function(responsedata){
                                               // process on data
                                              var res = responsedata.results;
                                              $.each(res, function(key,val) {             
                                                   $('#food_type_search').append('<option data-val="'+val.id+'" value="'+val.title+'">'+val.title+'</option>');    
                                            }); 

                                        }
                                        });
                                    }
                                    
                                    
                                });
                            });
                        </script>
                        <div class="form-group">
                            <label for="nome">Ingredients</label>
                                <textarea id="ingredients" name="ingredients" class="form-control" minlength="4" placeholder="Ingredients" required="" value=""></textarea>
                        </div>
                        
                        <script type="text/javascript">
                            var FOOD_API_KEY = '{{ env('FOOD_API_KEY') }}';
                            var DRINK_API_KEY = '{{ env('DRINK_API_KEY') }}';
                            
                          $(function () {
                                $('#food_type_search').on('change', function () {
                                    $('#ingredients').val('');
                                    var choice = $('input[name="food_or_drink"]:checked').val();
                            
                                    var food = $(this).find(':selected').attr('data-val')
                                    if(food!='' && food!='undefined')
                                    {
                                       var alldata='';
                                       if(choice==2)
                                       {
                                            $.ajax({
                                                url: 'https://api.nal.usda.gov/fdc/v1/food/'+food+'?api_key='+DRINK_API_KEY+'',
                                                success:function(responsedata){
                                                    // process on data
                                                    var res = responsedata.inputFoods;
                                                    
                                                    $('#ingredients').val('');
                                                    if(res=='' || res=='undefined' || res==undefined)
                                                    {
                                                        $('#ingredients').val(responsedata.description);
                                                    }
                                                    else{
                                                        var count =  res.length;
                                                        var limit=1;
                                                        $.each(res, function(key,val) 
                                                        {             
                                                            if(limit==count)
                                                            {
                                                                var data = val.ingredientDescription;
                                                            }
                                                            else
                                                            {
                                                                var data = val.ingredientDescription+', ';
                                                            }
                                                            alldata += data; 
                                                            $('#ingredients').val(alldata);
                                                            limit++;
                                                                
                                                        }); 
                                                    }
                                                   

                                                }
                                            }); 
                                            
                                       }
                                       else{
                                            $.ajax({
                                                url: 'https://api.spoonacular.com/recipes/'+food+'/information?apiKey='+FOOD_API_KEY+'',
                                                success:function(responsedata){
                                                    // process on data
                                                    var res = responsedata.extendedIngredients;
                                                    var count =  res.length;
                                                    var limit=1;
                                                    $.each(res, function(key,val) 
                                                    {             
                                                        
                                                        if(limit==count)
                                                        {
                                                        var data = val.name;
                                                        }
                                                        else
                                                        {
                                                        var data = val.name+', ';
                                                        }
                                                        alldata += data; 
                                                            $('#ingredients').val('');
                                                        $('#ingredients').val(alldata);
                                                        limit++;
                                                            
                                                    }); 

                                                }
                                            }); 
                                            
                                       }

                                    }
                                    
                                });
                            });
                        </script>
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