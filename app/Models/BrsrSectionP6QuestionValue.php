<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP6QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p6_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'tot_energy_current_fy',
        'tot_energy_previous_fy_id',
        'tot_energy_previous_fy',
        'entity_sites',
        'disclosure_current_fy',
        'disclosure_previous_fy_id',
        'disclosure_previous_fy',
        'water_discharge_current_fy',
        'water_discharge_previous_fy_id',
        'water_discharge_previous_fy',
        'zero_liquid',
        'air_emission_unit',
        'air_emission_current_fy',
        'air_emission_previous_fy_id',
        'air_emission_previous_fy',
        'gas_emission_unit',
        'gas_emission_current_fy',
        'gas_emission_previous_fy_id',
        'gas_emission_previous_fy',
        'ghg_emission',
        'waste_management_current_fy',
        'waste_management_previous_fy_id',
        'waste_management_previous_fy',
        'waste_management_practices',
        'area_water_stress',
        'consumption_current_fy',
        'consumption_previous_fy_id',
        'consumption_previous_fy',
        'scope3_unit',
        'scope3_current_fy',
        'scope3_previous_fy_id',
        'scope3_previous_fy',
        'direct_indirect_impact',
        'business_continuity',
        'adverse_impact',
        'value_chain_partners',
        'created_at',
        'updated_at',
    ];

}
