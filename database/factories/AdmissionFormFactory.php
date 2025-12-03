<?php

namespace Database\Factories;

use App\Models\AdmissionForm;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdmissionFormFactory extends Factory
{
    protected $model = AdmissionForm::class;

    public function definition(): array
    {
        $programs = [
            'BSc in Software Engineering',
            'BSc in Computer Science',
            'BBA in Marketing',
            'MBA in Finance',
            'MSc in Data Science',
            'MSc in Artificial Intelligence',
            'MBBS',
            'LLB',
            '軟體工程理學士學位',
        ];

        $batchs = [
            '2025 Spring Batch',
            '2025 Fall Batch',
            '2026 Spring Batch',
            '2026 Fall Batch',
        ];

        $types = [
            'Annual',
            'Semister',
        ];

        return [
            'university_id' => University::inRandomOrder()->first()->id,
            'title' => $this->faker->randomElement($batchs),
            'description' => $this->faker->paragraph(),
            'form_fields' => [],
            'application_fee' => rand(30, 200),
            'isPublished' => true,
            'isActive' => true,
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 months'),

            // Extra fields
            'offer_title' => $this->faker->randomElement($programs),
            'intake' => 'Fall ' . rand(2025, 2027),
            'degree' => $this->faker->randomElement(['Bachelor', 'Master', 'Doctorate']),
            'major' => $this->faker->word(),
            'teaching_language' => $this->faker->randomElement(['English', 'Chinese']),
            'scholarship_type' => $this->faker->randomElement(['Full', 'Partial', 'None']),
            'location' => $this->faker->city(),

            'university_name_override' => null,
            'tuition_fees' => rand(2000, 8000),
            'dorm_fees' => rand(300, 1500),

            'medical_fees' => rand(50, 300),
            'insurance_fees' => rand(50, 300),
            'resident_permit_fee' => rand(100, 300),
            'text_book_fee' => rand(50, 200),
            'deposit_fee' => rand(100, 200),
            'dorm_deposit' => rand(100, 200),
            'other_fees' => rand(50, 500),

            'scholarship_coverage' => '50%',
            'stipend_amount' => rand(200, 800),
            'scholarship_other_facilities' => 'Free dorm + medical',
            'after_scholarship_tuition_fees' => rand(500, 2000),
            'after_scholarship_dorm_fees' => rand(50, 200),

            'age_restriction' => '18-28',
            'country_restriction' => $this->faker->optional()->country(),
            'accept_in_china' => $this->faker->boolean(),
            'accept_studied_in_china' => $this->faker->boolean(),
            'has_exclusive_service_policy' => $this->faker->boolean(),
            'has_premium_service_policy' => $this->faker->boolean(),

            'exclusive_partner_rate'=> rand(100, 500),
            'exclusive_student_rate'=> rand(100, 500),
            'premium_partner_rate'=> rand(100, 500),
            'premium_student_rate'=> rand(100, 500),
            'tuition_fee_type'=> $this->faker->randomElement($types),
            'dorm_fee_type'=> $this->faker->randomElement($types),
            'after_scholarship_tuition_fee_type'=> $this->faker->randomElement($types),
            'after_scholarship_dorm_fee_type'=> $this->faker->randomElement($types),
        ];
    }
}

