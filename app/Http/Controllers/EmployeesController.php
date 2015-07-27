<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EmployeeRepo;
use Salesfly\Salesfly\Managers\EmployeeManager;

class EmployeesController extends Controller {

    protected $employeeRepo;

    public function __construct(EmployeeRepo $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function index()
    {
        return View('employees.index');
    }

    public function all()
    {
        $employees = $this->employeeRepo->paginate(15);
        return response()->json($employees);
        //var_dump($employees);
    }

    public function paginatep(){
        $employees = $this->employeeRepo->paginate(15);
        return response()->json($employees);
    }


    public function form_create()
    {
        return View('employees.form_create');
    }

    public function form_edit()
    {
        return View('employees.form_edit');
    }

    public function create(Request $request)
    {
        $employee = $this->employeeRepo->getModel();
       
        $manager = new EmployeeManager($employee,$request->except('fechanac'));
        
        $manager->save();
        if($this->employeeRepo->validateDate(substr($request->input('fechanac'),0,10))){
            $employee->fechanac = substr($request->input('fechanac'),0,10);
        }else{
            $employee->fechanac = null;
        }

        $employee->save();

        return response()->json(['estado'=>true, 'nombres'=>$employee->nombres]);
    }

    public function find($id)
    {
        $employee = $this->employeeRepo->find($id);
        return response()->json($employee);
    }

    public function edit(Request $request)
    {
       $employee = $this->employeeRepo->find($request->id);
        //var_dump($request->except('fechaNac'));
        //die();
        $manager = new EmployeeManager($employee,$request->except('fechanac'));
        $manager->save();
        if($this->employeeRepo->validateDate(substr($request->input('fechanac'),0,10))){
            //$employee->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
            $employee->fechanac = substr($request->input('fechanac'),0,10);
            $employee->save();
        }

        //Event::fire('update.employee',$employee->all());
        return response()->json(['estado'=>true, 'nombre'=>$employee->nombre]);
    }

    public function destroy(Request $request)
    {
        $employee= $this->employeeRepo->find($request->id);
        $employee->delete();
        //Event::fire('update.employee',$employee->all());
        return response()->json(['estado'=>true, 'nombre'=>$employee->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $employees = $this->employeeRepo->search($q);

        return response()->json($employees);
    }
}