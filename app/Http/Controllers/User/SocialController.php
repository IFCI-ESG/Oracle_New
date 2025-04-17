<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialQuestionMaster;
use App\Models\SocialQuestionValue;
use App\Models\SocialMast;
use App\Models\User;
use App\Models\DocumentUploads;
use App\Models\DocumentMaster;
use Auth;
use DB;
use Carbon\Carbon;


class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $quesMast = SocialQuestionMaster::where('status', 1)->orderby('id')->get();
        $social_value = SocialQuestionValue::where('com_id', $user->id)->orderby('id')->get();
        // dd($quesMast);

        $fys = DB::table('fy_masters')->orderby('id','desc')->get();

        $social_mast = SocialMast::where('com_id', $user->id)->orderby('id')->get();
        // dd($social_mast);

        return view('user.social.index', compact('quesMast','user','fys','social_mast','social_value'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fy_id)
    {
        $fy_id = decrypt($fy_id);
        $user = Auth::user();

        $social_mast = SocialMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new SocialMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
        $sdgMast = DB::table('sdg_master')->where('status', 1)->get();

        $quesMast = SocialQuestionMaster::where('status', 1)->orderby('id')->get();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        return view('user.social.create', compact('quesMast','user','fys','fy_id','sdgMast','social_mast'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // try {
            $doctypes = DocumentMaster::where('doc_type', 'Welfare_doc')->pluck('doc_type', 'doc_id')->toArray();
	     $social_mast = SocialMast::where('com_id',$request->com_id)->where('fy_id',$request->fy_id)->first();

            DB::transaction(function () use ($request,$doctypes,$social_mast)
            {


                foreach ($request->emp as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->emp_male = isset($val['emp_male']) ? $val['emp_male'] : null;
                    $social_data->emp_female = isset($val['emp_female']) ? $val['emp_female'] : null;
                    $social_data->emp_others = isset($val['emp_others']) ? $val['emp_others'] : null;
                    $social_data->save();
                }

                foreach ($request->women as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->women_tot_emp = isset($val['women_tot_emp']) ? $val['women_tot_emp'] : null;
                    $social_data->women_tot_female_emp = isset($val['women_tot_female_emp']) ? $val['women_tot_female_emp'] : null;
                    $social_data->save();
                }

                foreach ($request->cost_incurr as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->cost_incurred = isset($val['cost_incurred']) ? $val['cost_incurred'] : null;
                    $social_data->tot_revenue = isset($val['tot_revenue']) ? $val['tot_revenue'] : null;
                    $social_data->save();
                }

                foreach ($request->csr as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->csr_details = isset($val['csr_details']) ? $val['csr_details'] : null;
                    $social_data->save();
                }

                foreach ($request->csr_acti as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->csr_activity = isset($val['csr_activity']) ? $val['csr_activity'] : null;
                    // $social_data->sdg_id = isset($val['sdg_id']) ? $val['sdg_id'] : null;
                    $social_data->save();
                }

                foreach ($request->csr_impact as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->csr_impact = $request->impact;
                    $social_data->csr_male = isset($val['csr_male']) ? $val['csr_male'] : null;
                    $social_data->csr_female = isset($val['csr_female']) ? $val['csr_female'] : null;
                    $social_data->save();
                }

                foreach ($request->train as $val) {
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->train_tot_emp = isset($val['train_tot_emp']) ? $val['train_tot_emp'] : null;
                    $social_data->train_amt_spent = isset($val['train_amt_spent']) ? $val['train_amt_spent'] : null;
                    $social_data->save();
                }

                // Document Upload Section

                foreach ($request->welfare as $val) {
                    foreach ($doctypes as $docid => $doctype) {
                        if (isset($val['Welfare_doc'])) {
                            $newDoc = $val['Welfare_doc'];
                            $doc = new DocumentUploads;
                            $doc->doc_id = $docid;
                            $doc->mime = $newDoc->getMimeType();
                            $doc->file_size = $newDoc->getSize();
                            $doc->updated_at = Carbon::now();
                            $doc->user_id = $request->com_id;
                            $doc->created_at = Carbon::now();
                            $doc->file_name = $newDoc->getClientOriginalName();
                            $doc->uploaded_file = fopen($newDoc->getRealPath(), 'r');
                            $doc->remarks = '';
                            $doc->save();
                        }
                    }
                    $social_data = new SocialQuestionValue;
                    $social_data->com_id = $request->com_id;
                    $social_data->social_mast_id = $social_mast->id;
                    $social_data->fy_id = $request->fy_id;
                    $social_data->ques_id = $val['ques_id'];
                    $social_data->emp_welfare_remark = isset($val['emp_welfare_remark']) ? $val['emp_welfare_remark'] : null;
                    $social_data->emp_welfare_doc_id = isset($doc->id) ? $doc->id : null;
                    $social_data->save();
                }

            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->route('user.social.edit',encrypt($social_mast->id));
            // return redirect()->route('user.addquestionnaire');
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        // dd($id);
        $social_mast = SocialMast::where('id', $id)->first();
        $social_value = SocialQuestionValue::where('social_mast_id', $id)->get();
        $quesMast = SocialQuestionMaster::where('status', 1)->orderby('id')->get();
        $fys = DB::table('fy_masters')->where('id',$social_mast->fy_id)->first();
        $sdgMast = DB::table('sdg_master')->where('status', 1)->get();

        // dd($quesMast,$social_value);
        return view('user.social.edit', compact('quesMast','social_value','fys','sdgMast'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        // try{
            $doctypes = DocumentMaster::where('doc_type', 'Welfare_doc')->pluck('doc_type', 'doc_id')->toArray();

            DB::transaction(function () use ($request, $doctypes)
            {
                foreach ($request->emp as $val) {
                    // dd($val );
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->emp_male = isset($val['emp_male']) ? $val['emp_male'] : null;
                        $social_data->emp_female = isset($val['emp_female']) ? $val['emp_female'] : null;
                        $social_data->emp_others = isset($val['emp_others']) ? $val['emp_others'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                foreach ($request->women as $val) {
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->women_tot_emp = isset($val['women_tot_emp']) ? $val['women_tot_emp'] : null;
                        $social_data->women_tot_female_emp = isset($val['women_tot_female_emp']) ? $val['women_tot_female_emp'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                foreach ($request->cost_incurr as $val) {
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->cost_incurred = isset($val['cost_incurred']) ? $val['cost_incurred'] : null;
                        $social_data->tot_revenue = isset($val['tot_revenue']) ? $val['tot_revenue'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                foreach ($request->csr as $val) {
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->csr_details = isset($val['csr_details']) ? $val['csr_details'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                foreach ($request->csr_acti as $val) {
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->csr_activity = isset($val['csr_activity']) ? $val['csr_activity'] : null;
                        // $social_data->sdg_id = isset($val['sdg_id']) ? $val['sdg_id'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                foreach ($request->csr_impact as $val) {
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->csr_impact = $request->impact;
                        $social_data->csr_male = isset($val['csr_male']) ? $val['csr_male'] : null;
                        $social_data->csr_female = isset($val['csr_female']) ? $val['csr_female'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                foreach ($request->train as $val) {
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->train_tot_emp = isset($val['train_tot_emp']) ? $val['train_tot_emp'] : null;
                        $social_data->train_amt_spent = isset($val['train_amt_spent']) ? $val['train_amt_spent'] : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

                // Document Upload Section

                foreach ($request->welfare as $val) {
                    if (isset($val['Welfare_doc'])) {
                        foreach ($doctypes as $docid => $doctype) {
                            $newDoc = $val['Welfare_doc'];
                            $doc = DocumentUploads::where('id', $request->Welfare_doc_id)->first();
                                $doc->mime = $newDoc->getMimeType();
                                $doc->file_size = $newDoc->getSize();
                                $doc->updated_at = Carbon::now();
                                $doc->file_name = $newDoc->getClientOriginalName();
                                $doc->uploaded_file = fopen($newDoc->getRealPath(), 'r');
                            $doc->save();
                        }
                    }
                    $social_data = SocialQuestionValue::find($val['row_id']);
                        $social_data->emp_welfare_remark = isset($val['emp_welfare_remark']) ? $val['emp_welfare_remark'] : null;
                        $social_data->emp_welfare_doc_id = isset($doc->id) ? $doc->id : null;
                        $social_data->updated_at = Carbon::now();
                    $social_data->save();
                }

            });

            alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
            return redirect()->back();
        // }catch (\Exception $e)
        // {
        //     alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     return redirect()->back();
        // }

    }

    public function downloadFile($id)
    {
        $doc =  DB::table('document_uploads')
        ->where('id',$id)
        // ->select('mime','file_name','uploaded_file')
        ->first();
        ob_start();
        fpassthru($doc->uploaded_file);
        $docc= ob_get_contents();
        ob_end_clean();
        // $ext = '';
        // if ($doc->mime == "application/pdf") {
        //     $ext = 'pdf';
        // } elseif ($doc->mime == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
        //     $ext = 'docx';
        // } elseif ($doc->mime == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
        //     $ext = 'xlsx';
        // } elseif ($doc->mime == "image/png") {
        //     $ext = 'png';
        // } elseif ($doc->mime == "image/jpeg") {
        //     $ext = 'jpg';
        // }

        return response($docc)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $doc->mime)
        ->header('Content-length', strlen($docc))
        ->header('Content-Disposition', 'attachment; filename='.$doc->file_name)
        ->header('Content-Transfer-Encoding', 'binary');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


