<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialQuestionValue extends Model
{
    protected $table = 'social_question_value';
    protected $fillable = [
        'id',
        'social_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'emp_male',
        'emp_female',
        'emp_others',
        'women_tot_emp',
        'women_tot_female_emp',
        'cost_incurred',
        'tot_revenue',
        'csr_details',
        'csr_activity',
        // 'sdg_id',
        'csr_impact',
        'csr_male',
        'csr_female',
        'train_tot_emp',
        'train_amt_spent',
        'emp_welfare_remark',
        'emp_welfare_doc_id',
        'created_at',
        'updated_at'
    ];
}
