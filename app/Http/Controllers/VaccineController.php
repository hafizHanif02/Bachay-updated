<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Models\Growth;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentArticleCategory;
use App\Models\VaccinationSubmission;


class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $vaccines = Vaccination::where('name', 'like', '%' . $request->search . '%')->get();
        } else {
            $vaccines = Vaccination::get();
        }
        return view('admin-views.vaccine.list', compact('vaccines'));
    }
    public function Vaccination_home()
    {
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        if(Auth::guard('customer')->check()){
            $user =  Auth::guard('customer')->user();
            $childerens = DB::table('family_relation')->where('user_id', Auth::guard('customer')->id())->get();
            // foreach($childerens as $child){
            //     if($child->profile_picture != null){
            //         $childImageUrl = url('public/assets/images/customers/child/' . $child->profile_picture);
            //         $child->avatar = $childImageUrl;
            //     }
            // }



            foreach ($childerens as $child) {
                if ($child->profile_picture != null) {
                    $childImageUrl = url('public/assets/images/customers/child/' . $child->profile_picture);
                    $child->avatar = $childImageUrl;

                    // Calculate age based on 'dob'
                    $dob = new DateTime($child->dob);
                    $now = new DateTime();
                    $ageInterval = $dob->diff($now);

                    // Format age as text
                    $ageText = '';

                    if ($ageInterval->y > 0) {
                        $ageText .= $ageInterval->y . ' Year ';
                    }
                    if ($ageInterval->m > 0) {
                        $ageText .= $ageInterval->m . ' Mon ';
                    }
                    if ($ageText == '' && $ageInterval->d > 0) {
                        $ageText .= $ageInterval->d . ' days ';
                    }

                    $child->format_age = trim($ageText). ' Old';
                }

                $growth = Growth::where('child_id',$child->id)->first();

                $child->growth = $growth;

            }

            $overdueCounts = [];
            foreach ($childerens as $child) {
                $countUpcoming = 0;
                $vaccination_submissions = VaccinationSubmission::
                    where([
                        'child_id' => $child->id,
                        'user_id' => Auth::guard('customer')->id(),
                        'is_taken' => 0
                    ])->with('vaccination')->get();

                $vaccination_submission_completed = VaccinationSubmission::
                where([
                    'child_id' => $child->id,
                    'user_id' => Auth::guard('customer')->id(),
                    'is_taken' => 1
                ])->with('vaccination')->get();

                //$child->vaccination = $vaccination_submissions;
                $overdue = 0;
                $uppcoming = 0;
                $today = 0;
                $uppcomingVaccine = [];
                foreach ($vaccination_submissions as $vaccination_submission) {
                    $vaccinationDate = Carbon::parse($vaccination_submission->vaccination_date);
                    $currentDate = Carbon::now();
                    $difference = ($vaccinationDate->diffInDays($currentDate->format('Y-m-d')));
                    //array_push($uppcomingVaccine, $difference);
                    if($vaccinationDate > $currentDate){
                        $uppcoming += 1;
                        //$uppcomingVaccine = $vaccination_submission->vaccination;
                        if($countUpcoming < 2){
                            array_push($uppcomingVaccine, $vaccination_submission);
                            $countUpcoming++;
                        }

                    }elseif($vaccinationDate < $currentDate){
                        $overdue += 1;
                    } else{
                        $today += 1;
                    }

                    // if ($difference < 0) {
                    //     $overdue += 1;
                    // } elseif ($difference > 0) {
                    //     $uppcoming += 1;
                    //     //$uppcomingVaccine = $vaccination_submission->vaccination;
                    //     array_push($uppcomingVaccine, $vaccination_submission->vaccination);
                    // } elseif ($difference == 0 && $vaccinationDate->isSameDay(now())) {
                    //     $today += 1;
                    // }
                }
                $child->vaccination_status = ['upcomming' => $uppcoming,'today' =>  $today,'overdue' =>   $overdue,'completed' => count($vaccination_submission_completed)];
                $child->uppcomingVaccine = $uppcomingVaccine;

            }
            return view('theme-views.vaccination.vaccination', compact(['parent_article_categories','childerens']));
        }else{
            Toastr::error('Please Login First !');
            return redirect()->route('customer.auth.login');
            
        }
       
        
    }
    public function view_sample_cart()
    {
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        return view('theme-views.vaccination-growth.view_sample_cart', compact('parent_article_categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'disease' => 'required|string',
            'protest_against' => 'required|string',
            'to_be_give' => 'required|string',
            'how' => 'required|string',
        ]);

        Vaccination::create([
            'name' => $request->name,
            'age' => $request->age,
            'disease' => $request->disease,
            'protest_against' => $request->protest_against,
            'to_be_give' => $request->to_be_give,
            'how' => $request->how,
        ]);
        Toastr::success('Vaccine Added');
        return back();
    }


    public function VaccineSubmissionCreate($id)
    {
        return $id;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vaccine = Vaccination::find($id);
        return view('admin-views.vaccine.edit', compact('vaccine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'disease' => 'required|string',
            'protest_against' => 'required|string',
            'to_be_give' => 'required|string',
            'how' => 'required|string',
        ]);

        Vaccination::where('id', $request->id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'disease' => $request->disease,
            'protest_against' => $request->protest_against,
            'to_be_give' => $request->to_be_give,
            'how' => $request->how,
        ]);
        Toastr::success('Vaccine Updated');
        return redirect()->route('admin.customer.vaccine.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $vaccine = Vaccination::find($request->id);
        $vaccine->delete();
        Toastr::success('Vaccine Deleted');
        return redirect()->back();
    }
}
