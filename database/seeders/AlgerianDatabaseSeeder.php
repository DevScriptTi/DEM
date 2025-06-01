<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Api\Core\Wilaya;
use App\Models\Api\Core\Baladiya;
use App\Models\Api\Core\Speciality;
use App\Models\Api\Core\Key;
use App\Models\Api\Users\Admin;
use App\Models\Api\Users\Pharmacy;
use App\Models\Api\Users\Doctor;
use App\Models\Api\Users\DoctorHelper;
use App\Models\Api\Users\Patient;
use App\Models\Api\Main\Queue;
use App\Models\Api\Main\Demand;
use App\Models\Api\Main\Prescription;
use App\Models\Api\Main\Medicine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlgerianDatabaseSeeder extends Seeder
{
    // Algerian names data
    private $algerianFirstNames = [
        'Mohamed',
        'Ahmed',
        'Ali',
        'Youssef',
        'Khaled',
        'Samir',
        'Karim',
        'Nadir',
        'Farid',
        'Bilal',
        'Fatima',
        'Amina',
        'Yasmina',
        'Leila',
        'Samira',
        'Nadia',
        'Djamila',
        'Soraya',
        'Zahra',
        'Hafsa'
    ];

    private $algerianLastNames = [
        'Benzema',
        'Boukheroufa',
        'Chaoui',
        'Dahmani',
        'Ferhat',
        'Gacem',
        'Hamdi',
        'Kadri',
        'Larbi',
        'Mansouri',
        'Nait',
        'Ouali',
        'Rahmani',
        'Saadi',
        'Taleb',
        'Zitouni',
        'Abbas',
        'Bouchenak',
        'Cherif',
        'Dridi'
    ];

    // Medical specialties
    private $specialties = [
        'Allergology',
        'Anesthesiology',
        'Cardiology',
        'Dermatology',
        'Endocrinology',
        'Gastroenterology',
        'Geriatrics',
        'Hematology',
        'Immunology',
        'Infectious Diseases',
        'Internal Medicine',
        'Nephrology',
        'Neurology',
        'Oncology',
        'Ophthalmology',
        'Otolaryngology',
        'Pediatrics',
        'Pulmonology',
        'Rheumatology',
        'Urology',
        'General Surgery',
        'Cardiac Surgery',
        'Neurosurgery',
        'Orthopedic Surgery',
        'Plastic Surgery',
        'Vascular Surgery',
        'Dental Medicine',
        'Maxillofacial Surgery',
        'Psychiatry',
        'Radiology',
        'Radiotherapy',
        'Nuclear Medicine',
        'Physical Medicine',
        'Sports Medicine',
        'Occupational Medicine',
        'Emergency Medicine',
        'Family Medicine',
        'Preventive Medicine',
        'Pathology',
        'Clinical Biology',
        'Pharmacology',
        'Toxicology',
        'Gynecology',
        'Obstetrics',
        'Reproductive Medicine',
        'Neonatology',
        'Andrology',
        'Diabetology',
        'Hepatology',
        'Proctology',
        'Angiology',
        'Phlebology',
        'Pneumology',
        'Rhinology',
        'Stomatology',
        'Traumatology',
        'Venereology',
        'Acupuncture',
        'Homeopathy',
        'Naturopathy',
        'Osteopathy',
        'Chiropractic',
        'Podiatry',
        'Dietetics',
        'Speech Therapy',
        'Physiotherapy',
        'Occupational Therapy',
        'Psychology',
        'Psychoanalysis',
        'Neuropsychology',
        'Gerontology',
        'Palliative Care',
        'Pain Management',
        'Sleep Medicine',
        'Travel Medicine',
        'Aerospace Medicine',
        'Diving Medicine',
        'Forensic Medicine',
        'Legal Medicine',
        'Military Medicine',
        'Sports Cardiology',
        'Pediatric Cardiology',
        'Interventional Cardiology',
        'Electrophysiology',
        'Echocardiography',
        'Cardiac Imaging',
        'Vascular Medicine',
        'Hypertension',
        'Heart Failure',
        'Cardiac Rehabilitation',
        'Pediatric Surgery',
        'Thoracic Surgery',
        'Colorectal Surgery',
        'Hepatobiliary Surgery',
        'Transplant Surgery',
        'Surgical Oncology',
        'Pediatric Oncology',
        'Radiation Oncology',
        'Medical Oncology',
        'Hematologic Oncology'
    ];

    // Medicine names
    private $medicines = [
        'Paracetamol',
        'Ibuprofen',
        'Amoxicillin',
        'Aspirin',
        'Omeprazole',
        'Metformin',
        'Atorvastatin',
        'Simvastatin',
        'Losartan',
        'Amlodipine',
        'Metoprolol',
        'Bisoprolol',
        'Levothyroxine',
        'Prednisone',
        'Ciprofloxacin',
        'Doxycycline',
        'Azithromycin',
        'Clarithromycin',
        'Ceftriaxone',
        'Fluconazole',
        'Tramadol',
        'Codeine',
        'Morphine',
        'Diazepam',
        'Alprazolam',
        'Sertraline',
        'Fluoxetine',
        'Venlafaxine',
        'Duloxetine',
        'Quetiapine',
        'Risperidone',
        'Olanzapine',
        'Lithium',
        'Valproate',
        'Carbamazepine',
        'Phenytoin',
        'Gabapentin',
        'Pregabalin',
        'Sumatriptan',
        'Propranolol',
        'Montelukast',
        'Salbutamol',
        'Fluticasone',
        'Budesonide',
        'Formoterol',
        'Tiotropium',
        'Insulin',
        'Glimepiride',
        'Gliclazide',
        'Pioglitazone',
        'Furosemide',
        'Spironolactone',
        'Hydrochlorothiazide',
        'Warfarin',
        'Rivaroxaban',
        'Clopidogrel',
        'Ticagrelor',
        'Heparin',
        'Enoxaparin',
        'Ferrous Sulfate',
        'Folic Acid',
        'Vitamin B12',
        'Vitamin D',
        'Calcium',
        'Magnesium',
        'Potassium',
        'Zinc',
        'Selenium',
        'Coenzyme Q10',
        'Melatonin',
        'Finasteride',
        'Tamsulosin',
        'Sildenafil',
        'Tadalafil',
        'Dutasteride',
        'Cyproterone',
        'Ethinylestradiol',
        'Levonorgestrel',
        'Medroxyprogesterone',
        'Mifepristone',
        'Misoprostol',
        'Clomifene',
        'Tamoxifen',
        'Letrozole',
        'Anastrozole',
        'Bicalutamide',
        'Flutamide',
        'Leuprolide',
        'Goserelin',
        'Octreotide',
        'Somatropin',
        'Desmopressin',
        'Hydrocortisone',
        'Fludrocortisone',
        'Testosterone',
        'Estradiol',
        'Progesterone',
        'Thyroxine',
        'Liothyronine',
        'Propylthiouracil',
        'Methimazole',
        'Calcitonin',
        'Teriparatide',
        'Zoledronic Acid',
        'Alendronic Acid'
    ];

    public function run()
    {
        // Create admin
        // $this->createAdmin();

        // Create specialties
        // $this->createSpecialties();

        // Get all wilayas and baladiyas
        $wilayas = Wilaya::all();
        $baladiyas = Baladiya::all();

        // Create doctors and their helpers
        // $this->createDoctorsAndHelpers($baladiyas);

        // Create patients
        // $this->createPatients($baladiyas);

        // Create pharmacies
        // $this->createPharmacies($baladiyas);

        // Get all doctors
        $doctors = Doctor::all();

        // Create queues and demands
        $this->createQueuesAndDemands($doctors);

        // Create prescriptions and medicines
        // $this->createPrescriptionsAndMedicines($doctors);
    }

    private function createAdmin()
    {
        $admin = Admin::create([
            'username' => 'admin',
            'name' => 'Admin',
            'last' => 'System',
            'is_super' => 'yes'
        ]);
        $admin->key()->create();

        $this->command->info('Admin created successfully.');
    }

    private function createSpecialties()
    {
        foreach ($this->specialties as $specialty) {
            Speciality::create(['name' => $specialty]);
        }

        $this->command->info('Specialties created successfully.');
    }

    private function createDoctorsAndHelpers($baladiyas)
    {
        foreach ($baladiyas as $baladiya) {
            // Create doctor
            $doctor = Doctor::create([
                'username' => Str::slug($baladiya->name) . '_doc',
                'name' => $this->algerianFirstNames[array_rand($this->algerianFirstNames)],
                'last' => $this->algerianLastNames[array_rand($this->algerianLastNames)],
                'date_of_birth' => now()->subYears(rand(30, 60))->format('Y-m-d'),
                'phone' => '05' . rand(40, 79) . rand(100000, 999999),
                'email' => 'doctor_' . Str::slug($baladiya->name) . '@example.com',
                'baladiya_id' => $baladiya->id,
                'speciality_id' => rand(1, 100),
                'description' => 'Doctor in ' . $baladiya->name,
                'status' => rand(0, 1) ? 'online' : 'offline'
            ]);

            if (rand(0, 1)) {
                $doctor->key()->create();
            }


            // Create doctor helper
            $doctor_helper = DoctorHelper::create([
                'username' => Str::slug($baladiya->name) . '_helper',
                'name' => $this->algerianFirstNames[array_rand($this->algerianFirstNames)],
                'last' => $this->algerianLastNames[array_rand($this->algerianLastNames)],
                'date_of_birth' => now()->subYears(rand(20, 50))->format('Y-m-d'),
                'phone' => '05' . rand(40, 79) . rand(100000, 999999),
                'email' => 'helper_' . Str::slug($baladiya->name) . '@example.com',
                'doctor_id' => $doctor->id
            ]);
            if (rand(0, 1)) {
                $doctor_helper->key()->create();
            }
        }

        $this->command->info('Doctors and their helpers created successfully.');
    }

    private function createPatients($baladiyas)
    {
        foreach ($baladiyas as $baladiya) {
            $patientCount = rand(0, 20);

            for ($i = 0; $i < $patientCount; $i++) {
                $patient = Patient::create([
                    'username' => Str::slug($baladiya->name) . '_patient_' . ($i + 1),
                    'name' => $this->algerianFirstNames[array_rand($this->algerianFirstNames)],
                    'last' => $this->algerianLastNames[array_rand($this->algerianLastNames)],
                    'date_of_birth' => now()->subYears(rand(5, 80))->format('Y-m-d'),
                    'phone' => '05' . rand(40, 79) . rand(100000, 999999),
                    'email' => 'patient_' . ($i + 1) . '_' . Str::slug($baladiya->name) . '@example.com',
                    'baladiya_id' => $baladiya->id,
                    'description' => 'Patient from ' . $baladiya->name
                ]);
                if ($i % 2 == 0) {
                    $patient->key()->create();
                }
            }
        }

        $this->command->info('Patients created successfully.');
    }

    private function createPharmacies($baladiyas)
    {
        foreach ($baladiyas as $baladiya) {
            $pharmacy = Pharmacy::create([
                'username' => Str::slug($baladiya->name) . '_pharmacy',
                'name' => $this->algerianFirstNames[array_rand($this->algerianFirstNames)],
                'last' => $this->algerianLastNames[array_rand($this->algerianLastNames)],
                'pharmacy_name' => 'Pharmacie ' . $baladiya->name,
                'date_of_birth' => now()->subYears(rand(25, 60))->format('Y-m-d'),
                'phone' => '05' . rand(40, 79) . rand(100000, 999999),
                'email' => 'pharmacy_' . Str::slug($baladiya->name) . '@example.com',
                'baladiya_id' => $baladiya->id
            ]);
            if (rand(0, 1)) {
                $pharmacy->key()->create();
            }
        }

        $this->command->info('Pharmacies created successfully.');
    }

    private function createQueuesAndDemands($doctors)
    {
        foreach ($doctors as $doctor) {
            $patients = Patient::where('baladiya_id', $doctor->baladiya_id)->get();

            $queue = Queue::create([
                'date' => now()->addDays(rand(0, 7))->format('Y-m-d'),
                'doctor_id' => $doctor->id
            ]);

            $demandCount = rand(1, 5);
            $selectedPatients = $patients->random(min($demandCount, $patients->count()));

            $demands = [];
            foreach ($selectedPatients as $patient) {
                $demands[] = Demand::create([
                    'date' => $queue->date,
                    'status' => $this->getRandomStatus(),
                    'queue_id' => $queue->id,
                    'patient_id' => $patient->id
                ]);
            }

            // Update current demand if there are demands
            if (count($demands) > 0) {
                $queue->update([
                    'current_demand_id' => $demands[array_rand($demands)]->id
                ]);
            }
        }

        $this->command->info('Queues and demands created successfully.');
    }

    private function createPrescriptionsAndMedicines($doctors)
    {
        foreach ($doctors as $doctor) {
            $prescriptionCount = rand(1, 20);
            $patients = Patient::where('baladiya_id', $doctor->baladiya_id)->get();
            $pharmacies = Pharmacy::where('baladiya_id', $doctor->baladiya_id)->get();

            // Skip if no patients or pharmacies exist for this doctor's baladiya
            if ($patients->isEmpty() || $pharmacies->isEmpty()) {
                continue;
            }

            for ($i = 0; $i < $prescriptionCount; $i++) {
                $prescription = Prescription::create([
                    'date' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                    'pharmacy_id' => $pharmacies->random()->id,
                    'doctor_id' => $doctor->id,
                    'patient_id' => $patients->random()->id
                ]);

                $medicineCount = rand(1, 3);
                for ($j = 0; $j < $medicineCount; $j++) {
                    Medicine::create([
                        'name' => $this->medicines[array_rand($this->medicines)],
                        'description' => 'Take ' . rand(1, 3) . ' times per day',
                        'prescription_id' => $prescription->id
                    ]);
                }
            }
        }

        $this->command->info('Prescriptions and medicines created successfully.');
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'completed', 'rejected', 'on diagnostic'];
        return $statuses[array_rand($statuses)];
    }
}
