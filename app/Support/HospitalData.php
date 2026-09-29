<?php

namespace App\Support;

/**
 * Realistic SAMPLE data for the Navotas Hospital System.
 *
 * Every method returns plain arrays so the views stay dumb. When you connect a
 * database later, replace the bodies of these methods with Eloquent queries
 * that return the same shape — controllers and views will not need to change.
 */
class HospitalData
{
    /* ------------------------------------------------------------------ */
    /*  Hospitals (existing hierarchy: A = COVID-19 centre, B/C/D support) */
    /* ------------------------------------------------------------------ */
    public static function hospitals(): array
    {
        return [
            ['code' => 'Hospital A', 'role' => 'COVID-19 Center',        'beds' => 120, 'occupied' => 104, 'primary' => true],
            ['code' => 'Hospital B', 'role' => 'Supporting hospital — Trauma & Emergency', 'beds' => 90,  'occupied' => 90,  'primary' => false],
            ['code' => 'Hospital C', 'role' => 'Supporting hospital — Maternal & Child',   'beds' => 70,  'occupied' => 42,  'primary' => false],
            ['code' => 'Hospital D', 'role' => 'Supporting hospital — Surgical & Critical Care', 'beds' => 60,  'occupied' => 51,  'primary' => false],
        ];
    }

    /* ------------------------------------------------------------------ */
    /*  Departments                                                        */
    /* ------------------------------------------------------------------ */
    public static function departments(): array
    {
        return [
            [
                'slug' => 'general-medicine', 'name' => 'General Medicine', 'hospital' => 'Hospital A', 'icon' => 'fa-stethoscope',
                'description' => 'Primary adult care, COVID-19 screening and treatment, and management of chronic conditions.',
                'services' => ['Adult Consultation', 'COVID-19 Care', 'Diabetes Clinic', 'Hypertension Clinic'],
                'head' => 'Dr. Ramon C. Villanueva', 'doctors' => 6, 'nurses' => 18, 'beds' => 60, 'occupied' => 55,
                'phone' => '(02) 8282-1120', 'hours' => 'Mon–Sat · 7:00 AM – 5:00 PM',
            ],
            [
                'slug' => 'trauma', 'name' => 'Trauma Level 1', 'hospital' => 'Hospital B', 'icon' => 'fa-truck-medical',
                'description' => '24/7 emergency and trauma centre for accidents, critical injuries and life-threatening cases.',
                'services' => ['Emergency Resuscitation', 'Orthopedic Trauma', 'Burn Care', 'Ambulance Dispatch'],
                'head' => 'Dr. Marco A. Dizon', 'doctors' => 8, 'nurses' => 26, 'beds' => 30, 'occupied' => 30,
                'phone' => '(02) 8282-1111', 'hours' => 'Open 24 / 7',
            ],
            [
                'slug' => 'cardiology', 'name' => 'Cardiology', 'hospital' => 'Hospital A', 'icon' => 'fa-heart-pulse',
                'description' => 'Diagnosis and treatment of heart disease with non-invasive testing and cardiac rehabilitation.',
                'services' => ['ECG & 2D Echo', 'Stress Test', 'Cardiac Rehab', 'Pacemaker Clinic'],
                'head' => 'Dr. Elena S. Magpantay', 'doctors' => 5, 'nurses' => 12, 'beds' => 24, 'occupied' => 19,
                'phone' => '(02) 8282-1135', 'hours' => 'Mon–Fri · 8:00 AM – 4:00 PM',
            ],
            [
                'slug' => 'neonatal-pediatrics', 'name' => 'Neonatal Pediatrics', 'hospital' => 'Hospital C', 'icon' => 'fa-baby',
                'description' => 'Specialised care for newborns, infants and children, including a Level II neonatal unit.',
                'services' => ['NICU', 'Well-Baby Clinic', 'Immunization', 'Pediatric Emergency'],
                'head' => 'Dr. Patricia L. Bautista', 'doctors' => 6, 'nurses' => 20, 'beds' => 35, 'occupied' => 21,
                'phone' => '(02) 8282-1150', 'hours' => 'Mon–Sat · 7:00 AM – 6:00 PM',
            ],
            [
                'slug' => 'surgical-icu', 'name' => 'Surgical ICU', 'hospital' => 'Hospital D', 'icon' => 'fa-bed-pulse',
                'description' => 'Intensive post-operative and critical care with continuous monitoring by specialist teams.',
                'services' => ['Post-Op Monitoring', 'Ventilator Support', 'Dialysis', 'Critical Care'],
                'head' => 'Dr. Joaquin T. Reyes', 'doctors' => 5, 'nurses' => 22, 'beds' => 20, 'occupied' => 17,
                'phone' => '(02) 8282-1170', 'hours' => 'Open 24 / 7',
            ],
            [
                'slug' => 'obstetrics', 'name' => 'Obstetrics & Gynecology', 'hospital' => 'Hospital C', 'icon' => 'fa-person-pregnant',
                'description' => 'Prenatal, delivery and postnatal care in a safe, family-centred environment.',
                'services' => ['Prenatal Check-up', 'Normal & CS Delivery', 'Family Planning', 'Ultrasound'],
                'head' => 'Dr. Angelica M. Torres', 'doctors' => 4, 'nurses' => 14, 'beds' => 28, 'occupied' => 16,
                'phone' => '(02) 8282-1155', 'hours' => 'Mon–Sat · 7:00 AM – 5:00 PM',
            ],
        ];
    }

