<?php 

namespace App\Http\Controllers\Issue; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Models\ProblemType;
use App\Models\ProblemLevel;
use App\Models\HealthIssue;



class IssueController extends Controller 
{ 
	public function __construct() 
	{ 
		$this->middleware("auth");
	} 

	public function index() 
	{ 
        $userId = Auth::id();
        $problemTypes = ProblemType::all();
        $problemLevels = ProblemLevel::all();
       
		return view('issue.index',compact('problemTypes','problemLevels'));
	}
    public function saveHealthIssueDetails(Request $request)
    { 
        $this->validate($request, [
            'problem_type' => 'required',
            'problem_level' => 'required',
            'time' => 'required',
        ]);
        $userId = Auth::id();
        $healthIssue = new HealthIssue;
        $healthIssue->user_id = $userId;
        $healthIssue->problem_type_id = $request->input('problem_type');
        $healthIssue->problem_level_id = $request->input('problem_level');
        $healthIssue->time = $request->input('time');
        $healthIssue->save();

        return redirect()->route('healthIssueListing');
    }
    public function healthIssueListing()
    { 
        $userId = Auth::id();
        $issueList = HealthIssue::with('problem_type','problem_level')
        ->where('user_id',$userId)->paginate(15);
        return view('issue.list', compact('issueList'));
    }
    public function destroy($id)
    {

        $healthIssue = HealthIssue::find($id);

        if(!$healthIssue){
            $this->flashMessage('warning', 'Item not found!', 'danger');            
            return redirect()->route('healthIssueListing');
        }

        $healthIssue->delete();

        $this->flashMessage('check', 'Item successfully deleted!', 'success');

        return redirect()->route('healthIssueListing');
    }

	
}