<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentsModel;
use App\Models\EmployeesModel;
use App\Models\RegionsModel;
use App\Models\ProvincesModel;
use App\Models\CitiesModel;

class DepartmentsController extends Controller
{
    public function index(){
        // Fetch departments
        $provinces = DepartmentsModel::orderby("name","asc");
   
        return view('main_admin.sample')->with("departments",$departments);
    }

    // Fetch records
    public function getEmployees($departmentid=0){
        // Fetch Employees by Departmentid
        $empData['data'] = ProvincesModel::orderby("province_name","asc")
        ->select('province_name')
        ->where('region_id', $departmentid)
        ->get();

        return response()->json($empData);
    }
}
