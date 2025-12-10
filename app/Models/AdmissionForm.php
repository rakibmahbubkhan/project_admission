<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionForm extends Model
{
    use HasFactory;

    protected $table = 'admission_forms'; // VERY IMPORTANT

    protected $fillable = [
        'university_id',
        'title',
        'description',
        'form_fields',
        'required_documents',
        'application_fee',
        'isPublished',
        'isActive',
        'deadline',
        // New Fields
        'offer_title', 
        'intake', 
        'degree', 
        'major', 
        'teaching_language', 
        'scholarship_type', 
        'location', 
        'university_name_override',
        'tuition_fees', 
        'dorm_fees', 
        'medical_fees', 
        'insurance_fees', 
        'resident_permit_fee', 
        'text_book_fee', 
        'deposit_fee', 
        'dorm_deposit', 
        'other_fees',
        'scholarship_coverage', 
        'stipend_amount', 
        'scholarship_other_facilities',
        'after_scholarship_tuition_fees', 
        'after_scholarship_dorm_fees',
        'age_restriction', 
        'country_restriction', 
        'accept_in_china', 
        'accept_studied_in_china',
        'has_exclusive_service_policy', 
        'has_premium_service_policy', 
        'exclusive_partner_rate',
        'exclusive_student_rate',
        'premium_partner_rate',
        'premium_student_rate',
        'tuition_fee_type',
        'dorm_fee_type',
        'after_scholarship_tuition_fee_type',
        'after_scholarship_dorm_fee_type',
    ];

    protected $casts = [
        'form_fields' => 'array',
        'required_documents' => 'array',
        'isPublished' => 'boolean',
        'isActive' => 'boolean',
        'accept_in_china' => 'boolean',
        'accept_studied_in_china' => 'boolean',
        'has_exclusive_service_policy' => 'boolean',
        'has_premium_service_policy' => 'boolean',
    ];

    
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    // All submissions from students
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'form_id');
    }

    // If you later allow structured sections (builder 2.0)
    public function sections()
    {
        return $this->hasMany(Section::class, 'admission_form_id')->orderBy('order');
    }


    //  public function sections()
    // {
    //     return $this->hasMany(Section::class, 'form_id')->orderBy('order');
    // }

    // Questions under each form (if not using form_fields JSON)
    public function questions()
    {
        return $this->hasMany(Question::class, 'form_id')->orderBy('order');
    }

    // Applications created by students (if using Application model)
    public function applications()
    {
        return $this->hasMany(Application::class, 'form_id');
    }

    public function formSections()
    {
        // Using standard foreign key 'admission_form_id' based on previous stack trace insights
        return $this->hasMany(Section::class, 'admission_form_id')->orderBy('order');
    }

}
