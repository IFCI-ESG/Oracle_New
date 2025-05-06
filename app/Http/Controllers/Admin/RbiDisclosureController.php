<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AdminUser;
use App\Models\BankFinancialDetails;
use App\Models\RbiPillarValue;
use App\Models\RbiDisclosureMast;
use Validator;
use Illuminate\Support\Facades\File;
use SimpleXMLElement;
use Barryvdh\DomPDF\Facade\Pdf;


class RbiDisclosureController extends Controller
{

    public function index()
    {
        // dd('d');

        $fys = DB::table('fy_masters')->orderby('id','desc')->get();

        $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->orderby('id')->get();
        // dd($rbi_mast);

        // $pillar_mast = DB::table('rbi_pillar_master as pm')->where('status',1)->orderby('id')->get();
        // $pillar_ques = DB::table('rbi_pillar_ques_master as pqm')->where('status',1)->orderby('id')->get();
        $pillar_val = DB::table('rbi_pillar_value as rpv')
                            ->join('rbi_pillar_ques_master as rpqm','rpqm.id','rpv.ques_id')
                            ->where('bank_id',Auth::user()->id)
                            ->orderby('rpqm.id')
                            ->get(['rpv.*','rpqm.pillar_id']);

        // $pillar_val =  RbiPillarValue::where('com_id',Auth::user()->id)->get();
        // dd($pillar_mast,$pillar_ques, $pillar_val );

        return view('admin.rbi_disclosure.index', compact('rbi_mast','fys','pillar_val'));

    }

    public function pillar($fy_id)
    {
        $fy_id = decrypt($fy_id);

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id', $fy_id)->first();
            // dd($rbi_mast);
        $pillar_mast = DB::table('rbi_pillar_master as pm')->where('status',1)->orderby('id')->get();
        $pillar_ques = DB::table('rbi_pillar_ques_master as pqm')->where('status',1)->orderby('id')->get();
        $pillar_val = DB::table('rbi_pillar_value as rpv')
                            ->join('rbi_pillar_ques_master as rpqm','rpqm.id','rpv.ques_id')
                            ->where('bank_id',Auth::user()->id)
                            ->orderby('rpqm.id')
                            ->get(['rpv.*','rpqm.pillar_id']);

        return view('admin.rbi_disclosure.pillar', compact('pillar_mast','pillar_ques','pillar_val','fys','rbi_mast'));

    }

    public function create($pillar_id,$fy_id)
    {
        $pillar_id = decrypt($pillar_id);
        $fy_id = decrypt($fy_id);
        // dd($pillar_id,$fy_id);

        $user = Auth::user();

        $pillar_ques = DB::table('rbi_pillar_ques_master as pqm')
                                ->join('rbi_pillar_master as pm','pm.id','pqm.pillar_id')
                                ->where('pqm.pillar_id',$pillar_id)
                                ->where('pqm.status',1)
                                ->orderby('pqm.id')
                                ->get(['pqm.*','pm.name as pillar_name']);

        // dd($pillar_ques);

        return view('admin.rbi_disclosure.create', compact('pillar_ques','user','fy_id'));

    }


