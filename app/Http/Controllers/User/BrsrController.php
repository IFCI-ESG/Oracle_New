<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrsrSectionAQuestionMaster;
use App\Models\BrsrSectionBQuestionMaster;
use App\Models\BrsrMast;
use App\Models\BrsrQuestionValue;
use App\Models\BrsrSectionAProdServQuestionValue;
use App\Models\BrsrSectionAOperationQuestionValue;
use App\Models\BrsrSectionATurnoverQuestionValue;
use App\Models\BrsrSectionAHoldingQuestionValue;
use App\Models\BrsrSectionACompliaceQuestionValue;
use App\Models\BrsrSectionAMaterialQuestionValue;
use App\Models\BrsrSectionBPolicyQuestionValue;
use App\Models\BrsrSectionBGovernanceQuestionValue;
use App\Models\BrsrSectionBNgrbcQuestionValue;
use App\Models\BrsrSectionP1QuestionMaster;
use App\Models\BrsrSectionCP1QuestionValue;
use App\Models\BrsrSectionCP1AwarenessQuestionValue;
use App\Models\BrsrSectionCP1CaseQuestionValue;
use App\Models\BrsrSectionP2QuestionMaster;
use App\Models\BrsrSectionP2QuestionValue;
use App\Models\BrsrSectionP2OthersQuestionValue;
use App\Models\BrsrSectionP4QuestionMaster;
use App\Models\BrsrSectionP4QuestionValue;
use App\Models\BrsrSectionP4AdditionalQuestionValue;
use App\Models\BrsrSectionP7QuestionValue;
use App\Models\BrsrSectionP8QuestionMaster;
use App\Models\BrsrSectionP8QuestionValue;
use App\Models\BrsrSectionP8AdditionalQuestionValue;
use App\Models\BrsrSectionP9QuestionMaster;
use App\Models\BrsrSectionP9QuestionValue;
use Illuminate\Support\Facades\Http;
use Auth;
use DB;
use Carbon\Carbon;
use Log;
ini_set('max_execution_time', 300);

class BrsrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
      
        $brsr_value = BrsrQuestionValue::where('com_id', $user->id)->orderby('id')->limit(1)->get();
        $brsr_sectionb = BrsrSectionBPolicyQuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $brsr_sectionp1 =  BrsrSectionCP1QuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $brsr_sectionp2 =  BrsrSectionP2QuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $brsr_sectionp4 =  BrsrSectionP4QuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $brsr_sectionp7 =  BrsrSectionP7QuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $brsr_sectionp8 =  BrsrSectionP8QuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $brsr_sectionp9 =  BrsrSectionP9QuestionValue::where('com_id', $user->id)->limit(1)->orderby('id')->get();
        $fys = DB::table('fy_masters')->orderBy('id', 'desc')->limit(1)->get();
        return view('user.brsr.index', compact('brsr_sectionp1','brsr_sectionb','fys','brsr_value','brsr_sectionp2','brsr_sectionp4','brsr_sectionp7','brsr_sectionp8','brsr_sectionp9'));
    }

    public function create($fy_id) {
       
        $fy_id = decrypt($fy_id);
       
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $quesMast = BrsrSectionAQuestionMaster::where('status', 1)->orderby('id')->get();
        $employees_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Employment')->orderby('id')->get();
        $participation_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Participation')->orderby('id')->get();
        $turnover_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Turnover')->orderby('id')->get();
        $compliance_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Compliace')->orderby('id')->get(); 
        
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $prior_previous_fy = ($startYear - 2) . '-' . substr($startYear - 1, 2, 2);
      
        $previous_year = substr($fys->fy, 0, 4);
        $prior_previous_year = substr($previous_fy, 0, 4);
       
        $postData = [
                'cin' => Auth::user()->cin_llpin,
                'year' => $previous_year,
                'Section' => 'GN',
                'Question' => 'E20',
                'BRSR_ID' => 'X1'
            ];
        
            $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
                ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $postData);
        
            $previous_turnover_male = '0%'; 
            if ($response->successful()) {
                $data = $response->json();
                $values = data_get($data, 'data.L1');
                if (is_array($values) && count($values)) {
                    $firstVal = reset($values);  
                    $previous_turnover_male = number_format(floatval($firstVal) * 100, 2) . '%';
                }
            }

        $postData1 = [
            'cin' => Auth::user()->cin_llpin,
            'year' => $previous_year,
            'Section' => 'GN',
            'Question' => 'E20',
            'BRSR_ID' => 'X17'
        ];
    
        $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
            ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $postData1);
    
        $previous_turnover_male1 = '0%'; 
        if ($response->successful()) {
            $data = $response->json();
            $values = data_get($data, 'data.L1');
            if (is_array($values) && count($values)) {
                $firstVal = reset($values);  
                $previous_turnover_male1 = number_format(floatval($firstVal) * 100, 2) . '%';
            }
        }

        $postData2 = [
            'cin' => Auth::user()->cin_llpin,
            'year' =>  $previous_year,
            'Section' => 'GN',
            'Question' => 'E20',
            'BRSR_ID' => 'X6'
        ];
    
        $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
            ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $postData2);
    
        $previous_turnover_female = '0%'; 
        if ($response->successful()) {
            $data = $response->json();
            $values = data_get($data, 'data.L1');
            if (is_array($values) && count($values)) {
                $firstVal = reset($values);  
                $previous_turnover_female = number_format(floatval($firstVal) * 100, 2) . '%';
            }
        }

        $postData3 = [
            'cin' => Auth::user()->cin_llpin,
            'year' => $previous_year,
            'Section' => 'GN',
            'Question' => 'E20',
            'BRSR_ID' => 'X18'
        ];
    
        $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
            ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $postData3);
    
        $previous_turnover_female1 = '0%'; 
        if ($response->successful()) {
            $data = $response->json();
            $values = data_get($data, 'data.L1');
            if (is_array($values) && count($values)) {
                $firstVal = reset($values);  
                $previous_turnover_female1 = number_format(floatval($firstVal) * 100, 2) . '%';
            }
        }

        $previous_turnover_total = rtrim($previous_turnover_male, '%') + rtrim($previous_turnover_female, '%');
        $previous_turnover_total = $previous_turnover_total . '%';

        $previous_turnover_total1 = rtrim($previous_turnover_male1, '%') + rtrim($previous_turnover_female1, '%');
        $previous_turnover_total1 = $previous_turnover_total1 . '%';

        $prepostData = [
            'cin' => Auth::user()->cin_llpin,
            'year' => $previous_year,
            'Section' => 'GN',
            'Question' => 'E20',
            'BRSR_ID' => 'X9'
        ];
    
        $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
            ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $prepostData);

        $prior_previous_turnover_male = '0%'; 
        if ($response->successful()) {
            $data = $response->json();
            dd($data);
            $values = data_get($data, 'data.L1');
            if (is_array($values) && count($values)) {
                $firstVal = reset($values);  
                $prior_previous_turnover_male = number_format(floatval($firstVal) * 100, 2) . '%';
            }
        }

        $prepostData1 = [
          'cin' => Auth::user()->cin_llpin,
          'year' => $prior_previous_year,
          'Section' => 'GN',
          'Question' => 'E20',
          'BRSR_ID' => 'X21'
        ];

       $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $prepostData1);

       $prior_previous_turnover_male1 = '0%'; 
        if ($response->successful()) {
         $data = $response->json();
         $values = data_get($data, 'data.L1');
         if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $prior_previous_turnover_male1 = number_format(floatval($firstVal) * 100, 2) . '%';
        }
       }

      $prepostData2 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $prior_previous_year,
        'Section' => 'GN',
        'Question' => 'E20',
        'BRSR_ID' => 'X10'
     ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $prepostData2);

     $prior_previous_turnover_female = '0%'; 
     if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $prior_previous_turnover_female = number_format(floatval($firstVal) * 100, 2) . '%';
        }
     }

     $prepostData3 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $prior_previous_year,
        'Section' => 'GN',
        'Question' => 'E20',
        'BRSR_ID' => 'X22'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $prepostData3);

    $prior_previous_turnover_female1 = '0%'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $prior_previous_turnover_female1 = number_format(floatval($firstVal) * 100, 2) . '%';
        }
    }

    $prior_previous_turnover_total = rtrim($prior_previous_turnover_male, '%') + rtrim($prior_previous_turnover_female, '%');
    $prior_previous_turnover_total = $prior_previous_turnover_total . '%';

    $prior_previous_turnover_total1 = rtrim($prior_previous_turnover_male1, '%') + rtrim($prior_previous_turnover_female1, '%');
    $prior_previous_turnover_total1 = $prior_previous_turnover_total1 . '%';

    $transpostData = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X6'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData);

    $previous_fy_no_of_compliants = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants = $firstVal;
        }
    }

    $transpostData1 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X14'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData1);

    $previous_fy_no_of_compliants1 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants1 = $firstVal;
        }
    }
    $transpostData2 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X22'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData2);

    $previous_fy_no_of_compliants2 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants2 = $firstVal;
        }
    }
    $transpostData3 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X30'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData3);

    $previous_fy_no_of_compliants3 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants3 = $firstVal;
        }
    }
    $transpostData4 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X38'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData4);

    $previous_fy_no_of_compliants4 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants4 = $firstVal;
        }
    }
    $transpostData5 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X46'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData5);

    $previous_fy_no_of_compliants5 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants5 = $firstVal;
        }
    }
    
    $previous_fy_no_of_compliants6 = '0'; 

    $transpostData5 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X46'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData5);

    $previous_fy_no_of_compliants5 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_fy_no_of_compliants5 = $firstVal;
        }
    }
    
    $previous_fy_no_of_compliants6 = '0'; 

    $transpostData6 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X7'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData6);

    $previous_pending_compliants = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_pending_compliants = $firstVal;
        }
    }
    
    $transpostData7 = [
        'cin' => Auth::user()->cin_llpin,
        'year' =>  $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X15'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData7);

    $previous_pending_compliants1 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_pending_compliants1 = $firstVal;
        }
    }
    
    $transpostData8 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X23'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData8);

    $previous_pending_compliants2 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_pending_compliants2 = $firstVal;
        }
    }
    
    $transpostData9 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X31'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData9);

    $previous_pending_compliants3 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_pending_compliants3 = $firstVal;
        }
    }
    
   $transpostData10 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X39'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData10);

    $previous_pending_compliants4 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_pending_compliants4 = $firstVal;
        }
    }

    $transpostData11 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X47'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData11);

    $previous_pending_compliants5 = '0'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_pending_compliants5 = $firstVal;
        }
    }
    
    $previous_pending_compliants6 = '0'; 

    $transpostData12 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X8'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData12);

    $previous_remarks = 'NaN'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_remarks = $firstVal;
        }
    }
    
    $transpostData13 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X16'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData13);

    $previous_remarks1 = 'NaN'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_remarks1 = $firstVal;
        }
    }
    
    $transpostData14 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X24'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData14);

    $previous_remarks2 = 'NaN'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_remarks2 = $firstVal;
        }
    }
    
    $transpostData15 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X32'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData15);

    $previous_remarks3 = 'NaN'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_remarks3 = $firstVal;
        }
    }
    
    $transpostData16 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X40'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData16);

    $previous_remarks4 = 'NaN'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_remarks4 = $firstVal;
        }
    }
    
    $transpostData17 = [
        'cin' => Auth::user()->cin_llpin,
        'year' => $previous_year,
        'Section' => 'GN',
        'Question' => 'E23',
        'BRSR_ID' => 'X48'
    ];

    $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
        ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $transpostData17);

    $previous_remarks5 = 'NaN'; 
    if ($response->successful()) {
        $data = $response->json();
        $values = data_get($data, 'data.L1');
        if (is_array($values) && count($values)) {
            $firstVal = reset($values);  
            $previous_remarks5 = $firstVal;
        }
    }
    
    $previous_remarks6 = 'NaN'; 

       return view('user.brsr.sectionAcreate', compact('previous_remarks','previous_remarks1','previous_remarks2','previous_remarks3','previous_remarks4','previous_remarks5','previous_remarks6','previous_fy_no_of_compliants','previous_pending_compliants','previous_pending_compliants1','previous_pending_compliants2',
    'previous_pending_compliants3','previous_pending_compliants4','previous_pending_compliants5','previous_pending_compliants6',
    'previous_fy_no_of_compliants1','previous_fy_no_of_compliants2','previous_fy_no_of_compliants3','previous_fy_no_of_compliants4','previous_fy_no_of_compliants5','previous_fy_no_of_compliants6','current_fy','previous_fy', 'prior_previous_fy','prior_previous_turnover_total','prior_previous_turnover_total1','prior_previous_turnover_female1','prior_previous_turnover_male','prior_previous_turnover_male1','prior_previous_turnover_female','previous_turnover_total','previous_turnover_total1','previous_turnover_female1','previous_turnover_male','previous_turnover_male1','previous_turnover_female', 'quesMast','user','fys','fy_id','employees_quesMast','participation_quesMast','turnover_quesMast','compliance_quesMast'));

    }

    public function sectionBcreate($fy_id) {
       
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $policy_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBPolicy')->orderby('id')->get();
        $entity_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBentity')->orderby('id')->get();
        $ngrbc_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBngrbc')->orderby('id')->get();
        $state_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBstate')->orderby('id')->get();
       
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $prior_previous_fy = ($startYear - 2) . '-' . substr($startYear - 1, 2, 2);
      
        $previous_year = substr($fys->fy, 0, 4);
        $prior_previous_year = substr($previous_fy, 0, 4);
       
        return view('user.brsr.sectionBcreate', compact('state_quesMast','entity_quesMast','ngrbc_quesMast','current_fy','previous_fy', 'prior_previous_fy','user','fys','fy_id','policy_quesMast'));

    }

    public function sectionP1create($fy_id) {
 
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $segment_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_segment')->orderby('id')->get();
        $monetary_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_monetary')->orderby('id')->get();
        $nonmonetary_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_nonmonetary')->orderby('id')->get();
        $para1_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_para1')->orderby('id')->get();
        $directors_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_corruption')->orderby('id')->get();
        $compliants_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_compliants')->orderby('id')->get();
        $para2_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_para2')->orderby('id')->get();
        $accounts_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_accounts')->orderby('id')->get();
        $business_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_purchase')->orderby('id')->get();
        $entity_quesMast =  BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_entityprocess')->orderby('id')->get();
       
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $previous_year = substr($fys->fy, 0, 4);

        // API Integration for P1

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w';
        $cin = Auth::user()->cin_llpin;
        $apiUrl = 'http://13.200.249.135:7000/api/get-all-data-by-cin/';
        $brsrMap = [
            'X2' => 'E5',
            'X4' => 'E5',
            'X6' => 'E5',
            'X8' => 'E5',
 
        ];
        
        $Results = [];
        
        foreach ($brsrMap as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P1',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results[$id] = $values;
        }


        $brsrMap1 = [
            'X4' => 'E6',
            'X5' => 'E6',
            'X6' => 'E6',
            'X8' => 'E6',
        ];
        
        $Results1 = [];
        
        foreach ($brsrMap1 as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P1',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results1[$id] = $values;
        }

        $brsrMap2 = [
            'X6' => 'E8',
        ];
        
        $Results2 = [];
        
        foreach ($brsrMap2 as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P1',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results2[$id] = $values;
        }

        $brsrMap3 = [
            'X2' => 'E9',
            'X8' => 'E9',
            'X14' => 'E9',
            'X20' => 'E9',
            'X22' => 'E9',
            'X28' => 'E9',
            'X34' => 'E9',
            'X40' => 'E9',
            'X46' => 'E9',
            'X48' => 'E9',
        ];
        
        $Results3 = [];
        
        foreach ($brsrMap3 as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P1',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results3[$id] = $values;
        }
        
        $previous_directors = $Results['X2'];
        $previous_kmps = $Results['X4'];
        $previous_employees = $Results['X6'];
        $previous_workers = $Results['X8'];
        $previous_directors_compliants = $Results1['X4'];
        $previous_kmps_compliants = $Results1['X5'];
        $previous_directors_remarks = $Results1['X6'];
        $previous_kmps_remarks = $Results1['X8'];
      
        $prev_accounts = $Results2['X6'];
      
        $prev_house = $Results3['X2'];
        $trading_house = $Results3['X8'];
        $top10_house = $Results3['X14'];
        $prev_dealers = $Results3['X20'];
        $prev_nodealers = $Results3['X22'];
        $prev_topdealers = $Results3['X28'];
        $prev_purchase = $Results3['X34'];
        $prev_sales = $Results3['X40'];
        $prev_loans = $Results3['X46'];
        $prev_investment = $Results3['X48'];

        return view('user.brsr.sectionP1create', compact('social_mast','current_fy','previous_fy','user','fys','fy_id','segment_quesMast','monetary_quesMast',
        'nonmonetary_quesMast','para1_quesMast','directors_quesMast',
        'compliants_quesMast','para2_quesMast','accounts_quesMast','business_quesMast',
        'entity_quesMast','previous_directors','previous_kmps','previous_employees','previous_workers',
        'previous_directors_compliants','previous_kmps_compliants',
        'previous_directors_remarks','previous_kmps_remarks',
        'prev_accounts','prev_house','trading_house','top10_house','prev_dealers','prev_nodealers','prev_topdealers','prev_purchase','prev_sales','prev_loans','prev_investment'));

    }

    public function sectionP2create($fy_id) {
 
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $capex_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'expenditure')->orderby('id')->get();
        $entity_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'entity')->orderby('id')->get();
        $inputs_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'inputs')->orderby('id')->get();
        $reclaim_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'process')->orderby('id')->get();
        $epr_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'activity')->orderby('id')->get();
        $rrr_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'rrr')->orderby('id')->get();
       
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $previous_year = substr($fys->fy, 0, 4);

        
        // API Integration for P1

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w';
        $cin = Auth::user()->cin_llpin;
        $apiUrl = 'http://13.200.249.135:7000/api/get-all-data-by-cin/';
        $brsrMap = [
            'X2' => 'E1',
            'X5' => 'E1',
        ];
        
        $Results = [];
        
        foreach ($brsrMap as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P2',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results[$id] = $values;
        }

        // $previous_rnd = isset($Results['X2']) ? number_format($Results['X2'] * 100, 2) . '%' : '0%';
        // $previous_capex = isset($Results['X5']) ? number_format($Results['X5'] * 100, 2) . '%' : '0%';
    $previous_rnd = (isset($Results['X2']) && is_numeric($Results['X2']))
    ? number_format((float)$Results['X2'] * 100, 2) . '%'
    : '0%';