    /* ------------------------------------------------------------------ */
    /*  Doctors — hierarchy: Head Doctor → Attending → Resident → Intern   */
    /* ------------------------------------------------------------------ */
    public static function doctors(): array
    {
        $rows = [
            [1,  'Dr. Ramon C. Villanueva',  'Internal Medicine',      'General Medicine',      'Head Doctor',        24, 'MD, FPCP, FPSMID',         'Hospital A', 'Available',       'Mon–Fri · 8 AM – 4 PM',  '2101', 'Chief of Medical Services with over two decades leading internal medicine and the COVID-19 response.'],
            [2,  'Dr. Marco A. Dizon',       'Trauma Surgery',         'Trauma Level 1',        'Head Doctor',        19, 'MD, FPCS, FACS',           'Hospital B', 'In Surgery',      'On call · 24 / 7',       '2201', 'Leads the Level 1 trauma team and coordinates city-wide emergency response.'],
            [3,  'Dr. Elena S. Magpantay',   'Cardiology',             'Cardiology',            'Head Doctor',        21, 'MD, FPCC, FPSE',           'Hospital A', 'Available',       'Mon–Fri · 8 AM – 4 PM',  '2135', 'Interventional cardiologist focused on preventive heart care and rehabilitation.'],
            [4,  'Dr. Patricia L. Bautista', 'Neonatology',            'Neonatal Pediatrics',   'Head Doctor',        17, 'MD, FPPS, PSNbM',          'Hospital C', 'In Consultation', 'Mon–Sat · 7 AM – 3 PM',  '2150', 'Neonatologist who established the Level II NICU serving Navotas families.'],
            [5,  'Dr. Joaquin T. Reyes',     'Critical Care',          'Surgical ICU',          'Head Doctor',        20, 'MD, FPCCP, FCCM',          'Hospital D', 'Available',       'Rotating · 24 / 7',      '2170', 'Intensivist overseeing post-operative and ventilator care.'],
            [6,  'Dr. Angelica M. Torres',   'Obstetrics & Gynecology','Obstetrics',            'Attending Physician', 12, 'MD, FPOGS',                'Hospital C', 'In Surgery',      'Mon–Sat · 7 AM – 5 PM',  '2155', 'Provides high-risk pregnancy care and minimally invasive gynecologic surgery.'],
            [7,  'Dr. Benedict N. Aquino',   'Diagnostic Radiology',   'Radiology',             'Attending Physician', 14, 'MD, FPCR',                 'Hospital D', 'Available',       'Mon–Sat · 8 AM – 6 PM',  '2180', 'Specialises in CT and ultrasound-guided procedures.'],
            [8,  'Dr. Cristina V. Salonga',  'Clinical Pathology',     'Laboratory',            'Attending Physician', 15, 'MD, FPSP, DPSP',           'Hospital A', 'On Leave',        'Returns Oct 6',          '2190', 'Directs laboratory quality assurance and RT-PCR operations.'],
            [9,  'Dr. Miguel R. Santos',     'Emergency Medicine',     'Trauma Level 1',        'Attending Physician',  9, 'MD, FPCEM',                'Hospital B', 'Available',       'Shift · 6 PM – 6 AM',    '2205', 'Emergency physician experienced in mass-casualty triage.'],
            [10, 'Dr. Lorraine J. Cruz',     'Pediatrics',             'Neonatal Pediatrics',   'Resident',             4, 'MD, PPS Resident',         'Hospital C', 'Busy', 'Mon–Sat · 7 AM – 3 PM',  '2152', 'Third-year pediatric resident rotating through NICU and the pediatric ward.'],
            [12, 'Dr. Katrina D. Ramos',     'Cardiology',             'Cardiology',            'Resident',             2, 'MD, PCC Fellow-in-training','Hospital A', 'Available',       'Mon–Fri · 8 AM – 4 PM',  '2138', 'Cardiology trainee focused on non-invasive imaging.'],
            [13, 'Dr. Nathaniel B. Flores',  'Surgery',                'Surgical ICU',          'Resident',             3, 'MD, PCS Resident',         'Hospital D', 'In Surgery',      'Rotating · 24 / 7',      '2174', 'General surgery resident supporting scheduled and emergency operations.'],

        ];

        return array_map(fn ($r) => [
            'id' => $r[0], 'name' => $r[1], 'title' => $r[2], 'department' => $r[3], 'rank' => $r[4],
            'experience' => $r[5], 'credentials' => $r[6], 'hospital' => $r[7], 'status' => $r[8],
            'schedule' => $r[9], 'local' => $r[10], 'bio' => $r[11],
        ], $rows);
    }

