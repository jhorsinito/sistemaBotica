<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

class PendientAccountsController extends Controller
{
    protected $pendientAccountRepo;

    public function __construct(PendientAccountRepo $pendientAccountRepo)
    {
        $this->pendientAccountRepo = $pendientAccountRepo;
    }

    

    public function paginatep(){
        $pendientAccount = $this->pendientAccountRepo->paginar();
        return response()->json($pendientAccount);
    }

    
    public function search($q)
    {
        $pendientAccount = $this->cashRepo->search($q);

        return response()->json($pendientAccount);
    }


    public function create(Request $request)
    {
        $cash = $this->pendientAccountRepo->getModel();

        $manager = new CashManager($cash,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$cash->fechaInicio]);
    }
    public function edit(Request $request)
    {
        $pendientAccount = $this->pendientAccountRepo->find($request->id);

        $manager = new PendientAccountManager($pendientAccount,$request->all());
        $manager->save();

        return response()->json(['estado'=>true]);
    }
    public function verSaldosTotales($id){
        $pendientAccount = $this->pendientAccountRepo->verSaldosTotales($id);
        return response()->json($pendientAccount);
    }

    
}