    public function store(Request $request)
    {
        // dd($request,$request->fy_id);
        // try {
            $rbi = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id',$request->fy_id)->first();
            DB::transaction(function () use ($request,$rbi)
            {
                if(!$rbi){
                    $rbi = new RbiDisclosureMast;
                        $rbi->bank_id = Auth::user()->id;
                        $rbi->status = 'D';
                        $rbi->fy_id = $request->fy_id;
                    $rbi->save();
                }

                // dd($rbi);

                foreach ($request->part as $value) {
                    if(isset($value['option']) || isset($value['value']))
                    {
                        $data = new RbiPillarValue;
                            $data->rbi_mast_id = $rbi->id ;
                            $data->bank_id = Auth::user()->id ;
                            $data->ques_id = isset($value['ques_id']) ? $value['ques_id'] : null ;
                            $data->option = isset($value['option']) ? $value['option'] : Null ;
                            $data->value = isset($value['value']) ? $value['value'] : null ;
                        $data->save();
                    }
                }
            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            // return redirect()->back();
            return redirect()->route('admin.rbi_disclosure.edit',['bank_id' => encrypt(Auth::user()->id) ,'pillar_id' => encrypt($request->pillar_id), 'fy_id' => encrypt($request->fy_id)]);
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     // errorMail($e, $request->id, Auth::user()->id);
        //     return redirect()->back();
        // }
    }

    public function edit($bank_id,$pillar_id,$fy_id)
    {
        $bank_id = decrypt($bank_id);
        $pillar_id = decrypt($pillar_id);
        $fy_id = decrypt($fy_id);
        $pillar_val = DB::table('rbi_pillar_ques_master as rpqm')
                            ->leftJoin('rbi_pillar_value as rpv', function($join) use ($bank_id) {
                                $join->on('rpqm.id', '=', 'rpv.ques_id')
                                    ->where('rpv.bank_id', '=', $bank_id); // Ensures filtering only for a specific company
                            })
                            ->join('rbi_pillar_master as rpm', 'rpm.id', '=', 'rpqm.pillar_id')
                            ->join('rbi_disclosure_mast as rdm', 'rdm.id', '=', 'rpv.rbi_mast_id')
                            ->where('rpqm.pillar_id', $pillar_id)
                            ->where('rdm.fy_id', $fy_id)
                            ->orderby('rpqm.id')
                            ->get([
                                'rpv.*', 
                                'rpqm.types_of_disclosure', 
                                'rpqm.ques',
                                'rpqm.id as ques_id', 
                                'rpm.name as pillar_name', 
                                'rpqm.data_type'
                            ]);

        return view('admin.rbi_disclosure.edit', compact('pillar_val','fy_id','pillar_id'));
    }


    public function update(Request $request)
    {
        // dd($request);
        // try{

            DB::transaction(function () use ($request)
            {
                $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id',$request->fy_id)->first();

                foreach ($request->part as $val) {
                    if(isset($val['row_id']))
                    {
                        // dd($request,'f');
                        $data = RbiPillarValue::find($val['row_id']);
                            $data->option = isset($val['option']) ? $val['option'] : Null ;
                            $data->value = isset($val['value']) ? ((isset($val['option']) ? ($val['option'] == 'N' ? null : $val['value']) : $val['value'] )) : null;
                            $data->updated_at = Carbon::now();
                        $data->save();
                    }
                    else
                    {
                        if(isset($val['option']) || isset($val['value']))
                        {
                            $data = new RbiPillarValue;
                                $data->rbi_mast_id = $rbi_mast->id ;
                                $data->bank_id = Auth::user()->id ;
                                $data->ques_id = isset($val['ques_id']) ? $val['ques_id'] : null ;
                                $data->option = isset($val['option']) ? $val['option'] : Null ;
                                $data->value = isset($val['value']) ? $val['value'] : null ;
                            $data->save();
                        }
                    }
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



    public function submit(Request $request)
    {
        // dd($request);
            $user=Auth::user();
        try{

            if(!$request->undertaking)
            {
                alert()->warning('Please Check Undertaking', 'Warning')->persistent('Close');
                return redirect()->back();
            }
// dd($request->undertaking,"d");
            DB::transaction(function () use ($request, $user)
            {
                $input_mast = InputSheetMast::where('id', $request->input_id)->first();
                    $input_mast->status = 'S';
                    $input_mast->is_checked = isset($request->undertaking) ? 1 : 0;
                    $input_mast->submitted_at = Carbon::now();
                $input_mast->save();
            });
            alert()->Success('Input Sheet Submitted Successfully', 'Success')->persistent('Close');
            return redirect()->route('admin.fy');    


        }catch (\Exception $e)
        {
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }

    public function view($bank_id,$pillar_id,$fy_id)
    {
        $bank_id = decrypt($bank_id);
        $pillar_id = decrypt($pillar_id);
        $fy_id = decrypt($fy_id);
        $pillar_val = DB::table('rbi_pillar_ques_master as rpqm')
                            ->leftJoin('rbi_pillar_value as rpv', function($join) use ($bank_id) {
                                $join->on('rpqm.id', '=', 'rpv.ques_id')
                                    ->where('rpv.bank_id', '=', $bank_id); // Ensures filtering only for a specific company
                            })
                            ->join('rbi_pillar_master as rpm', 'rpm.id', '=', 'rpqm.pillar_id')
                            ->where('rpqm.pillar_id', $pillar_id)
                            ->orderby('rpqm.id')
                            ->get([
                                'rpv.*', 
                                'rpqm.types_of_disclosure', 
                                'rpqm.ques',
                                'rpqm.id as ques_id', 
                                'rpm.name as pillar_name', 
                                'rpqm.data_type'
                            ]);

        return view('admin.rbi_disclosure.view', compact('pillar_val','fy_id','pillar_id'));
    }

   public function generatePdf($fy_id)
    {
        $fy_id = decrypt($fy_id);

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

       // $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id', $fy_id)->first();

        $pillar_val = DB::table('rbi_pillar_ques_master as rpqm')
                            ->leftJoin('rbi_pillar_value as rpv', function($join)  {
                                $join->on('rpqm.id', '=', 'rpv.ques_id')
                                    ->where('rpv.bank_id', '=', Auth::user()->id);
                            })
                            ->join('rbi_pillar_master as rpm', 'rpm.id', '=', 'rpqm.pillar_id')
                            ->join('rbi_disclosure_mast as rdm', 'rdm.id', '=', 'rpv.rbi_mast_id')
                            ->where('rdm.fy_id', $fy_id)
                            ->orderby('rpqm.id')
                            ->get([
                                'rpv.*', 
                                'rpqm.types_of_disclosure', 
                                'rpqm.ques',
                                'rpqm.id as ques_id', 
                                'rpm.name as pillar_name', 
                                'rpqm.data_type'
                            ]);


$output = [];

foreach ($pillar_val as $item) {
    $pillar = $item->pillar_name;
    $disclosure = $item->types_of_disclosure;

    if (!isset($output[$pillar])) {
        $output[$pillar] = [];
    }

    if (!isset($output[$pillar][$disclosure])) {
        $output[$pillar][$disclosure] = [];
    }

    $output[$pillar][$disclosure][] = $item;
}

// dd($output);
 // return view('admin.rbi_disclosure.rbi_disclouser_pdf', compact('output','fys'));
$data=['output'=>$output,'fys'=>$fys];
    $pdf = Pdf::loadView('admin.rbi_disclosure.rbi_disclouser_pdf', $data);

    return $pdf->download('rbi_disclosure.pdf');
      

    }


}


