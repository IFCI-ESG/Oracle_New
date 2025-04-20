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
use Illuminate\Support\Facades\Http;
use Auth;
use DB;
use Carbon\Carbon;
use Log;

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
        
        $quesMast = BrsrSectionAQuestionMaster::where('status', 1)->orderby('id')->get();
        $brsr_value = BrsrQuestionValue::where('com_id', $user->id)->orderby('id')->get();
        $brsr_sectionb = BrsrSectionBPolicyQuestionValue::where('com_id', $user->id)->orderby('id')->get();
        
        $fys = DB::table('fy_masters')->orderBy('id', 'desc')->limit(1)->get();

        $social_mast = BrsrMast::where('com_id', $user->id)->orderby('id')->get();
         
        return view('user.brsr.index', compact('brsr_sectionb','fys','quesMast','brsr_value','social_mast'));
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
            'year' => $prior_previous_year,
            'Section' => 'GN',
            'Question' => 'E20',
            'BRSR_ID' => 'X9'
        ];
    
        $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzY4OTEyODk1LCJpYXQiOjE3MzczNzY4OTUsImp0aSI6ImFiNjgxMmQxOWFlNTRjMDFhYWQyN2NjODY5ODI2NmUyIiwidXNlcl9pZCI6NH0.fbeXrf5QUjjY4sAUtjE4RjElsaeUWdm6HQ1Fl56Zv6w')
            ->post('http://13.200.249.135:7000/api/get-all-data-by-cin/', $prepostData);
    
        $prior_previous_turnover_male = '0%'; 
        if ($response->successful()) {
            $data = $response->json();
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
       
        return view('user.brsr.sectionBcreate', compact('state_quesMast','entity_quesMast','ngrbc_quesMast','current_fy','previous_fy', 'prior_previous_fy', 'quesMast','user','fys','fy_id','employees_quesMast','participation_quesMast','turnover_quesMast','policy_quesMast'));

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
     
       
        

     
        $fys = DB::table('fy_masters')->where('id',$brsr_mast->fy_id)->first();
        $current_fy = $fys->fy;
        $startYear = (int)substr($current_fy, 0, 4);
        $previous_fy = ($startYear - 1) . '-' . substr($startYear, 2, 2);
        $prior_previous_fy = ($startYear - 2) . '-' . substr($startYear - 1, 2, 2);
    
        return view('user.brsr.sectionBedit', compact('current_fy', 'previous_fy', 'prior_previous_fy','fys','user',
        'brsr_mast','policy_quesMast','entity_quesMast','ngrbc_quesMast','state_quesMast','policy_value'));
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
    


    
}