    /* ------------------------------------------------------------------ */
    /*  Nurses                                                             */
    /* ------------------------------------------------------------------ */
    public static function nurses(): array
    {
        $rows = [
            [1,  'Nurse Maria Theresa Domingo', 'Chief Nurse',           'General Medicine',    'Head Nurse',   22, 'RN, MAN, CCRN',       'Hospital A', 'On Duty',  'Day · 7 AM – 3 PM',     '3101', 'Oversees nursing standards and staffing across all four hospitals.'],
            [2,  'Nurse Rosalie P. Estrada',    'Emergency Nursing',     'Trauma Level 1',      'Head Nurse',   16, 'RN, MAN, ENPC',       'Hospital B', 'On Duty',  'Night · 7 PM – 7 AM',   '3201', 'Leads triage and trauma nursing with ACLS and ENPC certification.'],
            [3,  'Nurse Jennifer A. Castillo',  'Critical Care Nursing', 'Surgical ICU',        'Charge Nurse', 12, 'RN, CCRN, ACLS',      'Hospital D', 'On Duty',  'Day · 7 AM – 7 PM',     '3170', 'ICU charge nurse coordinating ventilator and dialysis care.'],
            [4,  'Nurse Angelo R. Pascual',     'Cardiac Nursing',       'Cardiology',          'Charge Nurse', 10, 'RN, ACLS, BLS',       'Hospital A', 'On Rounds','Day · 7 AM – 3 PM',     '3135', 'Cardiac unit charge nurse specialising in telemetry monitoring.'],
            [5,  'Nurse Camille S. Ocampo',     'Neonatal Nursing',      'Neonatal Pediatrics', 'Charge Nurse', 11, 'RN, NRP, S-NICU',     'Hospital C', 'On Duty',  'Day · 7 AM – 3 PM',     '3150', 'NICU charge nurse trained in neonatal resuscitation.'],
            [6,  'Nurse Kristine L. Aguilar',   'Obstetric Nursing',     'Obstetrics',          'Staff Nurse',   7, 'RN, BLS, NRP',        'Hospital C', 'On Duty',  'Evening · 3 PM – 11 PM','3155', 'Labor and delivery nurse supporting prenatal and postpartum care.'],
            [7,  'Nurse Daniel V. Soriano',     'Emergency Nursing',     'Trauma Level 1',      'Staff Nurse',   6, 'RN, ACLS, PALS',      'Hospital B', 'Off Duty', 'Night · 7 PM – 7 AM',   '3205', 'Emergency room nurse and certified trauma responder.'],
            [8,  'Nurse Angela M. Hernandez',   'Medical-Surgical',      'General Medicine',    'Staff Nurse',   5, 'RN, BLS',             'Hospital A', 'On Duty',  'Day · 7 AM – 3 PM',     '3108', 'Provides ward care for COVID-19 and general medicine patients.'],
            [9,  'Nurse Patrick J. Lim',        'Critical Care Nursing', 'Surgical ICU',        'Staff Nurse',   4, 'RN, BLS, ACLS',       'Hospital D', 'On Rounds','Night · 7 PM – 7 AM',   '3174', 'ICU nurse monitoring post-operative patients.'],
            [10, 'Nurse Bianca R. Tolentino',   'Pediatric Nursing',     'Neonatal Pediatrics', 'Staff Nurse',   3, 'RN, PALS',            'Hospital C', 'On Duty',  'Evening · 3 PM – 11 PM','3152', 'Pediatric ward nurse and immunization coordinator.'],
            [11, 'Nurse Ellaine G. Manalo',     'Radiology Nursing',     'Radiology',           'Staff Nurse',   8, 'RN, BLS, IV Cert.',   'Hospital D', 'On Duty',  'Day · 8 AM – 4 PM',     '3180', 'Assists imaging procedures and contrast administration.'],
            [12, 'Nurse Mark Anthony B. Ramos', 'Laboratory Nursing',    'Laboratory',          'Staff Nurse',   5, 'RN, Phlebotomy Cert.','Hospital A', 'On Leave', 'Returns Oct 3',         '3190', 'Specimen collection and RT-PCR sampling lead.'],
        ];

        return array_map(fn ($r) => [
            'id' => $r[0], 'name' => $r[1], 'title' => $r[2], 'department' => $r[3], 'rank' => $r[4],
            'experience' => $r[5], 'credentials' => $r[6], 'hospital' => $r[7], 'status' => $r[8],
            'schedule' => $r[9], 'local' => $r[10], 'bio' => $r[11],
        ], $rows);
    }

