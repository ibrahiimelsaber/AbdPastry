<?php

namespace App\Http\Controllers\Account\All\Surveys;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\EedSurvey;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{

    public function index($id)
    {

        $surveys = Survey::with('account','callStatus')->where('AccountId', '=', $id)->orderBy('CreatedOn', 'desc')->paginate(20);

        return view('accounts.all.surveys.norm-surveys.index')
            ->with('surveys', $surveys)
            ->with('account', $id)
            ->with('total', $surveys->total())
            ->with('indexUrl', route('all.account.surveys.index', $id));
    }
    public function all()
    {

        $surveys = Survey::with('account','callStatus')->orderBy('CreatedOn', 'desc')->paginate(20);

        return view('surveys.all.norm-surveys.index')
            ->with('surveys', $surveys)
            ->with('total', $surveys->total())
            ->with('indexUrl', route('all.surveys.index'));
    }


    public function create($id)
    {
        $account = Account::with('Type')->where('Id', $id)->first();

        $status = DB::table('picklists')
            ->where('Type', '=', 'EidCallStatus')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $mainQuestion = DB::table('picklists')
            ->where('Type', '=', 'MainQ')->pluck('name', 'id');


        $NormQ1 = DB::table('picklists')
            ->where('Type', '=', 'norm_q1_id')->pluck('name', 'id');
        $NormQ2 = DB::table('picklists')
            ->where('Type', '=', 'norm_q2_id')->pluck('name', 'id');
        $NormQ3 = DB::table('picklists')
            ->where('Type', '=', 'norm_q3_id')->pluck('name', 'id');
        $NormQ4 = DB::table('picklists')
            ->where('Type', '=', 'norm_q4_id')->pluck('name', 'id');
        $NormQ5 = DB::table('picklists')
            ->where('Type', '=', 'norm_q5_id')->pluck('name', 'id');
        $NormQ6 = DB::table('picklists')
            ->where('Type', '=', 'norm_q6_id')->pluck('name', 'id');


        return view('accounts.all.surveys.norm-surveys.create')
            ->with('mainQuestion', $mainQuestion)
            ->with('NormQ1', $NormQ1)
            ->with('NormQ2', $NormQ2)
            ->with('NormQ3', $NormQ3)
            ->with('NormQ4', $NormQ4)
            ->with('NormQ5', $NormQ5)
            ->with('NormQ6', $NormQ6)
            ->with('status', $status)
            ->with('account', $account);
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $rules = [
                'normCallStatusId' => 'required',
                'norm_mainQ' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('Norm_survey')->insert(
                [
                    'AccountId' => $request->AccountId,
                    'normCallStatusId' => $request->EidCallStatusId,
                    'norm_mainQ' => $request->norm_mainQ ?? 0,
                    'norm_q1ID' => $request->norm_q1ID ?? 0,
                    'norm_q3ID' => $request->norm_q3ID ?? 0,
                    'norm_q4ID' => $request->norm_q4ID ?? 0,
                    'norm_q5ID' => $request->norm_q5ID ?? 0,
                    'norm_q6ID' => $request->norm_q6ID ?? 0,
                    'norm_mainQ_comment' => $request->norm_mainQ_comment ?? '-',
                    'norm_q1_comment' => $request->norm_q1_comment ?? '-',
                    'norm_q3_comment' => $request->norm_q3_comment ?? '-',
                    'norm_q4_comment' => $request->norm_q4_comment ?? '-',
                    'norm_q5_comment' => $request->norm_q5_comment ?? '-',
                    'norm_q6_comment' => $request->norm_q6_comment ?? '-',
                    'Active' => 1,
                    'CreatedBy' => \session('userName'),
                    'CreatedOn' => now()
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Survey is created successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('Creation field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
        }

    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
