<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DocenteRepo;
use Salesfly\Salesfly\Managers\DocenteManager;
 
class DocentesController extends Controller {

    protected $docenteRepo; 

    public function __construct(DocenteRepo $docenteRepo)
    {
        $this->docenteRepo = $docenteRepo;
    }

    public function index()
    {
        return View('docentes.index');
    }

    public function all()
    {
        $docentes = $this->docenteRepo->paginaterepo(15);
        return response()->json($docentes);
    }

    public function paginatep(){
        $docentes = $this->docenteRepo->paginaterepo(15);
        return response()->json($docentes);
    }


    public function form_create()
    {
        return View('docentes.form_create');
    }

    public function form_edit()
    {
        return View('docentes.form_edit');
    }

    public function create(Request $request)
    {
        $docentes = $this->docenteRepo->getModel();
        $manager = new DocenteManager($docentes,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$docentes->nombre]);
    }

    public function find($id)
    {
        $station = $this->docenteRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->docenteRepo->find($request->id);

        if($request->curriculo!=$station->curriculo){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$station->curriculo);
        }
        $manager = new DocenteManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->docenteRepo->find($request->id);
        if($station->curriculo!=""){
            $rest = substr(__DIR__, 0, -21);
            unlink($rest."/public".$station->curriculo);
        }
        
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $docentes = $this->docenteRepo->search($q);

        return response()->json($docentes);
    }
    public function validarDni($text){
        $docentes = $this->docenteRepo->validarDni($text);
        return response()->json($docentes);
    }

    public function disablePersona($id){
        \DB::beginTransaction();
        $persona = $this->docenteRepo->find($id);
        $estado = $persona->estado;
            if ($estado == 'Activo') {
                $persona->estado = 'Inactivo';
            } else {
                $persona->estado = 'Activo';
            }
        
        $persona->save();
        //die();
        \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function uploadFile(){

        $file = $_FILES["file"]["name"];
        //var_dump($file);
        //die();
        $time=time();
        if(!is_dir("files/"))
            mkdir("files/", 0777);
        if($file && move_uploaded_file($_FILES["file"]["tmp_name"], "files/".$time."_".$file))
        {
             //echo $file;
        }
        return "/files/".$time."_".$file;      
    }
}