    /* ------------------------------------------------------------------ */
    /*  Home page content                                                  */
    /* ------------------------------------------------------------------ */
    public static function services(): array
    {
        return [
            ['icon' => 'fa-truck-medical',  'title' => 'Emergency & Trauma',   'text' => 'Round-the-clock resuscitation, ambulance dispatch and Level 1 trauma care.'],
            ['icon' => 'fa-user-doctor',    'title' => 'Outpatient Clinics',   'text' => 'Specialist consultations across medicine, pediatrics, OB-GYN and cardiology.'],
            ['icon' => 'fa-flask-vial',     'title' => 'Laboratory & Imaging', 'text' => 'RT-PCR, blood bank, X-ray, CT scan and ultrasound with quick turnaround.'],
            ['icon' => 'fa-bed-pulse',      'title' => 'Inpatient & ICU',      'text' => 'Comfortable wards and monitored intensive care units for complex cases.'],
            ['icon' => 'fa-baby',           'title' => 'Maternal & Newborn',   'text' => 'Prenatal, delivery, NICU and immunization programs for young families.'],
            ['icon' => 'fa-pills',          'title' => 'Pharmacy',             'text' => 'On-site pharmacy with subsidized medicines for qualified Navoteños.'],
        ];
    }

    public static function homeStats(): array
    {
        return [
            ['icon' => 'fa-hospital-user', 'value' => '48,520', 'label' => 'Patients treated this year', 'tone' => 'teal'],
            ['icon' => 'fa-user-doctor',   'value' => '86',     'label' => 'Doctors & specialists',      'tone' => 'blue'],
            ['icon' => 'fa-user-nurse',    'value' => '214',    'label' => 'Licensed nurses',            'tone' => 'violet'],
            ['icon' => 'fa-bed',           'value' => '340',    'label' => 'Beds across 4 hospitals',    'tone' => 'green'],
        ];
    }