$previous_capex = (isset($Results['X5']) && is_numeric($Results['X5']))
    ? number_format((float)$Results['X5'] * 100, 2) . '%'
    : '0%';

        $brsrMap1 = [
            'X4' => 'L4',
            'X5' => 'L4',
            'X6' => 'L4',
            'X10' => 'L4',
            'X11' => 'L4',
            'X12' => 'L4',
            'X16' => 'L4',
            'X17' => 'L4',
            'X18' => 'L4',
            
        ];
        
        $Results1 = [];
        
        foreach ($brsrMap1 as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P2',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results1[$id] = $values;
        }

        $prev_plastic_reuse = $Results1['X4'];
        $prev_plastic_recycle = $Results1['X4'];
        $prev_plastic_dispose = $Results1['X4'];
        $prev_ewaste_reuse = $Results1['X4'];
        $prev_ewaste_recycle = $Results1['X4'];
        $prev_ewaste_dispose = $Results1['X4'];
        $prev_haz_reuse = $Results1['X4'];
        $prev_haz_recycle = $Results1['X4'];
        $prev_haz_dispose = $Results1['X4'];
        
      
        return view('user.brsr.sectionP2create', compact('social_mast','current_fy','previous_fy','user','fys','fy_id','capex_quesMast','entity_quesMast',
        'inputs_quesMast','reclaim_quesMast','epr_quesMast',
        'rrr_quesMast','previous_rnd','previous_capex','prev_plastic_reuse',
        'prev_plastic_recycle','prev_plastic_dispose','prev_ewaste_reuse',
        'prev_ewaste_recycle','prev_ewaste_dispose','prev_haz_reuse','prev_haz_recycle','prev_haz_dispose'));

    }

    public function sectionP7create($fy_id) {
 
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
      
        return view('user.brsr.sectionP7create', compact('social_mast','user','fys','fy_id'));

    }

    public function sectionP8create($fy_id) {
 
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $community_ques = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'community')->orderby('id')->get();
        $material_ques = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'input_material')->orderby('id')->get();
        $location_ques = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'location')->orderby('id')->get();
        $group_ques1 = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'vulnerable_groups')->orderby('id')->get();
        $group_ques2 = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'vulnerable_groups1')->orderby('id')->get();
        $group_ques3 = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'vulnerable_groups2')->orderby('id')->get();
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $previous_year = substr($fys->fy, 0, 4);

         // API Integration for P8
         
         $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w';
         $cin = Auth::user()->cin_llpin;
         $apiUrl = 'http://13.200.249.135:7000/api/get-all-data-by-cin/';
         $brsrMap = [
             'X3' => 'E4',
             'X4' => 'E4',
         ];

         $brsrMap1 = [
            'A6' => 'E5',
            'B6' => 'E5',
            'C6' => 'E5',
            'D6' => 'E5',
        ];
         
         $Results = [];
         $Results1 = [];
         
         foreach ($brsrMap as $id => $question) {
             $postData = [
                 'cin' => $cin,
                 'year' => $previous_year,
                 'Section' => 'P8',
                 'Question' => $question,
                 'BRSR_ID' => $id,
             ];
         
             $response = Http::withToken($token)->post($apiUrl, $postData);
             $values = 'NA';
         
             if ($response->successful()) {
                 $data = data_get($response->json(), 'data.L1');
                 if (is_array($data)) {
                     $values = implode(', ', $data);
                 } elseif (!empty($data)) {
                     $values = $data;
                 }
             }
         
             $Results[$id] = $values;
         }

         foreach ($brsrMap1 as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P8',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results1[$id] = $values;
        }

 
         $previous_msme = isset($Results['X3']) ? number_format($Results['X3'] * 100, 2) . '%' : '0%';
         $previous_others = isset($Results['X4']) ? number_format($Results['X4'] * 100, 2) . '%' : '0%';

         $previous_rural = isset($Results1['A6']) ? number_format($Results1['A6'] * 100, 2) . '%' : '0%';
         $previous_semiurban = isset($Results1['B6']) ? number_format($Results1['B6'] * 100, 2) . '%' : '0%';
         $previous_urban = isset($Results1['C6']) ? number_format($Results1['C6'] * 100, 2) . '%' : '0%';
         $previous_metro = isset($Results1['D6']) ? number_format($Results1['D6'] * 100, 2) . '%' : '0%';
      
        return view('user.brsr.sectionP8create', compact('social_mast','user','fys','fy_id','community_ques','current_fy',
        'previous_fy','previous_year','material_ques','location_ques','group_ques1','group_ques2',
        'group_ques3','previous_msme','previous_others',
        'previous_rural','previous_semiurban','previous_urban','previous_metro'));

    }

    public function sectionP4create($fy_id) {
 
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $principle4_ques1 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'process')->orderby('id')->get();
        $principle4_ques2 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'consultation')->orderby('id')->get();
        $principle4_ques3 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'consultation1')->orderby('id')->get();
        $principle4_ques4 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'consultation2')->orderby('id')->get();
       
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        return view('user.brsr.sectionP4create', compact('social_mast','user','fys','fy_id','principle4_ques1','principle4_ques2','principle4_ques3','principle4_ques4'));

    }

    public function sectionP4edit($id) {
 
        $id = decrypt($id);
        
        $user = Auth::user();

        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
    
        $principle4_ques1 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'process')->orderby('id')->get();
        $principle4_ques2 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'consultation')->orderby('id')->get();
        $principle4_ques3 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'consultation1')->orderby('id')->get();
        $principle4_ques4 = BrsrSectionP4QuestionMaster::where('status', 1)->where('question_section', 'consultation2')->orderby('id')->get();
        $principle4_value = BrsrSectionP4QuestionValue::where('brsr_mast_id', $id)->get();
        $sectionp4_value = BrsrSectionP4AdditionalQuestionValue::where('brsr_mast_id', $id)->get();
        
        return view('user.brsr.sectionP4edit', compact('brsr_mast','user','fys','principle4_ques1',
        'principle4_ques2','principle4_ques3','principle4_ques4','principle4_value','sectionp4_value'));

    }

    public function sectionP9create($fy_id) {
 
        $fy_id = decrypt($fy_id);
        
        $user = Auth::user();

        $social_mast = BrsrMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$social_mast)
        {
            if(!$social_mast)
            {
                $social = new BrsrMast;
                    $social->com_id = $user->id;
                    $social->status = 'D';
                    $social->fy_id = $fy_id;
                $social->save();
            }
        });
      
        $principle9_ques1 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'complaints')->orderby('id')->get();
        $principle9_ques2 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'total_turnover')->orderby('id')->get();
        $principle9_ques3 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'cons_compliants')->orderby('id')->get();
        $principle9_ques4 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'instance')->orderby('id')->get();
        $principle9_ques5 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'web-link')->orderby('id')->get();
        $principle9_ques6 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'actions')->orderby('id')->get();
        $principle9_ques7 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'no_breach')->orderby('id')->get();
        $principle9_ques8 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'breach_percent')->orderby('id')->get();
        $principle9_ques9 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'breach_impact')->orderby('id')->get();
        $principle9_ques10 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'channels')->orderby('id')->get();
        $principle9_ques11 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'steps')->orderby('id')->get();
        $principle9_ques12 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'service')->orderby('id')->get();
        $principle9_ques13 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'product_info')->orderby('id')->get();
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $previous_year = substr($fys->fy, 0, 4);

         // API Integration for P9
         
         $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w';
         $cin = Auth::user()->cin_llpin;
         $apiUrl = 'http://13.200.249.135:7000/api/get-all-data-by-cin/';
         $brsrMap = [
             'X22' => 'E3','X25' => 'E3','X28' => 'E3','X31' => 'E3','X34' => 'E3','X37' => 'E3','X40' => 'E3',
             'X23' => 'E3',
             'X26' => 'E3',
             'X29' => 'E3',
             'X32' => 'E3',
             'X35' => 'E3',
             'X38' => 'E3',
             'X41' => 'E3',

             'X24' => 'E3',
             'X27' => 'E3',
             'X30' => 'E3',
             'X33' => 'E3',
             'X36' => 'E3',
             'X39' => 'E3',
             'X42' => 'E3',
         ];

         $Results = [];
         
         foreach ($brsrMap as $id => $question) {
            $postData = [
                'cin' => $cin,
                'year' => $previous_year,
                'Section' => 'P9',
                'Question' => $question,
                'BRSR_ID' => $id,
            ];
        
            $response = Http::withToken($token)->post($apiUrl, $postData);
            $values = 'NA';
        
            if ($response->successful()) {
                $data = data_get($response->json(), 'data.L1');
                if (is_array($data)) {
                    $values = implode(', ', $data);
                } elseif (!empty($data)) {
                    $values = $data;
                }
            }
        
            $Results[$id] = $values;
        }

        $previous_data_privacy = $Results['X22'];
        $previous_data_ad = $Results['X25'];
        $previous_data_cyber = $Results['X28'];
        $previous_data_delivery = $Results['X31'];
        $previous_data_trade = $Results['X34'];
        $previous_data_unfair = $Results['X37'];
        $previous_data_other = $Results['X40'];

        $previous_pending_data_privacy = $Results['X23'];
        $previous_pending_data_ad = $Results['X26'];
        $previous_pending_data_cyber = $Results['X29'];
        $previous_pending_data_delivery = $Results['X32'];
        $previous_pending_data_trade = $Results['X35'];
        $previous_pending_data_unfair = $Results['X38'];
        $previous_pending_data_other = $Results['X41'];

        $previous_remarks_data_privacy = $Results['X24'];
        $previous_remarks_data_ad = $Results['X27'];
        $previous_remarks_data_cyber = $Results['X30'];
        $previous_remarks_data_delivery = $Results['X33'];
        $previous_remarks_data_trade = $Results['X36'];
        $previous_remarks_data_unfair = $Results['X39'];
        $previous_remarks_data_other = $Results['X42'];
     
        return view('user.brsr.sectionP9create', compact('social_mast','user','fys','fy_id','principle9_ques1','current_fy',
        'previous_fy','previous_year','principle9_ques2','principle9_ques3','principle9_ques4','principle9_ques5',
        'principle9_ques6','principle9_ques7','principle9_ques8','principle9_ques9',
        'principle9_ques10','principle9_ques11','principle9_ques12',
        'principle9_ques13','previous_data_privacy','previous_data_ad',
        'previous_data_cyber','previous_data_delivery','previous_data_trade','previous_data_unfair','previous_data_other',
        'previous_pending_data_privacy','previous_pending_data_ad',
        'previous_pending_data_cyber','previous_pending_data_delivery','previous_pending_data_trade','previous_pending_data_unfair','previous_pending_data_other',
        'previous_remarks_data_privacy','previous_remarks_data_ad',
        'previous_remarks_data_cyber','previous_remarks_data_delivery','previous_remarks_data_trade','previous_remarks_data_unfair','previous_remarks_data_other'));

    }

    public function sectionP9edit($id) {
 
        $id = decrypt($id);
        
        $user = Auth::user();
        
        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $previous_year = substr($fys->fy, 0, 4);
        
        $principle9_ques1 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'complaints')->orderby('id')->get();
        $principle9_ques2 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'total_turnover')->orderby('id')->get();
        $principle9_ques3 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'cons_compliants')->orderby('id')->get();
        $principle9_ques4 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'instance')->orderby('id')->get();
        $principle9_ques5 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'web-link')->orderby('id')->get();
        $principle9_ques6 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'actions')->orderby('id')->get();
        $principle9_ques7 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'no_breach')->orderby('id')->get();
        $principle9_ques8 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'breach_percent')->orderby('id')->get();
        $principle9_ques9 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'breach_impact')->orderby('id')->get();
        $principle9_ques10 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'channels')->orderby('id')->get();
        $principle9_ques11 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'steps')->orderby('id')->get();
        $principle9_ques12 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'service')->orderby('id')->get();
        $principle9_ques13 = BrsrSectionP9QuestionMaster::where('status', 1)->where('question_section', 'product_info')->orderby('id')->get();
        $principle9_value = BrsrSectionP9QuestionValue::where('brsr_mast_id', $id)->get();
    
        return view('user.brsr.sectionP9edit', compact('brsr_mast','user','fys','principle9_ques1','current_fy',
        'previous_fy','previous_year','principle9_ques2','principle9_ques3','principle9_ques4','principle9_ques5',
        'principle9_ques6','principle9_ques7','principle9_ques8','principle9_ques9','principle9_ques10',
        'principle9_ques11','principle9_ques12','principle9_ques13','principle9_value'));

    }

    public function sectionP8edit($id) {
 
        $id = decrypt($id);
        
        $user = Auth::user();

        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
      
        $community_ques = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'community')->orderby('id')->get();
        $material_ques = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'input_material')->orderby('id')->get();
        $location_ques = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'location')->orderby('id')->get();
        $group_ques1 = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'vulnerable_groups')->orderby('id')->get();
        $group_ques2 = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'vulnerable_groups1')->orderby('id')->get();
        $group_ques3 = BrsrSectionP8QuestionMaster::where('status', 1)->where('question_section', 'vulnerable_groups2')->orderby('id')->get();

        $sectionp8_value = BrsrSectionP8QuestionValue::where('brsr_mast_id', $id)->get();

        $sectionp8_value1 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals1'")
        ->get();

        $sectionp8_value2 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals2'")
        ->get();

        $sectionp8_value3 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals3'")
        ->get();
       
        $sectionp8_value4 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals4'")
        ->get();

        $sectionp8_value5 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals5'")
        ->get();

        $sectionp8_value6 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals6'")
        ->get();
      
        $sectionp8_value7 = DB::table('brsr_sectionc_p8_additional_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals7'")
        ->get();
      
        return view('user.brsr.sectionP8edit', compact('brsr_mast','user','fys','community_ques','current_fy',
        'previous_fy','material_ques','location_ques','group_ques1','group_ques2','group_ques3','sectionp8_value',
        'sectionp8_value1','sectionp8_value2',
        'sectionp8_value3','sectionp8_value4','sectionp8_value5','sectionp8_value6','sectionp8_value7'));
     
    }

    public function sectionP7edit($id) {
 
        $id = decrypt($id);
        
        $user = Auth::user();

        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
      
        $sectionp7_value1 = DB::table('brsr_sectionc_p7_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals1'")
        
        ->get();

        $sectionp7_value2 = DB::table('brsr_sectionc_p7_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals2'")
        
        ->get();

        
        $sectionp7_value3 = DB::table('brsr_sectionc_p7_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals3'")
        
        ->get();

          
        $sectionp7_value4 = DB::table('brsr_sectionc_p7_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals4'")
        
        ->get();

        return view('user.brsr.sectionP7edit', compact('brsr_mast','user','fys','sectionp7_value1','sectionp7_value2','sectionp7_value3','sectionp7_value4'));

    }

    public function sectionbstore(Request $request)
    {
      //dd($request->all());
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
             
             foreach ($request->emp as $val) {
                    
                    $policy_data = new BrsrSectionBPolicyQuestionValue;
                    $policy_data->com_id = $request->com_id;
                    $policy_data->brsr_mast_id = $brsr_mast->id;
                    $policy_data->fy_id = $request->fy_id;
                    $policy_data->ques_id = $val['ques_id'];  
                    $policy_data->policy_p1 = $val['policy_p1'] ? $val['policy_p1'] : 'NaN'; 
                    $policy_data->policy_p2 = $val['policy_p2'] ? $val['policy_p2'] : 'NaN'; 
                    $policy_data->policy_p3 = $val['policy_p3'] ? $val['policy_p3'] : 'NaN'; 
                    $policy_data->policy_p4 = $val['policy_p4'] ? $val['policy_p4'] : 'NaN'; 
                    $policy_data->policy_p5 = $val['policy_p5'] ? $val['policy_p5'] : 'NaN'; 
                    $policy_data->policy_p6 = $val['policy_p6'] ? $val['policy_p6'] : 'NaN'; 
                    $policy_data->policy_p7 = $val['policy_p7'] ? $val['policy_p7'] : 'NaN'; 
                    $policy_data->policy_p8 = $val['policy_p8'] ? $val['policy_p8'] : 'NaN'; 
                    $policy_data->policy_p9 = $val['policy_p9'] ? $val['policy_p9'] : 'NaN'; 
                    $policy_data->save();
               }
        
               if (isset($request->governance)) {
                foreach ($request->governance as $key => $data) {
                    $prod_serv_data = new BrsrSectionBGovernanceQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->director_statement = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->authority_details = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->committee = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->save();
                }
            }

            foreach ($request->emps as $val) {
                    
                $policy1_data = new BrsrSectionBNgrbcQuestionValue;
                $policy1_data->com_id = $request->com_id;
                $policy1_data->brsr_mast_id = $brsr_mast->id;
                $policy1_data->fy_id = $request->fy_id;
                $policy1_data->ques_id = $val['ques_id'];  
                $policy1_data->review_p1 = $val['review_p1'] ? $val['review_p1'] : 'NaN';
                $policy1_data->review_p2 = $val['review_p2'] ? $val['review_p2'] : 'NaN';
                $policy1_data->review_p3 = $val['review_p3'] ? $val['review_p3'] : 'NaN';
                $policy1_data->review_p4 = $val['review_p4'] ? $val['review_p4'] : 'NaN';
                $policy1_data->review_p5 = $val['review_p5'] ? $val['review_p5'] : 'NaN';
                $policy1_data->review_p6 = $val['review_p6'] ? $val['review_p6'] : 'NaN';
                $policy1_data->review_p7 = $val['review_p7'] ? $val['review_p7'] : 'NaN';
                $policy1_data->review_p8 = $val['review_p8'] ? $val['review_p8'] : 'NaN';
                $policy1_data->review_p9 = $val['review_p9'] ? $val['review_p9'] : 'NaN'; 
                $policy1_data->frequency_p1 = $val['frequency_p1'] ? $val['frequency_p1'] : 'NaN';
                $policy1_data->frequency_p2 = $val['frequency_p2'] ? $val['frequency_p2'] : 'NaN';
                $policy1_data->frequency_p3 = $val['frequency_p3'] ? $val['frequency_p3'] : 'NaN';
                $policy1_data->frequency_p4 = $val['frequency_p4'] ? $val['frequency_p4'] : 'NaN';
                $policy1_data->frequency_p5 = $val['frequency_p5'] ? $val['frequency_p5'] : 'NaN';
                $policy1_data->frequency_p6 = $val['frequency_p6'] ? $val['frequency_p6'] : 'NaN';
                $policy1_data->frequency_p7 = $val['frequency_p7'] ? $val['frequency_p7'] : 'NaN';
                $policy1_data->frequency_p8 = $val['frequency_p8'] ? $val['frequency_p8'] : 'NaN';
                $policy1_data->frequency_p9 = $val['frequency_p9'] ? $val['frequency_p9'] : 'NaN';
             
                $policy1_data->save();
           }

           foreach ($request->emp1 as $val) {
                    
            $policy_data = new BrsrSectionBPolicyQuestionValue;
            $policy_data->com_id = $request->com_id;
            $policy_data->brsr_mast_id = $brsr_mast->id;
            $policy_data->fy_id = $request->fy_id;
            $policy_data->ques_id = $val['ques_id'];  
            $policy_data->policy_p1 = $val['policy_p1'] ? $val['policy_p1'] : 'NaN'; 
            $policy_data->policy_p2 = $val['policy_p2'] ? $val['policy_p2'] : 'NaN'; 
            $policy_data->policy_p3 = $val['policy_p3'] ? $val['policy_p3'] : 'NaN'; 
            $policy_data->policy_p4 = $val['policy_p4'] ? $val['policy_p4'] : 'NaN'; 
            $policy_data->policy_p5 = $val['policy_p5'] ? $val['policy_p5'] : 'NaN'; 
            $policy_data->policy_p6 = $val['policy_p6'] ? $val['policy_p6'] : 'NaN'; 
            $policy_data->policy_p7 = $val['policy_p7'] ? $val['policy_p7'] : 'NaN'; 
            $policy_data->policy_p8 = $val['policy_p8'] ? $val['policy_p8'] : 'NaN'; 
            $policy_data->policy_p9 = $val['policy_p9'] ? $val['policy_p9'] : 'NaN'; 
            $policy_data->save();
       }

       foreach ($request->emp2 as $val) {
                    
        $policy_data = new BrsrSectionBPolicyQuestionValue;
        $policy_data->com_id = $request->com_id;
        $policy_data->brsr_mast_id = $brsr_mast->id;
        $policy_data->fy_id = $request->fy_id;
        $policy_data->ques_id = $val['ques_id'];  
        $policy_data->policy_p1 = $val['policy_p1'] ? $val['policy_p1'] : 'NaN'; 
        $policy_data->policy_p2 = $val['policy_p2'] ? $val['policy_p2'] : 'NaN'; 
        $policy_data->policy_p3 = $val['policy_p3'] ? $val['policy_p3'] : 'NaN'; 
        $policy_data->policy_p4 = $val['policy_p4'] ? $val['policy_p4'] : 'NaN'; 
        $policy_data->policy_p5 = $val['policy_p5'] ? $val['policy_p5'] : 'NaN'; 
        $policy_data->policy_p6 = $val['policy_p6'] ? $val['policy_p6'] : 'NaN'; 
        $policy_data->policy_p7 = $val['policy_p7'] ? $val['policy_p7'] : 'NaN'; 
        $policy_data->policy_p8 = $val['policy_p8'] ? $val['policy_p8'] : 'NaN'; 
        $policy_data->policy_p9 = $val['policy_p9'] ? $val['policy_p9'] : 'NaN'; 
        $policy_data->save();
   }
        
        
        });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionBedit', encrypt($brsr_mast->id));
    }
    
    
    public function store(Request $request)
    {
       
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
            $counter = 0; 
            foreach ($request->emp as $val) {
                if ($counter >= 15) {
                    break;  
                }
                $response = isset($val['response']) ? $val['response'] : null;
                $social_data = new BrsrQuestionValue;
                $social_data->com_id = $request->com_id;
                $social_data->brsr_mast_id = $brsr_mast->id; 
                $social_data->fy_id = $request->fy_id;
                $social_data->ques_id = $val['ques_id'];
                $social_data->response = $response;
                
                $social_data->save();
                $counter++;
            }

          
            foreach ($request->emp as $val) {
                if (isset($val['emp_male']) || isset($val['emp_female'])) {
                    $male_count_data = new BrsrQuestionValue;
                    $male_count_data->com_id = $request->com_id;
                    $male_count_data->brsr_mast_id = $brsr_mast->id;
                    $male_count_data->fy_id = $request->fy_id;
                    $male_count_data->ques_id = $val['ques_id'];  
                    $male_count_data->male_count = $val['emp_male']; 
                    $male_count_data->female_count = $val['emp_female']; 
                
                    $male_count_data->save();
                }
            }

            foreach ($request->emp as $val) {
                if (isset($val['total_part']) || isset($val['emp_part'])) {
                    $male_count_data = new BrsrQuestionValue;
                    $male_count_data->com_id = $request->com_id;
                    $male_count_data->brsr_mast_id = $brsr_mast->id;
                    $male_count_data->fy_id = $request->fy_id;
                    $male_count_data->ques_id = $val['ques_id'];  
                    $male_count_data->total_part = $val['total_part']; 
                    $male_count_data->emp_part = $val['emp_part']; 
                   $male_count_data->save();
                }
            }

            if (isset($request->additional)) {
                foreach ($request->additional as $key => $data) {
                    $prod_serv_data = new BrsrSectionAProdServQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->main_activity_description = isset($data['text_a']) ? $data['text_a'] : null;
                    $prod_serv_data->business_activity_description = isset($data['text_b']) ? $data['text_b'] : null;
                    $prod_serv_data->turnover_percent_entity = isset($data['text_c']) ? $data['text_c'] : null;
                    $prod_serv_data->main_activity_status = 'Y';
                    $prod_serv_data->save();
                }
            }

            if (isset($request->additionals)) {
                foreach ($request->additionals as $key => $data) {
                    $prod_serv_data = new BrsrSectionAProdServQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->product_service = isset($data['text_d']) ? $data['text_d'] : null;
                    $prod_serv_data->nic_code = isset($data['text_e']) ? $data['text_e'] : null;
                    $prod_serv_data->total_turnover_contributed = isset($data['text_f']) ? $data['text_f'] : null;
                    $prod_serv_data->nic_activity_status = 'Y';
                    $prod_serv_data->save();
                }
            }

            if (isset($request->operation)) {
                foreach ($request->operation as $key => $data) {
                    $operation_data = new BrsrSectionAOperationQuestionValue;
                    $operation_data->com_id = $request->com_id;
                    $operation_data->brsr_mast_id = $brsr_mast->id;
                    $operation_data->fy_id = $request->fy_id;
                    $operation_data->national_plant_count = isset($data['text_b']) ? $data['text_b'] : null;
                    $operation_data->national_office_count = isset($data['text_c']) ? $data['text_c'] : null;
                    $operation_data->national_total_count = isset($data['text_d']) ? $data['text_d'] : null;
                    $operation_data->international_plant_count = isset($data['text_f']) ? $data['text_f'] : null; 
                    $operation_data->international_office_count = isset($data['text_g']) ? $data['text_g'] : null; 
                    $operation_data->international_total_count = isset($data['text_h']) ? $data['text_h'] : null; 
                    $operation_data->national_state_number = isset($data['text_j']) ? $data['text_j'] : null;
                    $operation_data->international_country_number =  isset($data['text_l']) ? $data['text_l'] : null;
                    $operation_data->export_contribution = isset($data['text_m']) ? $data['text_m'] : null; 
                    $operation_data->customer_brief = isset($data['text_n']) ? $data['text_n'] : null;
                    $operation_data->save();
                }
            }

            foreach ($request->emp as $val) {
                if (isset($val['current_turnover_male']) || isset($val['current_turnover_female']) || isset($val['current_turnover_total'])) {
                    $turnover_data = new BrsrSectionATurnoverQuestionValue;
                    $turnover_data->com_id = $request->com_id;
                    $turnover_data->brsr_mast_id = $brsr_mast->id;
                    $turnover_data->fy_id = $request->fy_id;
                    $turnover_data->ques_id = $val['ques_id'];  
                    $turnover_data->current_turnover_male = $val['current_turnover_male']; 
                    $turnover_data->current_turnover_female = $val['current_turnover_female']; 
                    $turnover_data->current_turnover_total = $val['current_turnover_total']; 
                    $turnover_data->previous_turnover_male = $val['previous_turnover_male'];
                    $turnover_data->previous_turnover_female = $val['previous_turnover_female'];
                    $turnover_data->previous_turnover_total = $val['previous_turnover_total'];
                    $turnover_data->priorprev_turnover_male = $val['priorprev_turnover_male'];
                    $turnover_data->priorprev_turnover_female = $val['priorprev_turnover_female'];
                    $turnover_data->priorprev_turnover_total = $val['priorprev_turnover_total'];
                    
                    $turnover_data->save();
                }
            }

            if (isset($request->holding)) {
                foreach ($request->holding as $key => $data) {
                    $holding_data = new BrsrSectionAHoldingQuestionValue;
                    $holding_data->com_id = $request->com_id;
                    $holding_data->brsr_mast_id = $brsr_mast->id;
                    $holding_data->fy_id = $request->fy_id;
                    $holding_data->name_of_holding = isset($data['text_a']) ? $data['text_a'] : null;
                    $holding_data->indicate_holding = isset($data['text_b']) ? $data['text_b'] : null;
                    $holding_data->percent_shares = isset($data['text_c']) ? $data['text_c'] : null;
                    $holding_data->business_responsibility = isset($data['text_d']) ? $data['text_d'] : null;
                    $holding_data->save();
                }
            }

            if (isset($request->holdings)) {
                foreach ($request->holdings as $key => $data) {
                    $holding_data = new BrsrSectionAHoldingQuestionValue;
                    $holding_data->com_id = $request->com_id;
                    $holding_data->brsr_mast_id = $brsr_mast->id;
                    $holding_data->fy_id = $request->fy_id;
                    $holding_data->csr_applicable = isset($data['text_e']) ? $data['text_e'] : null;
                    $holding_data->turnover_rs = isset($data['text_f']) ? $data['text_f'] : null;
                    $holding_data->net_worth = isset($data['text_g']) ? $data['text_g'] : null;
                    $holding_data->save();
                }
            }

            foreach ($request->emp as $val) {
                if (isset($val['grievance_redressal']) || isset($val['current_fy_no_of_compliants']) || isset($val['current_no_of_pending_compliants']) ||
                  isset($val['current_fy_remarks']) || isset($val['previous_fy_no_of_compliants']) || isset($val['previous_no_of_pending_compliants']) || isset($val['previous_fy_remarks'])) {
                    $compliace_data = new BrsrSectionACompliaceQuestionValue;
                    $compliace_data->com_id = $request->com_id;
                    $compliace_data->brsr_mast_id = $brsr_mast->id;
                    $compliace_data->fy_id = $request->fy_id;
                    $compliace_data->ques_id = $val['ques_id'];  
                    $compliace_data->grievance_redressal = $val['grievance_redressal']; 
                    $compliace_data->current_fy_no_of_compliants = $val['current_fy_no_of_compliants']; 
                    $compliace_data->current_no_of_pending_compliants = $val['current_no_of_pending_compliants']; 
                    $compliace_data->current_fy_remarks = $val['current_fy_remarks'];
                    $compliace_data->previous_fy_no_of_compliants = $val['previous_fy_no_of_compliants'];
                    $compliace_data->previous_no_of_pending_compliants = $val['previous_no_of_pending_compliants'];
                    $compliace_data->previous_fy_remarks = $val['previous_fy_remarks'];
                    $compliace_data->save();
                }
            }

            if (isset($request->material)) {
                foreach ($request->material as $key => $data) {
                    $material_data = new BrsrSectionAMaterialQuestionValue;
                    $material_data->com_id = $request->com_id;
                    $material_data->brsr_mast_id = $brsr_mast->id;
                    $material_data->fy_id = $request->fy_id;
                    $material_data->material_issue = isset($data['text_a']) ? $data['text_a'] : null;
                    $material_data->indicate_risk = isset($data['text_b']) ? $data['text_b'] : null;
                    $material_data->identify_risk = isset($data['text_c']) ? $data['text_c'] : null;
                    $material_data->approach_adapt = isset($data['text_d']) ? $data['text_d'] : null;
                    $material_data->financial_implications = isset($data['text_e']) ? $data['text_e'] : null;
                    $material_data->save();
                }
            }

           
         });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionAedit', encrypt($brsr_mast->id));
    }

    public function sectionp1store(Request $request)
    {
       
       $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {

            $previous_id = (int) $request->fy_id - 1;

            foreach ($request->segment as $val) {

                    $p1_data = new BrsrSectionCP1QuestionValue;
                    $p1_data->com_id = $request->com_id;
                    $p1_data->brsr_mast_id = $brsr_mast->id;
                    $p1_data->fy_id = $request->fy_id;
                    $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
                    $p1_data->total_training = $val['total_training'] ?? 'NaN'; 
                    $p1_data->topics_principles = $val['topics_principles'] ?? 'NaN';
                    $p1_data->age_percent = $val['age_percent'] ?? 'NaN';
                    $p1_data->save();
             }

             foreach ($request->segment1 as $val) {

                $p1_data = new BrsrSectionCP1QuestionValue;
                $p1_data->com_id = $request->com_id;
                $p1_data->brsr_mast_id = $brsr_mast->id;
                $p1_data->fy_id = $request->fy_id;
                $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p1_data->ngrbc_principle = $val['ngrbc_principle'] ?? 'NaN'; 
                $p1_data->regulatory_name = $val['regulatory_name'] ?? 'NaN';
                $p1_data->amount = $val['amount'] ?? 'NaN';
                $p1_data->brief_case = $val['brief_case'] ?? 'NaN';
                $p1_data->appeal_prefered = $val['appeal_prefered'] ?? 'NaN';
                $p1_data->save();
         }

          foreach ($request->segment1 as $val) {

             $p1_data = new BrsrSectionCP1QuestionValue;
             $p1_data->com_id = $request->com_id;
             $p1_data->brsr_mast_id = $brsr_mast->id;
             $p1_data->fy_id = $request->fy_id;
             $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
             $p1_data->ngrbc_principle = $val['ngrbc_principle'] ?? 'NaN'; 
             $p1_data->regulatory_name = $val['regulatory_name'] ?? 'NaN';
             $p1_data->amount = $val['amount'] ?? 'NaN';
             $p1_data->brief_case = $val['brief_case'] ?? 'NaN';
             $p1_data->appeal_prefered = $val['appeal_prefered'] ?? 'NaN';
             $p1_data->save();
        }

        foreach ($request->segment2 as $val) {

            $p1_data = new BrsrSectionCP1QuestionValue;
            $p1_data->com_id = $request->com_id;
            $p1_data->brsr_mast_id = $brsr_mast->id;
            $p1_data->fy_id = $request->fy_id;
            $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
            $p1_data->ngrbc_principle = $val['ngrbc_principle'] ?? 'NaN'; 
            $p1_data->regulatory_name = $val['regulatory_name'] ?? 'NaN';
            $p1_data->brief_case = $val['brief_case'] ?? 'NaN';
            $p1_data->appeal_prefered = $val['appeal_prefered'] ?? 'NaN';
            $p1_data->save();
       }

       if (isset($request->additional)) {
        foreach ($request->additional as $key => $data) {
            $prod_serv_data = new BrsrSectionCP1CaseQuestionValue;
            $prod_serv_data->com_id = $request->com_id;
            $prod_serv_data->brsr_mast_id = $brsr_mast->id;
            $prod_serv_data->fy_id = $request->fy_id;
            $prod_serv_data->case_details = isset($data['text_a']) ? $data['text_a'] : 'NaN';
            $prod_serv_data->regulatory_name = isset($data['text_b']) ? $data['text_b'] : 'NaN';
            $prod_serv_data->save();
        }
      }

       foreach ($request->segment3 as $val) {
          $p1_data = new BrsrSectionCP1QuestionValue;
          $p1_data->com_id = $request->com_id;
          $p1_data->brsr_mast_id = $brsr_mast->id;
          $p1_data->fy_id = $request->fy_id;
          $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
          $p1_data->policy_description = $val['policy_description'] ?? 'NaN'; 
          $p1_data->save();
       }

       foreach ($request->segment4 as $val) {
          $p1_data = new BrsrSectionCP1QuestionValue;
          $p1_data->com_id = $request->com_id;
          $p1_data->brsr_mast_id = $brsr_mast->id;
          $p1_data->fy_id = $request->fy_id;
          $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
          $p1_data->directors_current_fy = $val['directors_current_fy'] ?? 'NaN'; 
          $p1_data->directors_previous_fy_id = $previous_id;
          $p1_data->directors_previous_fy = $val['directors_previous_fy'] ?? 'NaN';
          $p1_data->save();
        }

        foreach ($request->segment5 as $val) {
            $p1_data = new BrsrSectionCP1QuestionValue;
            $p1_data->com_id = $request->com_id;
            $p1_data->brsr_mast_id = $brsr_mast->id;
            $p1_data->fy_id = $request->fy_id;
            $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
            $p1_data->no_compliants_current_fy = $val['no_compliants_current_fy'] ?? 'NaN'; 
            $p1_data->remarks_compliants_current_fy = $val['remarks_compliants_current_fy'] ?? 'NaN'; 
            $p1_data->compliants_previous_fy_id = $previous_id;
            $p1_data->no_compliants_previous_fy = $val['no_compliants_previous_fy'] ?? 'NaN';
            $p1_data->remarks_compliants_previous_fy = $val['remarks_compliants_previous_fy'] ?? 'NaN';
            $p1_data->save();
        }

        foreach ($request->segment6 as $val) {
            $p1_data = new BrsrSectionCP1QuestionValue;
            $p1_data->com_id = $request->com_id;
            $p1_data->brsr_mast_id = $brsr_mast->id;
            $p1_data->fy_id = $request->fy_id;
            $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
            $p1_data->corrective_action = $val['corrective_action'] ?? 'NaN'; 
            $p1_data->save();
         }

         foreach ($request->segment7 as $val) {
            $p1_data = new BrsrSectionCP1QuestionValue;
            $p1_data->com_id = $request->com_id;
            $p1_data->brsr_mast_id = $brsr_mast->id;
            $p1_data->fy_id = $request->fy_id;
            $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
            $p1_data->account_current_fy = $val['account_current_fy'] ?? 'NaN'; 
            $p1_data->account_previous_fy_id = $previous_id;
            $p1_data->account_previous_fy = $val['account_previous_fy'] ?? 'NaN';
            $p1_data->save();
          }

          foreach ($request->segment8 as $val) {
            $p1_data = new BrsrSectionCP1QuestionValue;
            $p1_data->com_id = $request->com_id;
            $p1_data->brsr_mast_id = $brsr_mast->id;
            $p1_data->fy_id = $request->fy_id;
            $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
            $p1_data->business_current_fy = $val['business_current_fy'] ?? 'NaN'; 
            $p1_data->business_previous_fy_id = $previous_id;
            $p1_data->business_previous_fy = $val['business_previous_fy'] ?? 'NaN';
            $p1_data->save();
          }

          if (isset($request->additionals)) {
            foreach ($request->additionals as $key => $data) {
                $prod_serv_data = new BrsrSectionCP1AwarenessQuestionValue;
                $prod_serv_data->com_id = $request->com_id;
                $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                $prod_serv_data->fy_id = $request->fy_id;
                $prod_serv_data->awareness_total = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                $prod_serv_data->topics = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                $prod_serv_data->age_percent = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                $prod_serv_data->save();
            }
          }

          foreach ($request->segment9 as $val) {
            $p1_data = new BrsrSectionCP1QuestionValue;
            $p1_data->com_id = $request->com_id;
            $p1_data->brsr_mast_id = $brsr_mast->id;
            $p1_data->fy_id = $request->fy_id;
            $p1_data->ques_id = $val['ques_id'] ?? 'NaN';  
            $p1_data->entity_process = $val['entity_process'] ?? 'NaN'; 
            $p1_data->save();
         }
       });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionP1edit', encrypt($brsr_mast->id));
    }

    public function sectionp2store(Request $request)
    {
       
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {

            $previous_id = (int) $request->fy_id - 1;

            foreach ($request->segment as $val) {

                    $p2_data = new BrsrSectionP2QuestionValue;
                    $p2_data->com_id = $request->com_id;
                    $p2_data->brsr_mast_id = $brsr_mast->id;
                    $p2_data->fy_id = $request->fy_id;
                    $p2_data->ques_id = $val['ques_id'] ?? 'NaN';  
                    $p2_data->capex_current_fy = $val['capex_current_fy'] ?? 'NaN'; 
                    $p2_data->capex_previous_fy_id = $previous_id;
                    $p2_data->capex_previous_fy = $val['capex_previous_fy'] ?? 'NaN';
                    $p2_data->capex_details = $val['capex_details'] ?? 'NaN'; 
                    $p2_data->save();
             }

             foreach ($request->segment2 as $val) {
                $p2_data = new BrsrSectionP2QuestionValue;
                $p2_data->com_id = $request->com_id;
                $p2_data->brsr_mast_id = $brsr_mast->id;
                $p2_data->fy_id = $request->fy_id;
                $p2_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p2_data->entity_procedure = $val['entity_procedure'] ?? 'NaN'; 
                $p2_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p2_data = new BrsrSectionP2QuestionValue;
                $p2_data->com_id = $request->com_id;
                $p2_data->brsr_mast_id = $brsr_mast->id;
                $p2_data->fy_id = $request->fy_id;
                $p2_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p2_data->input_percent = $val['input_percent'] ?? 'NaN'; 
                $p2_data->save();
             }

             foreach ($request->segment4 as $val) {
                $p2_data = new BrsrSectionP2QuestionValue;
                $p2_data->com_id = $request->com_id;
                $p2_data->brsr_mast_id = $brsr_mast->id;
                $p2_data->fy_id = $request->fy_id;
                $p2_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p2_data->reclaim_product = $val['reclaim_product'] ?? 'NaN'; 
                $p2_data->save();
             }

             foreach ($request->segment5 as $val) {
                $p2_data = new BrsrSectionP2QuestionValue;
                $p2_data->com_id = $request->com_id;
                $p2_data->brsr_mast_id = $brsr_mast->id;
                $p2_data->fy_id = $request->fy_id;
                $p2_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p2_data->epr = $val['epr'] ?? 'NaN'; 
                $p2_data->save();
             }

             if (isset($request->additionals)) {
                foreach ($request->additionals as $key => $data) {
                    $prod_serv_data = new BrsrSectionP2OthersQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->nic_code = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->product_name = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->turnover_contribution = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->assessment = isset($data['text_d']) ? $data['text_d'] : 'NaN';
                    $prod_serv_data->external_agency = isset($data['text_e']) ? $data['text_e'] : 'NaN';
                    $prod_serv_data->results = isset($data['text_f']) ? $data['text_f'] : 'NaN';
                    $prod_serv_data->flag = 'additionals';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals1)) {
                foreach ($request->additionals1 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP2OthersQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->service_name = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->risk_concern = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->action_taken = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->flag = 'additionals1';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals2)) {
                foreach ($request->additionals2 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP2OthersQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->input_material = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->recycle_current_fy = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->recycle_previous_fy = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->flag = 'additionals2';
                    $prod_serv_data->save();
                }
              }

            foreach ($request->segment6 as $val) {
                $p2_data = new BrsrSectionP2QuestionValue;
                $p2_data->com_id = $request->com_id;
                $p2_data->brsr_mast_id = $brsr_mast->id;
                $p2_data->fy_id = $request->fy_id;
                $p2_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p2_data->reuse_current_fy = $val['reuse_current_fy'] ?? 'NaN'; 
                $p2_data->recycle_current_fy = $val['recycle_current_fy'] ?? 'NaN'; 
                $p2_data->disposed_current_fy = $val['disposed_current_fy'] ?? 'NaN'; 
                $p2_data->reuse_previous_fy_id = $previous_id;
                $p2_data->reuse_previous_fy = $val['reuse_previous_fy'] ?? 'NaN'; 
                $p2_data->recycle_previous_fy = $val['recycle_previous_fy'] ?? 'NaN'; 
                $p2_data->disposed_previous_fy = $val['disposed_previous_fy'] ?? 'NaN'; 
                $p2_data->save();
             }

             if (isset($request->additionals3)) {
                foreach ($request->additionals3 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP2OthersQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->product_category = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->recliam_product = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->flag = 'additionals3';
                    $prod_serv_data->save();
                }
              }

     
       });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionP2edit', encrypt($brsr_mast->id));
    }

    public function sectionp7store(Request $request)
    {
       
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {

            if (isset($request->additionals1)) {
                foreach ($request->additionals1 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP7QuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->affliation_no = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->flag = 'additionals1';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals2)) {
                foreach ($request->additionals2 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP7QuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->trade_no = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->trade_reach = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->flag = 'additionals2';
                    $prod_serv_data->save();
                }
              }

            if (isset($request->additionals3)) {
                foreach ($request->additionals3 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP7QuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->authority_name = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->brief_case = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->action_taken = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->flag = 'additionals3';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals4)) {
                foreach ($request->additionals4 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP7QuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->public_policy = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->advocacy = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->public_domain = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->frequency_review = isset($data['text_d']) ? $data['text_d'] : 'NaN';
                    $prod_serv_data->web_link = isset($data['text_e']) ? $data['text_e'] : 'NaN';
                    $prod_serv_data->flag = 'additionals4';
                    $prod_serv_data->save();
                }
              }

        });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionP7edit', encrypt($brsr_mast->id));
    }

    public function sectionp8store(Request $request)
    {
 
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
           $previous_id = (int) $request->fy_id - 1;

            if (isset($request->additionals1)) {
                foreach ($request->additionals1 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->project_name = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->sia_no = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->notify_date = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->external_agency = isset($data['text_d']) ? $data['text_d'] : 'NaN';
                    $prod_serv_data->public_domain = isset($data['text_e']) ? $data['text_e'] : 'NaN';
                    $prod_serv_data->web_link = isset($data['text_f']) ? $data['text_f'] : 'NaN';
                    $prod_serv_data->flag = 'additionals1';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals2)) {
                foreach ($request->additionals2 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->rr_name = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->state_name = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->district_name = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->affected_family = isset($data['text_d']) ? $data['text_d'] : 'NaN';
                    $prod_serv_data->paf_percent = isset($data['text_e']) ? $data['text_e'] : 'NaN';
                    $prod_serv_data->paf_amount = isset($data['text_f']) ? $data['text_f'] : 'NaN';
                    $prod_serv_data->flag = 'additionals2';
                    $prod_serv_data->save();
                }
              }

              foreach ($request->segment1 as $val) {
                $p8_data = new BrsrSectionP8QuestionValue;
                $p8_data->com_id = $request->com_id;
                $p8_data->brsr_mast_id = $brsr_mast->id;
                $p8_data->fy_id = $request->fy_id;
                $p8_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p8_data->community = $val['community'] ?? 'NaN'; 
                $p8_data->save();
             }

             foreach ($request->segment2 as $val) {
                $p8_data = new BrsrSectionP8QuestionValue;
                $p8_data->com_id = $request->com_id;
                $p8_data->brsr_mast_id = $brsr_mast->id;
                $p8_data->fy_id = $request->fy_id;
                $p8_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p8_data->input_material_current_fy = $val['input_material_current_fy'] ?? 'NaN'; 
                $p8_data->input_material_previous_fy_id = $previous_id;
                $p8_data->input_material_previous_fy = $val['input_material_previous_fy'] ?? 'NaN'; 
                $p8_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p8_data = new BrsrSectionP8QuestionValue;
                $p8_data->com_id = $request->com_id;
                $p8_data->brsr_mast_id = $brsr_mast->id;
                $p8_data->fy_id = $request->fy_id;
                $p8_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p8_data->location_current_fy = $val['location_current_fy'] ?? 'NaN'; 
                $p8_data->location_previous_fy_id = $previous_id;
                $p8_data->location_previous_fy = $val['location_previous_fy'] ?? 'NaN'; 
                $p8_data->save();
             }


            if (isset($request->additionals3)) {
                foreach ($request->additionals3 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->social_details = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->action_taken = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->flag = 'additionals3';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals4)) {
                foreach ($request->additionals4 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->csr_state = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->asp_district = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->amount_spent = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->flag = 'additionals4';
                    $prod_serv_data->save();
                }
              }

              foreach ($request->segment4 as $val) {
                $p8_data = new BrsrSectionP8QuestionValue;
                $p8_data->com_id = $request->com_id;
                $p8_data->brsr_mast_id = $brsr_mast->id;
                $p8_data->fy_id = $request->fy_id;
                $p8_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p8_data->preferential_policy = $val['preferential_policy'] ?? 'NaN'; 
                $p8_data->save();
             }

             foreach ($request->segment5 as $val) {
                $p8_data = new BrsrSectionP8QuestionValue;
                $p8_data->com_id = $request->com_id;
                $p8_data->brsr_mast_id = $brsr_mast->id;
                $p8_data->fy_id = $request->fy_id;
                $p8_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p8_data->vulnerable_groups = $val['vulnerable_groups'] ?? 'NaN'; 
                $p8_data->save();
             }

             foreach ($request->segment6 as $val) {
                $p8_data = new BrsrSectionP8QuestionValue;
                $p8_data->com_id = $request->com_id;
                $p8_data->brsr_mast_id = $brsr_mast->id;
                $p8_data->fy_id = $request->fy_id;
                $p8_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p8_data->total_procurement = $val['total_procurement'] ?? 'NaN'; 
                $p8_data->save();
             }

             if (isset($request->additionals5)) {
                foreach ($request->additionals5 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->traditional  = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->acquired = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->benefit_shared = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->basis_benefit = isset($data['text_d']) ? $data['text_d'] : 'NaN';
                    $prod_serv_data->flag = 'additionals5';
                    $prod_serv_data->save();
                }
              }

              

              if (isset($request->additionals6)) {
                foreach ($request->additionals6 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->authority_name = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->brief_case = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->corrective_action = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->flag = 'additionals6';
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals7)) {
                foreach ($request->additionals7 as $key => $data) {
                    $prod_serv_data = new BrsrSectionP8AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->csr_project = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->csr_persons = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->groups_percent = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->flag = 'additionals7';
                    $prod_serv_data->save();
                }
              }

        });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionP8edit', encrypt($brsr_mast->id));
    }

    public function sectionp4store(Request $request)
    {
    
        
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
          
          foreach ($request->segment1 as $val) {
                $p4_data = new BrsrSectionP4QuestionValue;
                $p4_data->com_id = $request->com_id;
                $p4_data->brsr_mast_id = $brsr_mast->id;
                $p4_data->fy_id = $request->fy_id;
                $p4_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p4_data->process_key = $val['process_key'] ?? 'NaN'; 
                $p4_data->save();
             }

             if (isset($request->additionals)) {
                foreach ($request->additionals as $key => $data) {
                    $prod_serv_data = new BrsrSectionP4AdditionalQuestionValue;
                    $prod_serv_data->com_id = $request->com_id;
                    $prod_serv_data->brsr_mast_id = $brsr_mast->id;
                    $prod_serv_data->fy_id = $request->fy_id;
                    $prod_serv_data->stakeholder_group = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                    $prod_serv_data->identified_yes_no = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                    $prod_serv_data->channel = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                    $prod_serv_data->frequency = isset($data['text_d']) ? $data['text_d'] : 'NaN';
                    $prod_serv_data->purpose = isset($data['text_e']) ? $data['text_e'] : 'NaN';
                   $prod_serv_data->save();
                }
              }

             foreach ($request->segment2 as $val) {
                $p4_data = new BrsrSectionP4QuestionValue;
                $p4_data->com_id = $request->com_id;
                $p4_data->brsr_mast_id = $brsr_mast->id;
                $p4_data->fy_id = $request->fy_id;
                $p4_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p4_data->consultation = $val['consultation'] ?? 'NaN'; 
                $p4_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p4_data = new BrsrSectionP4QuestionValue;
                $p4_data->com_id = $request->com_id;
                $p4_data->brsr_mast_id = $brsr_mast->id;
                $p4_data->fy_id = $request->fy_id;
                $p4_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p4_data->stakeholder_consultation = $val['stakeholder_consultation'] ?? 'NaN'; 
                $p4_data->save();
             }

             foreach ($request->segment4 as $val) {
                $p4_data = new BrsrSectionP4QuestionValue;
                $p4_data->com_id = $request->com_id;
                $p4_data->brsr_mast_id = $brsr_mast->id;
                $p4_data->fy_id = $request->fy_id;
                $p4_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p4_data->stakeholder_groups = $val['stakeholder_groups'] ?? 'NaN'; 
                $p4_data->save();
             }
         });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionP4edit', encrypt($brsr_mast->id));
    }

    public function sectionp4update(Request $request)
    {
    
       $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
          
          foreach ($request->segment1 as $val) {
                $p4_data = BrsrSectionP4QuestionValue::find($val['row_id']);
                $p4_data->process_key = $val['process_key'] ?? 'NaN'; 
                $p4_data->updated_at = Carbon::now(); 
                $p4_data->save();
             }

             if (isset($request->additionals)) {
                foreach ($request->additionals as $key => $data) {
                    $prod_serv_data = BrsrSectionP4AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->stakeholder_group = isset($data['stakeholder_group']) ? $data['stakeholder_group'] : 'NaN';
                    $prod_serv_data->identified_yes_no = isset($data['identified_yes_no']) ? $data['identified_yes_no'] : 'NaN';
                    $prod_serv_data->channel = isset($data['channel']) ? $data['channel'] : 'NaN';
                    $prod_serv_data->frequency = isset($data['frequency']) ? $data['frequency'] : 'NaN';
                    $prod_serv_data->purpose = isset($data['purpose']) ? $data['purpose'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now();
                   $prod_serv_data->save();
                }
              }

             foreach ($request->segment2 as $val) {
                $p4_data =  BrsrSectionP4QuestionValue::find($val['row_id']);
                $p4_data->consultation = $val['consultation'] ?? 'NaN'; 
                $p4_data->updated_at = Carbon::now();
                $p4_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p4_data =  BrsrSectionP4QuestionValue::find($val['row_id']);
                $p4_data->stakeholder_consultation = $val['stakeholder_consultation'] ?? 'NaN'; 
                $p4_data->updated_at = Carbon::now();
                $p4_data->save();
             }

             foreach ($request->segment4 as $val) {
                $p4_data = BrsrSectionP4QuestionValue::find($val['row_id']);
                $p4_data->stakeholder_groups = $val['stakeholder_groups'] ?? 'NaN'; 
                $p4_data->updated_at = Carbon::now();
                $p4_data->save();
             }
         });
    
         alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
         return redirect()->back();   
    }


    public function sectionp9store(Request $request)
    {
    
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
           $previous_id = (int) $request->fy_id - 1;
          
           foreach ($request->segment1 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->consumer_compliant = $val['consumer_compliant'] ?? 'NaN'; 
                $p9_data->save();
             }

             foreach ($request->segment2 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->turnover_percent = $val['turnover_percent'] ?? 'NaN'; 
                $p9_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->received_compliants_current_fy = $val['received_compliants_current_fy'] ?? 'NaN'; 
                $p9_data->pending_compliants_current_fy = $val['pending_compliants_current_fy'] ?? 'NaN'; 
                $p9_data->remarks_current_fy = $val['remarks_current_fy'] ?? 'NaN'; 
                $p9_data->compliants_previous_fy_id = $previous_id;
                $p9_data->received_compliants_previous_fy = $val['received_compliants_previous_fy'] ?? 'NaN'; 
                $p9_data->pending_compliants_previous_fy = $val['pending_compliants_previous_fy'] ?? 'NaN'; 
                $p9_data->remarks_previous_fy = $val['remarks_previous_fy'] ?? 'NaN'; 
                $p9_data->save();
             }

             foreach ($request->segment4 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->instant_number = $val['instant_number'] ?? 'NaN';
                $p9_data->recall_reason = $val['recall_reason'] ?? 'NaN';  
                $p9_data->save();
             }

             foreach ($request->segment5 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->web_link = $val['web_link'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment6 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->corrective_actions = $val['corrective_actions'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment7 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->no_instances = $val['no_instances'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment8 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->breach_percent = $val['breach_percent'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment9 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->impact = $val['impact'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment10 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->channels = $val['channels'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment11 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->steps = $val['steps'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment12 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->risk = $val['risk'] ?? 'NaN';
                $p9_data->save();
             }

             foreach ($request->segment13 as $val) {
                $p9_data = new BrsrSectionP9QuestionValue;
                $p9_data->com_id = $request->com_id;
                $p9_data->brsr_mast_id = $brsr_mast->id;
                $p9_data->fy_id = $request->fy_id;
                $p9_data->ques_id = $val['ques_id'] ?? 'NaN';  
                $p9_data->product_info = $val['product_info'] ?? 'NaN';
                $p9_data->save();
             }
            
         });
    
        alert()->success('Record Inserted', 'Success!')->persistent('Close');
        return redirect()->route('user.brsr.sectionP9edit', encrypt($brsr_mast->id));
    }

    public function sectionp9update(Request $request)
    {
    
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
           
           foreach ($request->segment1 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->consumer_compliant = $val['consumer_compliant'] ?? 'NaN'; 
                $p9_data->updated_at = Carbon::now(); 
                $p9_data->save();
             }

             foreach ($request->segment2 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->turnover_percent = $val['turnover_percent'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now(); 
                $p9_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->received_compliants_current_fy = $val['received_compliants_current_fy'] ?? 'NaN'; 
                $p9_data->pending_compliants_current_fy = $val['pending_compliants_current_fy'] ?? 'NaN'; 
                $p9_data->remarks_current_fy = $val['remarks_current_fy'] ?? 'NaN'; 
                $p9_data->received_compliants_previous_fy = $val['received_compliants_previous_fy'] ?? 'NaN'; 
                $p9_data->pending_compliants_previous_fy = $val['pending_compliants_previous_fy'] ?? 'NaN'; 
                $p9_data->remarks_previous_fy = $val['remarks_previous_fy'] ?? 'NaN'; 
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment4 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->instant_number = $val['instant_number'] ?? 'NaN';
                $p9_data->recall_reason = $val['recall_reason'] ?? 'NaN';  
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment5 as $val) {
                $p9_data =  BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->web_link = $val['web_link'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment6 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->corrective_actions = $val['corrective_actions'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment7 as $val) {
                $p9_data =  BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->no_instances = $val['no_instances'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment8 as $val) {
                $p9_data =  BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->breach_percent = $val['breach_percent'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment9 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->impact = $val['impact'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment10 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->channels = $val['channels'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment11 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->steps = $val['steps'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment12 as $val) {
                $p9_data =  BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->risk = $val['risk'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }

             foreach ($request->segment13 as $val) {
                $p9_data = BrsrSectionP9QuestionValue::find($val['row_id']);
                $p9_data->product_info = $val['product_info'] ?? 'NaN';
                $p9_data->updated_at = Carbon::now();
                $p9_data->save();
             }
            
         });
    
        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back();   
    }

    public function sectionp8update(Request $request)
    {
 
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
         
         if (isset($request->additionals1)) {
                foreach ($request->additionals1 as $key => $data) {
                    $prod_serv_data = BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->project_name = isset($data['project_name']) ? $data['project_name'] : 'NaN';
                    $prod_serv_data->sia_no = isset($data['sia_no']) ? $data['sia_no'] : 'NaN';
                    $prod_serv_data->notify_date = isset($data['notify_date']) ? $data['notify_date'] : 'NaN';
                    $prod_serv_data->external_agency = isset($data['external_agency']) ? $data['external_agency'] : 'NaN';
                    $prod_serv_data->public_domain = isset($data['public_domain']) ? $data['public_domain'] : 'NaN';
                    $prod_serv_data->web_link = isset($data['web_link']) ? $data['web_link'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals2)) {
                foreach ($request->additionals2 as $key => $data) {
                    $prod_serv_data =  BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->rr_name = isset($data['rr_name']) ? $data['rr_name'] : 'NaN';
                    $prod_serv_data->state_name = isset($data['state_name']) ? $data['state_name'] : 'NaN';
                    $prod_serv_data->district_name = isset($data['district_name']) ? $data['district_name'] : 'NaN';
                    $prod_serv_data->affected_family = isset($data['affected_family']) ? $data['affected_family'] : 'NaN';
                    $prod_serv_data->paf_percent = isset($data['paf_percent']) ? $data['paf_percent'] : 'NaN';
                    $prod_serv_data->paf_amount = isset($data['paf_amount']) ? $data['paf_amount'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              foreach ($request->segment1 as $val) {
                $p8_data = BrsrSectionP8QuestionValue::find($val['row_id']);
                $p8_data->community = $val['community'] ?? 'NaN'; 
                $p8_data->updated_at = Carbon::now(); 
                $p8_data->save();
             }

             foreach ($request->segment2 as $val) {
                $p8_data =  BrsrSectionP8QuestionValue::find($val['row_id']);
                $p8_data->input_material_current_fy = $val['input_material_current_fy'] ?? 'NaN'; 
                $p8_data->input_material_previous_fy = $val['input_material_previous_fy'] ?? 'NaN'; 
                $p8_data->updated_at = Carbon::now(); 
                $p8_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p8_data = BrsrSectionP8QuestionValue::find($val['row_id']);
                $p8_data->location_current_fy = $val['location_current_fy'] ?? 'NaN'; 
                $p8_data->location_previous_fy = $val['location_previous_fy'] ?? 'NaN'; 
                $p8_data->updated_at = Carbon::now(); 
                $p8_data->save();
             }


            if (isset($request->additionals3)) {
                foreach ($request->additionals3 as $key => $data) {
                    $prod_serv_data = BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->social_details = isset($data['social_details']) ? $data['social_details'] : 'NaN';
                    $prod_serv_data->action_taken = isset($data['action_taken']) ? $data['action_taken'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals4)) {
                foreach ($request->additionals4 as $key => $data) {
                    $prod_serv_data = BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->csr_state = isset($data['csr_state']) ? $data['csr_state'] : 'NaN';
                    $prod_serv_data->asp_district = isset($data['asp_district']) ? $data['asp_district'] : 'NaN';
                    $prod_serv_data->amount_spent = isset($data['amount_spent ']) ? $data['amount_spent '] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              foreach ($request->segment4 as $val) {
                $p8_data = BrsrSectionP8QuestionValue::find($val['row_id']);
                $p8_data->preferential_policy = $val['preferential_policy'] ?? 'NaN'; 
                $p8_data->updated_at = Carbon::now(); 
                $p8_data->save();
             }

             foreach ($request->segment5 as $val) {
                $p8_data =  BrsrSectionP8QuestionValue::find($val['row_id']);
                $p8_data->vulnerable_groups = $val['vulnerable_groups'] ?? 'NaN'; 
                $p8_data->updated_at = Carbon::now(); 
                $p8_data->save();
             }

             foreach ($request->segment6 as $val) {
                $p8_data = BrsrSectionP8QuestionValue::find($val['row_id']);
                $p8_data->total_procurement = $val['total_procurement'] ?? 'NaN'; 
                $p8_data->updated_at = Carbon::now(); 
                $p8_data->save();
             }

             if (isset($request->additionals5)) {
                foreach ($request->additionals5 as $key => $data) {
                    $prod_serv_data = BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->traditional  = isset($data['traditional']) ? $data['traditional'] : 'NaN';
                    $prod_serv_data->acquired = isset($data['acquired']) ? $data['acquired'] : 'NaN';
                    $prod_serv_data->benefit_shared = isset($data['benefit_shared']) ? $data['benefit_shared'] : 'NaN';
                    $prod_serv_data->basis_benefit = isset($data['basis_benefit']) ? $data['basis_benefit'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

             if (isset($request->additionals6)) {
                foreach ($request->additionals6 as $key => $data) {
                    $prod_serv_data = BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->authority_name = isset($data['authority_name']) ? $data['authority_name'] : 'NaN';
                    $prod_serv_data->brief_case = isset($data['brief_case']) ? $data['brief_case'] : 'NaN';
                    $prod_serv_data->corrective_action = isset($data['corrective_action']) ? $data['corrective_action'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals7)) {
                foreach ($request->additionals7 as $key => $data) {
                    $prod_serv_data =  BrsrSectionP8AdditionalQuestionValue::find($data['row_id']);
                    $prod_serv_data->csr_project = isset($data['csr_project']) ? $data['csr_project'] : 'NaN';
                    $prod_serv_data->csr_persons = isset($data['csr_persons']) ? $data['csr_persons'] : 'NaN';
                    $prod_serv_data->groups_percent = isset($data['groups_percent']) ? $data['groups_percent'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

        });
    
        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back();   
    }

    public function sectionp7update(Request $request)
    {
       
       $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {

            if (isset($request->additionals1)) {
                foreach ($request->additionals1 as $key => $data) {
                    $prod_serv_data = BrsrSectionP7QuestionValue::find($data['row_id']);
                   
                    $prod_serv_data->affliation_no = isset($data['affliation_no']) ? $data['affliation_no'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals2)) {
                foreach ($request->additionals2 as $key => $data) {
                    $prod_serv_data = BrsrSectionP7QuestionValue::find($data['row_id']);
                    $prod_serv_data->trade_no = isset($data['trade_no']) ? $data['trade_no'] : 'NaN';
                    $prod_serv_data->trade_reach = isset($data['trade_reach']) ? $data['trade_reach'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

            if (isset($request->additionals3)) {
                foreach ($request->additionals3 as $key => $data) {
                    $prod_serv_data =  BrsrSectionP7QuestionValue::find($data['row_id']);
                  
                    $prod_serv_data->authority_name = isset($data['authority_name']) ? $data['authority_name'] : 'NaN';
                    $prod_serv_data->brief_case = isset($data['brief_case']) ? $data['brief_case'] : 'NaN';
                    $prod_serv_data->action_taken = isset($data['action_taken']) ? $data['action_taken'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals4)) {
                foreach ($request->additionals4 as $key => $data) {
                    $prod_serv_data =  BrsrSectionP7QuestionValue::find($data['row_id']);
                  
                    $prod_serv_data->public_policy = isset($data['public_policy']) ? $data['public_policy'] : 'NaN';
                    $prod_serv_data->advocacy = isset($data['advocacy']) ? $data['advocacy'] : 'NaN';
                    $prod_serv_data->public_domain = isset($data['public_domain']) ? $data['public_domain'] : 'NaN';
                    $prod_serv_data->frequency_review = isset($data['frequency_review']) ? $data['frequency_review'] : 'NaN';
                    $prod_serv_data->web_link = isset($data['web_link']) ? $data['web_link'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

        });
    
        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back();        
    }


    public function sectionp2update(Request $request)
    {
       
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        
        DB::transaction(function () use ($request, $brsr_mast) {
         
          foreach ($request->segment as $val) {

                    $p2_data = BrsrSectionP2QuestionValue::find($val['row_id']);
                  
                    $p2_data->capex_current_fy = $val['capex_current_fy'] ?? 'NaN'; 
                   
                    $p2_data->capex_previous_fy = $val['capex_previous_fy'] ?? 'NaN';
                    $p2_data->capex_details = $val['capex_details'] ?? 'NaN';
                    $p2_data->updated_at = Carbon::now();  
                    $p2_data->save();
             }

             foreach ($request->segment2 as $val) {
                $p2_data =  BrsrSectionP2QuestionValue::find($val['row_id']);
                $p2_data->entity_procedure = $val['entity_procedure'] ?? 'NaN';
                $p2_data->updated_at = Carbon::now(); 
                $p2_data->save();
             }

             foreach ($request->segment3 as $val) {
                $p2_data = BrsrSectionP2QuestionValue::find($val['row_id']);
                 
                $p2_data->input_percent = $val['input_percent'] ?? 'NaN'; 
                $p2_data->updated_at = Carbon::now(); 
                $p2_data->save();
             }

             foreach ($request->segment4 as $val) {
                $p2_data = BrsrSectionP2QuestionValue::find($val['row_id']);
               
                $p2_data->reclaim_product = $val['reclaim_product'] ?? 'NaN'; 
                $p2_data->updated_at = Carbon::now(); 
                $p2_data->save();
             }

             foreach ($request->segment5 as $val) {
                $p2_data = BrsrSectionP2QuestionValue::find($val['row_id']);
               
                $p2_data->epr = $val['epr'] ?? 'NaN';
                $p2_data->updated_at = Carbon::now(); 
                $p2_data->save();
             }

             if (isset($request->additionals)) {
                foreach ($request->additionals as $key => $data) {
                    $prod_serv_data = BrsrSectionP2OthersQuestionValue::find($data['row_id']);
                    
                    $prod_serv_data->nic_code = isset($data['nic_code']) ? $data['nic_code'] : 'NaN';
                    $prod_serv_data->product_name = isset($data['product_name']) ? $data['product_name'] : 'NaN';
                    $prod_serv_data->turnover_contribution = isset($data['turnover_contribution']) ? $data['turnover_contribution'] : 'NaN';
                    $prod_serv_data->assessment = isset($data['assessment']) ? $data['assessment'] : 'NaN';
                    $prod_serv_data->external_agency = isset($data['external_agency']) ? $data['external_agency'] : 'NaN';
                    $prod_serv_data->results = isset($data['results']) ? $data['results'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals1)) {
                foreach ($request->additionals1 as $key => $data) {
                    $prod_serv_data = BrsrSectionP2OthersQuestionValue::find($data['row_id']);
                  
                    $prod_serv_data->service_name = isset($data['service_name']) ? $data['service_name'] : 'NaN';
                    $prod_serv_data->risk_concern = isset($data['risk_concern']) ? $data['risk_concern'] : 'NaN';
                    $prod_serv_data->action_taken = isset($data['action_taken']) ? $data['action_taken'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

              if (isset($request->additionals2)) {
                foreach ($request->additionals2 as $key => $data) {
                    $prod_serv_data = BrsrSectionP2OthersQuestionValue::find($data['row_id']);
                  
                    $prod_serv_data->input_material = isset($data['input_material']) ? $data['input_material'] : 'NaN';
                    $prod_serv_data->recycle_current_fy = isset($data['recycle_current_fy']) ? $data['recycle_current_fy'] : 'NaN';
                    $prod_serv_data->recycle_previous_fy = isset($data['recycle_previous_fy']) ? $data['recycle_previous_fy'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

            foreach ($request->segment6 as $val) {
                $p2_data = BrsrSectionP2QuestionValue::find($val['row_id']);
                
                $p2_data->reuse_current_fy = $val['reuse_current_fy'] ?? 'NaN'; 
                $p2_data->recycle_current_fy = $val['recycle_current_fy'] ?? 'NaN'; 
                $p2_data->disposed_current_fy = $val['disposed_current_fy'] ?? 'NaN'; 
                $p2_data->reuse_previous_fy = $val['reuse_previous_fy'] ?? 'NaN'; 
                $p2_data->recycle_previous_fy = $val['recycle_previous_fy'] ?? 'NaN'; 
                $p2_data->disposed_previous_fy = $val['disposed_previous_fy'] ?? 'NaN';
                $p2_data->updated_at = Carbon::now(); 
                $p2_data->save();
             }

             if (isset($request->additionals3)) {
                foreach ($request->additionals3 as $key => $data) {
                    $prod_serv_data = BrsrSectionP2OthersQuestionValue::find($data['row_id']);
                   
                    $prod_serv_data->product_category = isset($data['product_category']) ? $data['product_category'] : 'NaN';
                    $prod_serv_data->recliam_product = isset($data['recliam_product']) ? $data['recliam_product'] : 'NaN';
                    $prod_serv_data->updated_at = Carbon::now(); 
                    $prod_serv_data->save();
                }
              }

     
       });
    
        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back();
    }

    public function sectionp1update(Request $request)
    {
    //    dd($request);
       $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
     
        DB::transaction(function () use ($request, $brsr_mast) {
            foreach ($request->segment as $val) {
                    
                    $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
                    $p1_data->total_training = $val['total_training'] ?? 'NaN'; 
                    $p1_data->topics_principles = $val['topics_principles'] ?? 'NaN';
                    $p1_data->age_percent = $val['age_percent'] ?? 'NaN';
                    $p1_data->updated_at = Carbon::now();
                    $p1_data->save();
             }

             foreach ($request->segment1 as $val) {
                
                $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
                $p1_data->ngrbc_principle = $val['ngrbc_principle'] ?? 'NaN'; 
                $p1_data->regulatory_name = $val['regulatory_name'] ?? 'NaN';
                $p1_data->amount = $val['amount'] ?? 'NaN';
                $p1_data->brief_case = $val['brief_case'] ?? 'NaN';
                $p1_data->appeal_prefered = $val['appeal_prefered'] ?? 'NaN';
                $p1_data->updated_at = Carbon::now();
                $p1_data->save();
         }
 

        foreach ($request->segment2 as $val) {

            $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
            $p1_data->ngrbc_principle = $val['ngrbc_principle'] ?? 'NaN'; 
            $p1_data->regulatory_name = $val['regulatory_name'] ?? 'NaN';
            $p1_data->brief_case = $val['brief_case'] ?? 'NaN';
            $p1_data->appeal_prefered = $val['appeal_prefered'] ?? 'NaN';
            $p1_data->updated_at = Carbon::now();
            $p1_data->save();
       }

       if (isset($request->additional)) {
        foreach ($request->additional as $key => $data) {
            $prod_serv_data = BrsrSectionCP1CaseQuestionValue::find($data['row_id']);
            $prod_serv_data->case_details = isset($data['case_details']) ? $data['case_details'] : 'NaN';
            $prod_serv_data->regulatory_name = isset($data['regulatory_name']) ? $data['regulatory_name'] : 'NaN';
            $prod_serv_data->updated_at = Carbon::now();
            $prod_serv_data->save();
        }
      }

       foreach ($request->segment3 as $val) {
          $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
          $p1_data->policy_description = $val['policy_description'] ?? 'NaN';
          $p1_data->updated_at = Carbon::now();
          $p1_data->save();
       }

       foreach ($request->segment4 as $val) {
          $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
          $p1_data->directors_current_fy = $val['directors_current_fy'] ?? 'NaN'; 
          $p1_data->directors_previous_fy = $val['directors_previous_fy'] ?? 'NaN';
          $p1_data->updated_at = Carbon::now();
          $p1_data->save();
        }

        foreach ($request->segment5 as $val) {
            $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
            $p1_data->no_compliants_current_fy = $val['no_compliants_current_fy'] ?? 'NaN'; 
            $p1_data->remarks_compliants_current_fy = $val['remarks_compliants_current_fy'] ?? 'NaN'; 
            $p1_data->no_compliants_previous_fy = $val['no_compliants_previous_fy'] ?? 'NaN';
            $p1_data->remarks_compliants_previous_fy = $val['remarks_compliants_previous_fy'] ?? 'NaN';
            $p1_data->updated_at = Carbon::now();
            $p1_data->save();
        }

        foreach ($request->segment6 as $val) {
            $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
            $p1_data->corrective_action = $val['corrective_action'] ?? 'NaN'; 
            $p1_data->updated_at = Carbon::now();
            $p1_data->save();
         }

         foreach ($request->segment7 as $val) {
            $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
            $p1_data->account_current_fy = $val['account_current_fy'] ?? 'NaN'; 
            $p1_data->account_previous_fy_id = 2;
            $p1_data->account_previous_fy = $val['account_previous_fy'] ?? 'NaN';
            $p1_data->updated_at = Carbon::now();
            $p1_data->save();
          }

          foreach ($request->segment8 as $val) {
            $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
            $p1_data->business_current_fy = $val['business_current_fy'] ?? 'NaN'; 
            $p1_data->business_previous_fy_id = 2;
            $p1_data->business_previous_fy = $val['business_previous_fy'] ?? 'NaN';
            $p1_data->updated_at = Carbon::now();
            $p1_data->save();
          }

          if (isset($request->additionals)) {
            foreach ($request->additionals as $key => $data) {
                $prod_serv_data = BrsrSectionCP1AwarenessQuestionValue::find($data['row_id']);
                $prod_serv_data->awareness_total = isset($data['awareness_total']) ? $data['awareness_total'] : 'NaN';
                $prod_serv_data->topics = isset($data['topics']) ? $data['topics'] : 'NaN';
                $prod_serv_data->age_percent = isset($data['age_percent']) ? $data['age_percent'] : 'NaN';
                $prod_serv_data->updated_at = Carbon::now();
                $prod_serv_data->save();
            }
          }

          foreach ($request->segment9 as $val) {
            $p1_data = BrsrSectionCP1QuestionValue::find($val['row_id']);
            $p1_data->entity_process = $val['entity_process'] ?? 'NaN';
            $p1_data->updated_at = Carbon::now();
            $p1_data->save();
         }


       });
    
       alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
       return redirect()->back();
    }
    
    public function edit($id)
    {
        $id = decrypt($id);
        
        $user = Auth::user();
        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $brsr_value = BrsrQuestionValue::where('brsr_mast_id', $id)->get();
        $brsr_turnover_value = BrsrSectionATurnoverQuestionValue::where('brsr_mast_id', $id)->get();
        $brsr_material_value = BrsrSectionAMaterialQuestionValue::where('brsr_mast_id', $id)->get();
        $brsr_compliace_value = BrsrSectionACompliaceQuestionValue::where('brsr_mast_id', $id)->get();
        $brsr_prod_serv_value = BrsrSectionAProdServQuestionValue::where('brsr_mast_id', $id)->where('main_activity_status', 'Y')->get();
        $brsr_nic_prod_serv_value = BrsrSectionAProdServQuestionValue::where('brsr_mast_id', $id)->where('nic_activity_status', 'Y')->get();
        $brsr_operations_value = BrsrSectionAOperationQuestionValue::where('brsr_mast_id', $id)->get();
        $brsr_holding_value = BrsrSectionAHoldingQuestionValue::where('brsr_mast_id', $id)
    ->where(function ($query) {
        $query->whereNull('csr_applicable')
              ->orWhere(DB::raw('LENGTH(csr_applicable)'), '=', 0)
              ->orWhereNull('turnover_rs')
              ->orWhere(DB::raw('LENGTH(turnover_rs)'), '=', 0)
              ->orWhereNull('net_worth')
              ->orWhere(DB::raw('LENGTH(net_worth)'), '=', 0);
    })
    ->get();

  $brsr_holdings_value = BrsrSectionAHoldingQuestionValue::where('brsr_mast_id', $id)
    ->where(function ($query) {
        $query->whereNotNull('csr_applicable')
              ->where(DB::raw('LENGTH(csr_applicable)'), '>', 0)
              ->whereNotNull('turnover_rs')
              ->where(DB::raw('LENGTH(turnover_rs)'), '>', 0)
              ->whereNotNull('net_worth')
              ->where(DB::raw('LENGTH(net_worth)'), '>', 0);
    })
    ->get();

        $quesMast = BrsrSectionAQuestionMaster::where('status', 1)->orderby('id')->get();
        $employees_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Employment')->orderby('id')->get();
        $participation_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Participation')->orderby('id')->get();
        $turnover_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Turnover')->orderby('id')->get();
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $prior_previous_fy = ($startYear - 2) . '-' . substr($startYear - 1, 2, 2);
        $compliance_quesMast = BrsrSectionAQuestionMaster::where('status', 1)->where('question_section', 'Section A - Compliace')->orderby('id')->get(); 
        return view('user.brsr.sectionAedit', compact('current_fy', 'previous_fy', 'prior_previous_fy','quesMast','brsr_value','fys','user','brsr_prod_serv_value','brsr_mast','brsr_nic_prod_serv_value','brsr_operations_value','employees_quesMast','participation_quesMast','turnover_quesMast','brsr_turnover_value','brsr_holding_value','brsr_holdings_value','compliance_quesMast','brsr_compliace_value','brsr_material_value'));
    }


    public function sectionBedit($id)
    {
        $id = decrypt($id);
        
        $user = Auth::user();
        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $policy_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBPolicy')->orderby('id')->get();
        $entity_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBentity')->orderby('id')->get();
        $ngrbc_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBngrbc')->orderby('id')->get();
        $state_quesMast = BrsrSectionBQuestionMaster::where('status', 1)->where('question_section', 'SectionBstate')->orderby('id')->get();
       
        $policy_value = BrsrSectionBPolicyQuestionValue::where('brsr_mast_id', $id)->get();
        $governance_value = BrsrSectionBGovernanceQuestionValue::where('brsr_mast_id', $id)->get();
        $ngrbc_value = BrsrSectionBNgrbcQuestionValue::where('brsr_mast_id', $id)->get();
        $entity_value = BrsrSectionBPolicyQuestionValue::where('brsr_mast_id', $id)->get();
        $state_value = BrsrSectionBPolicyQuestionValue::where('brsr_mast_id', $id)->get();
        
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $prior_previous_fy = ($startYear - 2) . '-' . substr($startYear - 1, 2, 2);
    
        return view('user.brsr.sectionBedit', compact('current_fy', 'previous_fy', 'prior_previous_fy','fys','user',
        'brsr_mast','policy_quesMast','entity_quesMast','ngrbc_quesMast','state_quesMast','policy_value','governance_value','ngrbc_value','entity_value','state_value'));
    }

    public function sectionP1edit($id)
    {
        
        $id = decrypt($id);
        
        $user = Auth::user();
        
        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $segment_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_segment')->orderby('id')->get();
        $monetary_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_monetary')->orderby('id')->get();
        $nonmonetary_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_nonmonetary')->orderby('id')->get();
        $para1_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_para1')->orderby('id')->get();
        $directors_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_corruption')->orderby('id')->get();
        $compliants_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_compliants')->orderby('id')->get();
        $para2_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_para2')->orderby('id')->get();
        $accounts_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_accounts')->orderby('id')->get();
        $business_quesMast = BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_purchase')->orderby('id')->get();
        $entity_quesMast =  BrsrSectionP1QuestionMaster::where('status', 1)->where('question_section', 'P1_entityprocess')->orderby('id')->get();
        $sectionp1_value = BrsrSectionCP1QuestionValue::where('brsr_mast_id', $id)->get();
        $sectionp1_case_value = BrsrSectionCP1CaseQuestionValue::where('brsr_mast_id', $id)->get();
        $sectionp1_awareness_value = BrsrSectionCP1AwarenessQuestionValue::where('brsr_mast_id', $id)->get();
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        
        return view('user.brsr.sectionP1edit', compact('current_fy','previous_fy','user','fys','segment_quesMast','monetary_quesMast',
        'nonmonetary_quesMast','para1_quesMast','directors_quesMast','compliants_quesMast','para2_quesMast','accounts_quesMast','business_quesMast',
        'entity_quesMast','sectionp1_value','sectionp1_case_value','sectionp1_awareness_value'));
    }

    public function sectionP2edit($id)
    {
        
        $id = decrypt($id);
        
        $user = Auth::user();
        
        $brsr_mast = BrsrMast::where('com_id', $user->id)->where('id', $id)->first();
        $capex_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'expenditure')->orderby('id')->get();
        $entity_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'entity')->orderby('id')->get();
        $inputs_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'inputs')->orderby('id')->get();
        $reclaim_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'process')->orderby('id')->get();
        $epr_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'activity')->orderby('id')->get();
        $rrr_quesMast = BrsrSectionP2QuestionMaster::where('status', 1)->where('question_section', 'rrr')->orderby('id')->get();
       
        $sectionp2_value = BrsrSectionP2QuestionValue::where('brsr_mast_id', $id)->get();
       
        $sectionp2_lca_value = DB::table('brsr_sectionc_p2_others_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals'")
        ->get();

        $sectionp2_lca_value1 = DB::table('brsr_sectionc_p2_others_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals1'")
        ->get();

        $sectionp2_lca_value2 = DB::table('brsr_sectionc_p2_others_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals2'")
        ->get();

        $sectionp2_lca_value3 = DB::table('brsr_sectionc_p2_others_question_value')
        ->where('brsr_mast_id', $id)
        ->whereRaw("DBMS_LOB.SUBSTR(flag, 1000, 1) = 'additionals3'")
        ->get();
    
      
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        
        return view('user.brsr.sectionP2edit', compact('current_fy','previous_fy','user','fys',
        'capex_quesMast','entity_quesMast','inputs_quesMast','reclaim_quesMast','epr_quesMast','rrr_quesMast',
        'sectionp2_value','sectionp2_lca_value','sectionp2_lca_value1','sectionp2_lca_value2','sectionp2_lca_value3'));
    }


   public function update(Request $request)
    {
        
        $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
        DB::transaction(function () use ($request)
            {
                foreach ($request->emp as $val) {
                    
                    $brsr_data = BrsrQuestionValue::find($val['row_id']);
                    $response = isset($val['response']) ? $val['response'] : null;
                    $brsr_data->response = isset($response) ? $response : null;
                    $brsr_data->updated_at = Carbon::now();
                    $brsr_data->save();
                }

                foreach ($request->emp as $val) {
                    if (isset($val['emp_male']) || isset($val['emp_female'])) {
                     
                        $male_count_data = BrsrQuestionValue::find($val['row_id']);
                       
                       
                        $male_count_data->male_count = $val['emp_male']; 
                        $male_count_data->female_count = $val['emp_female']; 
                    
                        $male_count_data->save();
                    }
                }

                foreach ($request->emp as $val) {
                    if (isset($val['total_part']) || isset($val['emp_part'])) {
                        $part_count_data = BrsrQuestionValue::find($val['row_id']);
                        $part_count_data->total_part = $val['total_part']; 
                        $part_count_data->emp_part = $val['emp_part']; 
                        $part_count_data->save();
                    }
                }
                
                if (isset($request->additional)) {
                    foreach ($request->additional as $rowKey => $val) {
                        if (isset($val['row_id']) && !empty($val['row_id'])) {
                            
                            $productService = BrsrSectionAProdServQuestionValue::find($val['row_id']);
                            
                            if ($productService) {
                                $productService->main_activity_description = $val['text_a'];
                                $productService->business_activity_description = $val['text_b'];
                                $productService->turnover_percent_entity = $val['text_c'];
                                $productService->updated_at = Carbon::now();
                                $productService->save();
                            }
                        } else {
                            
                            $productService = new BrsrSectionAProdServQuestionValue();
                            $productService->com_id = $request->com_id;
                            $productService->brsr_mast_id = $brsr_mast->id;
                            $productService->fy_id = $request->fy_id;
                            $productService->main_activity_description = $val['text_a'];
                            $productService->business_activity_description = $val['text_b'];
                            $productService->turnover_percent_entity = $val['text_c'];
                            $productService->created_at = Carbon::now();
                            $productService->updated_at = Carbon::now();
                            $productService->save();
                        }
                    }
                }

                if (isset($request->additionals)) {
                    foreach ($request->additionals as $rowKey => $val) {
                        if (isset($val['row_id']) && !empty($val['row_id'])) {
                           
                            $productService = BrsrSectionAProdServQuestionValue::find($val['row_id']);
                            if ($productService) {
                               
                                $productService->product_service = $val['text_d'];
                                $productService->nic_code = $val['text_e'];
                                $productService->turnover_percent_entity = $val['text_f'];
                                $productService->updated_at = Carbon::now();
                                $productService->save();
                            }
                        } else {
                            
                            $productService = new BrsrSectionAProdServQuestionValue();
                            $productService->com_id = $request->com_id;
                            $productService->brsr_mast_id = $brsr_mast->id;
                            $productService->fy_id = $request->fy_id;
                            $productService->product_service = $val['text_d'];
                            $productService->nic_code = $val['text_e'];
                            $productService->turnover_percent_entity = $val['text_f'];
                            $productService->created_at = Carbon::now();
                            $productService->updated_at = Carbon::now();
                            $productService->save();
                        }
                    }
                }

                if (isset($request->operation)) {
                    foreach ($request->operation as $key => $data) {
                        if (isset($data['row_id'])) {
                            $operation_data = BrsrSectionAOperationQuestionValue::find($data['row_id']);
                            
                            if ($operation_data) {
                                $operation_data->national_plant_count = isset($data['text_b']) ? $data['text_b'] : null;
                                $operation_data->national_office_count = isset($data['text_c']) ? $data['text_c'] : null;
                                $operation_data->national_total_count = isset($data['text_d']) ? $data['text_d'] : null;
                                $operation_data->international_plant_count = isset($data['text_f']) ? $data['text_f'] : null;
                                $operation_data->international_office_count = isset($data['text_g']) ? $data['text_g'] : null;
                                $operation_data->international_total_count = isset($data['text_h']) ? $data['text_h'] : null;
                                $operation_data->national_state_number = isset($data['text_j']) ? $data['text_j'] : null;
                                $operation_data->international_country_number = isset($data['text_l']) ? $data['text_l'] : null;
                                $operation_data->export_contribution = isset($data['text_m']) ? $data['text_m'] : null;
                                $operation_data->customer_brief = isset($data['text_n']) ? $data['text_n'] : null;
                                $operation_data->updated_at = Carbon::now();
                                $operation_data->save();
                            }
                        } else {
                            Log::info("Saving operation data:", [
                                'national_plant_count' => $operation_data->national_plant_count,
                                'national_office_count' => $operation_data->national_office_count,
                                'international_plant_count' => $operation_data->international_plant_count,
                                'international_office_count' => $operation_data->international_office_count,
                            ]);
                            
                        }
                        
                    }
                }

                foreach ($request->emps as $val) {
                    
                    if (isset($val['current_turnover_male']) || isset($val['current_turnover_female']) || isset($val['current_turnover_total']) 
                    || isset($val['previous_turnover_male']) || isset($val['previous_turnover_female']) || isset($val['previous_turnover_total'])
                    || isset($val['priorprev_turnover_male']) || isset($val['priorprev_turnover_female']) || isset($val['priorprev_turnover_total'])) {
                        $turnover_data = BrsrSectionATurnoverQuestionValue::find($val['row_id']);
                        $turnover_data->current_turnover_male = $val['current_turnover_male']; 
                        $turnover_data->current_turnover_female = $val['current_turnover_female']; 
                        $turnover_data->current_turnover_total = $val['current_turnover_total']; 
                        $turnover_data->previous_turnover_male = $val['previous_turnover_male'];
                        $turnover_data->previous_turnover_female = $val['previous_turnover_female'];
                        $turnover_data->previous_turnover_total = $val['previous_turnover_total'];
                        $turnover_data->priorprev_turnover_male = $val['priorprev_turnover_male'];
                        $turnover_data->priorprev_turnover_female = $val['priorprev_turnover_female'];
                        $turnover_data->priorprev_turnover_total = $val['priorprev_turnover_total'];
                        $turnover_data->updated_at = Carbon::now();
                        $turnover_data->save();
                    }
                }

                if (isset($request->holding)) {
                    foreach ($request->holding as $rowKey => $val) {
                        if (isset($val['row_id']) && !empty($val['row_id'])) {
                            
                            $Holding = BrsrSectionAHoldingQuestionValue::find($val['row_id']);
                            
                            if ($Holding) {
                                $Holding->name_of_holding = $val['text_a'];
                                $Holding->indicate_holding = $val['text_b'];
                                $Holding->percent_shares = $val['text_c'];
                                $Holding->business_responsibility = $val['text_d'];
                                $Holding->updated_at = Carbon::now();
                                $Holding->save();
                            }
                        } else {
                            
                            $Holding = new BrsrSectionAHoldingQuestionValue();
                            $Holding->com_id = $request->com_id;
                            $Holding->brsr_mast_id = $brsr_mast->id;
                            $Holding->fy_id = $request->fy_id;
                            $Holding->name_of_holding = $val['text_a'];
                            $Holding->indicate_holding = $val['text_b'];
                            $Holding->percent_shares = $val['text_c'];
                            $Holding->business_responsibility = $val['text_d'];
                            $Holding->created_at = Carbon::now();
                            $Holding->updated_at = Carbon::now();
                            $Holding->save();
                        }
                    }
                }

                if (isset($request->holdings)) {
                    foreach ($request->holdings as $rowKey => $val) {
                        if (isset($val['row_id']) && !empty($val['row_id'])) {
                            $Holdings = BrsrSectionAHoldingQuestionValue::find($val['row_id']);
                            if ($Holdings) {
                                $Holdings->csr_applicable = $val['text_e'];
                                $Holdings->turnover_rs = $val['text_f'];
                                $Holdings->net_worth = $val['text_g'];
                                $Holdings->updated_at = Carbon::now();
                                $Holdings->save();
                            }
                        } else {
                            $Holdings = new BrsrSectionAHoldingQuestionValue();
                            $Holdings->com_id = $request->com_id;
                            $Holdings->brsr_mast_id = $brsr_mast->id;
                            $Holdings->csr_applicable = $val['text_e'];
                            $Holdings->turnover_rs = $val['text_f'];
                            $Holdings->net_worth = $val['text_g'];
                            $Holdings->created_at = Carbon::now();
                            $Holdings->updated_at = Carbon::now();
                            $Holdings->save();
                        }
                    }
                }

                foreach ($request->empss as $val) {
                    if (isset($val['grievance_redressal']) || isset($val['current_fy_no_of_compliants']) || isset($val['current_no_of_pending_compliants']) ||
                      isset($val['current_fy_remarks']) || isset($val['previous_fy_no_of_compliants']) || isset($val['previous_no_of_pending_compliants']) || isset($val['previous_fy_remarks'])) {
                     
                        $compliace_data = BrsrSectionACompliaceQuestionValue::find($val['row_id']);
                        $compliace_data->grievance_redressal = $val['grievance_redressal']; 
                        $compliace_data->current_fy_no_of_compliants = $val['current_fy_no_of_compliants']; 
                        $compliace_data->current_no_of_pending_compliants = $val['current_no_of_pending_compliants']; 
                        $compliace_data->current_fy_remarks = $val['current_fy_remarks'];
                        $compliace_data->previous_fy_no_of_compliants = $val['previous_fy_no_of_compliants'];
                        $compliace_data->previous_no_of_pending_compliants = $val['previous_no_of_pending_compliants'];
                        $compliace_data->previous_fy_remarks = $val['previous_fy_remarks'];
                        $compliace_data->updated_at = Carbon::now();
                        $compliace_data->save();
                    }
                }

                if (isset($request->material)) {
                    foreach ($request->material as $rowKey => $val) {
                        if (isset($val['row_id']) && !empty($val['row_id'])) {
                            
                            $Material = BrsrSectionAMaterialQuestionValue::find($val['row_id']);
                            
                            if ($Material){
                                $Material->material_issue = $val['text_a'];
                                $Material->indicate_risk = $val['text_b'];
                                $Material->identify_risk = $val['text_c'];
                                $Material->approach_adapt = $val['text_d'];
                                $Material->financial_implications = $val['text_e'];
                                $Material->updated_at = Carbon::now();
                                $Material->save();
                           
                        } else {
                            
                            $Material = new BrsrSectionAMaterialQuestionValue();
                            $Material->com_id = $request->com_id;
                            $Material->brsr_mast_id = $brsr_mast->id;
                            $Material->fy_id = $request->fy_id;
                            $Material->material_issue = $val['text_a'];
                            $Material->indicate_risk = $val['text_b'];
                            $Material->identify_risk = $val['text_c'];
                            $Material->approach_adapt = $val['text_d'];
                            $Material->financial_implications = $val['text_e'];
                            $Material->created_at = Carbon::now();
                            $Material->updated_at = Carbon::now();
                            $Material->save();
                        }
                    }
                }
            }

           });

            alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
            return redirect()->back();
        }
    
     public function sectionbupdate(Request $request)
     {
            $brsr_mast = BrsrMast::where('com_id', $request->com_id)->where('fy_id', $request->fy_id)->first();
            DB::transaction(function () use ($request)
                {
                    foreach ($request->emp as $val) {
                    
                        $policy_data = BrsrSectionBPolicyQuestionValue::find($val['row_id']);
                        $policy_data->policy_p1 = $val['policy_p1'] ? $val['policy_p1'] : 'NaN'; 
                        $policy_data->policy_p2 = $val['policy_p2'] ? $val['policy_p2'] : 'NaN'; 
                        $policy_data->policy_p3 = $val['policy_p3'] ? $val['policy_p3'] : 'NaN'; 
                        $policy_data->policy_p4 = $val['policy_p4'] ? $val['policy_p4'] : 'NaN'; 
                        $policy_data->policy_p5 = $val['policy_p5'] ? $val['policy_p5'] : 'NaN'; 
                        $policy_data->policy_p6 = $val['policy_p6'] ? $val['policy_p6'] : 'NaN'; 
                        $policy_data->policy_p7 = $val['policy_p7'] ? $val['policy_p7'] : 'NaN'; 
                        $policy_data->policy_p8 = $val['policy_p8'] ? $val['policy_p8'] : 'NaN'; 
                        $policy_data->policy_p9 = $val['policy_p9'] ? $val['policy_p9'] : 'NaN'; 
                        $policy_data->updated_at = Carbon::now();
                        $policy_data->save();
                   }

                   if (isset($request->governance)) {
                    foreach ($request->governance as $key => $data) {
                        $prod_serv_data = BrsrSectionBGovernanceQuestionValue::find($data['row_id']);
                        $prod_serv_data->director_statement = isset($data['text_a']) ? $data['text_a'] : 'NaN';
                        $prod_serv_data->authority_details = isset($data['text_b']) ? $data['text_b'] : 'NaN';
                        $prod_serv_data->committee = isset($data['text_c']) ? $data['text_c'] : 'NaN';
                        $prod_serv_data->updated_at = Carbon::now();
                        $prod_serv_data->save();
                    }
                }

                foreach ($request->emps as $val) {
                    
                    $policy1_data = BrsrSectionBNgrbcQuestionValue::find($val['row_id']);
                    $policy1_data->review_p1 = $val['review_p1'] ? $val['review_p1'] : 'NaN';
                    $policy1_data->review_p2 = $val['review_p2'] ? $val['review_p2'] : 'NaN';
                    $policy1_data->review_p3 = $val['review_p3'] ? $val['review_p3'] : 'NaN';
                    $policy1_data->review_p4 = $val['review_p4'] ? $val['review_p4'] : 'NaN';
                    $policy1_data->review_p5 = $val['review_p5'] ? $val['review_p5'] : 'NaN';
                    $policy1_data->review_p6 = $val['review_p6'] ? $val['review_p6'] : 'NaN';
                    $policy1_data->review_p7 = $val['review_p7'] ? $val['review_p7'] : 'NaN';
                    $policy1_data->review_p8 = $val['review_p8'] ? $val['review_p8'] : 'NaN';
                    $policy1_data->review_p9 = $val['review_p9'] ? $val['review_p9'] : 'NaN'; 
                    $policy1_data->frequency_p1 = $val['frequency_p1'] ? $val['frequency_p1'] : 'NaN';
                    $policy1_data->frequency_p2 = $val['frequency_p2'] ? $val['frequency_p2'] : 'NaN';
                    $policy1_data->frequency_p3 = $val['frequency_p3'] ? $val['frequency_p3'] : 'NaN';
                    $policy1_data->frequency_p4 = $val['frequency_p4'] ? $val['frequency_p4'] : 'NaN';
                    $policy1_data->frequency_p5 = $val['frequency_p5'] ? $val['frequency_p5'] : 'NaN';
                    $policy1_data->frequency_p6 = $val['frequency_p6'] ? $val['frequency_p6'] : 'NaN';
                    $policy1_data->frequency_p7 = $val['frequency_p7'] ? $val['frequency_p7'] : 'NaN';
                    $policy1_data->frequency_p8 = $val['frequency_p8'] ? $val['frequency_p8'] : 'NaN';
                    $policy1_data->frequency_p9 = $val['frequency_p9'] ? $val['frequency_p9'] : 'NaN';
                    $policy1_data->updated_at = Carbon::now();
                    $policy1_data->save();
               }
    
               foreach ($request->emp1 as $val) {
                    
                $policy_data = BrsrSectionBPolicyQuestionValue::find($val['row_id']);
                $policy_data->policy_p1 = $val['policy_p1'] ? $val['policy_p1'] : 'NaN'; 
                $policy_data->policy_p2 = $val['policy_p2'] ? $val['policy_p2'] : 'NaN'; 
                $policy_data->policy_p3 = $val['policy_p3'] ? $val['policy_p3'] : 'NaN'; 
                $policy_data->policy_p4 = $val['policy_p4'] ? $val['policy_p4'] : 'NaN'; 
                $policy_data->policy_p5 = $val['policy_p5'] ? $val['policy_p5'] : 'NaN'; 
                $policy_data->policy_p6 = $val['policy_p6'] ? $val['policy_p6'] : 'NaN'; 
                $policy_data->policy_p7 = $val['policy_p7'] ? $val['policy_p7'] : 'NaN'; 
                $policy_data->policy_p8 = $val['policy_p8'] ? $val['policy_p8'] : 'NaN'; 
                $policy_data->policy_p9 = $val['policy_p9'] ? $val['policy_p9'] : 'NaN'; 
                $policy_data->updated_at = Carbon::now();
                $policy_data->save();
           }
    
           foreach ($request->emp2 as $val) {
            
            $policy_data = BrsrSectionBPolicyQuestionValue::find($val['row_id']);
            $policy_data->policy_p1 = $val['policy_p1'] ? $val['policy_p1'] : 'NaN'; 
            $policy_data->policy_p2 = $val['policy_p2'] ? $val['policy_p2'] : 'NaN'; 
            $policy_data->policy_p3 = $val['policy_p3'] ? $val['policy_p3'] : 'NaN'; 
            $policy_data->policy_p4 = $val['policy_p4'] ? $val['policy_p4'] : 'NaN'; 
            $policy_data->policy_p5 = $val['policy_p5'] ? $val['policy_p5'] : 'NaN'; 
            $policy_data->policy_p6 = $val['policy_p6'] ? $val['policy_p6'] : 'NaN'; 
            $policy_data->policy_p7 = $val['policy_p7'] ? $val['policy_p7'] : 'NaN'; 
            $policy_data->policy_p8 = $val['policy_p8'] ? $val['policy_p8'] : 'NaN'; 
            $policy_data->policy_p9 = $val['policy_p9'] ? $val['policy_p9'] : 'NaN'; 
            $policy_data->updated_at = Carbon::now();
            $policy_data->save();
          }
            
        });
            alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
            return redirect()->back();
    }


    
}
