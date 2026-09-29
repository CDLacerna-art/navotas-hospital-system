<?php

namespace App\Http\Controllers;

use App\Support\HospitalData;

class HospitalController extends Controller
{
    public function home()
    {
        $departments = HospitalData::departments();
        $doctors     = HospitalData::doctors();
        $nurses      = HospitalData::nurses();

        return view('home', [
            'page'          => 'home',
            'currentTitle'  => 'Home',
            'services'      => HospitalData::services(),
            'stats'         => HospitalData::homeStats(),
            'contacts'      => HospitalData::emergencyContacts(),
            'whyChooseUs'   => HospitalData::whyChooseUs(),
            'announcements' => HospitalData::announcements(),
            // Featured = the department heads / senior staff
            'featuredDepartments' => array_slice($departments, 0, 4),
            'featuredDoctors'     => array_slice($doctors, 0, 4),
            'featuredNurses'      => array_slice($nurses, 0, 4),
        ]);
    }

    public function department()
    {
        $doctors = HospitalData::doctors();

        // Attach the doctors assigned to each department (for avatars + names)
        $departments = array_map(function ($dept) use ($doctors) {
            $dept['assigned'] = array_values(array_filter(
                $doctors,
                fn ($d) => str_starts_with($dept['name'], $d['department'])
            ));
            return $dept;
        }, HospitalData::departments());

        return view('department', [
            'page'         => 'department',
            'currentTitle' => 'Home - Department',
            'departments'  => $departments,
            'hospitals'    => HospitalData::hospitals(),
        ]);
    }

    public function doctor()
    {
        $doctors = HospitalData::doctors();

        return view('doctor', [
            'page'         => 'doctor',
            'currentTitle' => 'Home - Doctor',
            'doctors'      => $doctors,
            'departments'  => array_values(array_unique(array_column($doctors, 'department'))),
            'ranks'        => ['Head Doctor', 'Attending Physician', 'Resident', 'Intern'],
        ]);
    }

    public function nurse()
    {
        $nurses = HospitalData::nurses();

        return view('nurse', [
            'page'         => 'nurse',
            'currentTitle' => 'Home - Nurse',
            'nurses'       => $nurses,
            'departments'  => array_values(array_unique(array_column($nurses, 'department'))),
        ]);
    }

    public function monitorHospital()
    {
        return view('monitor_hospital', [
            'page'         => 'monitor_hospital',
            'currentTitle' => 'Home - Monitor Hospital',
            'heading'      => 'Live Operations & Admission Center',
            'm'            => HospitalData::monitor(),
            'hospitals'    => HospitalData::hospitals(),
        ]);
    }

    public function login()
    {
        return view('auth.login', [
            'page'         => 'login',
            'currentTitle' => 'Login',
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'page'         => 'register',
            'currentTitle' => 'Register',
        ]);
    }

    public function information()
    {
        return view('auth.information', [
            'page'         => 'information',
            'currentTitle' => 'Personal Information',
        ]);
    }
}