    public static function whyChooseUs(): array
    {
        return [
            ['icon' => 'fa-circle-check', 'title' => 'Private-hospital quality', 'text' => 'Modern equipment and board-certified specialists.'],
            ['icon' => 'fa-hand-holding-heart', 'title' => 'Affordable & accessible', 'text' => 'City-funded programs keep care within reach.'],
            ['icon' => 'fa-clock', 'title' => 'Always open', 'text' => 'Emergency and ICU services run 24 hours a day.'],
            ['icon' => 'fa-shield-heart', 'title' => 'Safe, connected care', 'text' => 'Four coordinated hospitals share one patient system.'],
        ];
    }

    public static function announcements(): array
    {
        return [
            ['date' => 'Sep 28, 2026', 'tag' => 'Health Advisory', 'tone' => 'red',    'title' => 'Free flu & pneumonia vaccination for seniors',  'text' => 'Every Saturday at Hospital A — bring a valid Navotas senior ID.'],
            ['date' => 'Sep 25, 2026', 'tag' => 'Facility',        'tone' => 'blue',   'title' => 'New CT scanner now operating at Hospital D',    'text' => 'Faster scans with reduced radiation for adult and pediatric patients.'],
            ['date' => 'Sep 20, 2026', 'tag' => 'Community',       'tone' => 'green',  'title' => 'Libreng Medical Mission this October',          'text' => 'Free consultations, dental and basic laboratory tests for all barangays.'],
        ];
    }

    public static function emergencyContacts(): array
    {
        return [
            ['icon' => 'fa-phone-volume',   'label' => 'Emergency Hotline', 'value' => '(02) 8282-1111', 'hot' => true],
            ['icon' => 'fa-truck-medical',  'label' => 'Ambulance',         'value' => '0917-555-0199',  'hot' => false],
            ['icon' => 'fa-location-dot',   'label' => 'Address',           'value' => 'Navotas City, Metro Manila', 'hot' => false],
            ['icon' => 'fa-clock',          'label' => 'Emergency Room',    'value' => 'Open 24 / 7',    'hot' => false],
        ];
    }

    /* ------------------------------------------------------------------ */
    /*  Monitor Hospital dashboard                                         */
    /* ------------------------------------------------------------------ */
    public static function monitor(): array
    {
        $hospitals = self::hospitals();
        $totalBeds = array_sum(array_column($hospitals, 'beds'));
        $occupied  = array_sum(array_column($hospitals, 'occupied'));

        return [
            // Headline stats — 45 / 23 / 14 come from the original page
            'newPatients'   => 45,
            'activeDoctors' => 23,
            'operations'    => 14,
            'totalPatients' => 287,
            'nursesOnDuty'  => 58,

            'beds' => [
                'total'     => $totalBeds,
                'occupied'  => $occupied,
                'available' => $totalBeds - $occupied,
                'percent'   => (int) round($occupied / $totalBeds * 100),
                'cleaning'  => 9,
                'critical'  => 18,
            ],

            'emergency' => [
                'level'     => 'Code Red',
                'message'   => 'Trauma Level 1 is at 100% capacity — divert non-critical cases to Hospital A.',
                'ambulances'=> ['available' => 4, 'total' => 9],
                'waitTime'  => '18 min',
                'triage'    => ['red' => 6, 'yellow' => 14, 'green' => 22],
            ],

            // 24 hourly admissions (chart)
            'trend' => [
                'labels' => array_map(fn ($h) => sprintf('%02d:00', $h), range(0, 23)),
                'values' => [8, 22, 14, 28, 42, 36, 52, 66, 60, 78, 92, 74, 88, 104, 96, 82, 90, 108, 100, 116, 124, 118, 104, 96],
            ],

            'capacity' => [
                ['label' => 'Trauma Level 1 (Hospital B)',        'value' => 100],
                ['label' => 'General Medicine (Hospital A)',      'value' => 92],
                ['label' => 'Surgical ICU (Hospital D)',          'value' => 85],
                ['label' => 'Neonatal Pediatrics (Hospital C)',   'value' => 60],
            ],

            'departmentStatus' => [
                ['name' => 'Emergency / Trauma',    'icon' => 'fa-truck-medical', 'patients' => 30, 'status' => 'Full'],
                ['name' => 'General Medicine',      'icon' => 'fa-stethoscope',   'patients' => 55, 'status' => 'Near Capacity'],
                ['name' => 'Surgical ICU',          'icon' => 'fa-bed-pulse',     'patients' => 17, 'status' => 'Near Capacity'],
                ['name' => 'Cardiology',            'icon' => 'fa-heart-pulse',   'patients' => 19, 'status' => 'Normal'],
                ['name' => 'Obstetrics & Gyne',     'icon' => 'fa-person-pregnant','patients' => 16, 'status' => 'Normal'],
                ['name' => 'Neonatal Pediatrics',   'icon' => 'fa-baby',          'patients' => 21, 'status' => 'Normal'],
            ],

            'staffing' => [
                'doctors' => ['onDuty' => 23, 'total' => 86],
                'nurses'  => ['onDuty' => 58, 'total' => 214],
                'surgery' => ['cardio' => 5, 'trauma' => 2, 'general' => 7],
            ],

            'activities' => [
                ['time' => '18:24', 'case' => 'Pt. #48211 · Male, 34',   'action' => 'Admitted after motor vehicle accident',       'dept' => 'Trauma Level 1',      'urgency' => 'Critical'],
                ['time' => '18:10', 'case' => 'Pt. #48207 · Female, 29', 'action' => 'Emergency C-section started',                 'dept' => 'Obstetrics',          'urgency' => 'High'],
                ['time' => '17:52', 'case' => 'Pt. #48190 · Male, 67',   'action' => 'Transferred from ER to Surgical ICU',          'dept' => 'Surgical ICU',        'urgency' => 'High'],
                ['time' => '17:31', 'case' => 'Pt. #48176 · Female, 4',  'action' => 'Nebulization and pediatric observation',       'dept' => 'Neonatal Pediatrics', 'urgency' => 'Medium'],
                ['time' => '17:05', 'case' => 'Pt. #48161 · Male, 52',   'action' => 'Cardiac stress test completed — stable',       'dept' => 'Cardiology',          'urgency' => 'Low'],
                ['time' => '16:40', 'case' => 'Pt. #48150 · Female, 41', 'action' => 'Discharged with medication and follow-up plan','dept' => 'General Medicine',    'urgency' => 'Low'],
            ],

            'alerts' => [
                ['level' => 'critical', 'icon' => 'fa-triangle-exclamation', 'title' => 'Trauma Level 1 at 100% capacity', 'text' => 'Activate diversion protocol to Hospital A.',      'time' => '2 min ago'],
                ['level' => 'warning',  'icon' => 'fa-bed-pulse',            'title' => 'Surgical ICU at 85%',              'text' => 'Three more beds needed for scheduled surgeries.', 'time' => '31 min ago'],
                ['level' => 'info',     'icon' => 'fa-circle-info',          'title' => 'Shift handover at 19:00',          'text' => 'Night team briefing in the main conference room.','time' => '1 hr ago'],
            ],
        ];
    }
}
