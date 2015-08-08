<?php
namespace Salesfly\Salesfly\Entities;

class DetailPurchase extends \Eloquent {

	protected $table = 'detailPurchases';
    
    protected $fillable = ['descuento',
    						'montoBruto',
    						'montoTotal',
    						'variants_id',
    						'purchases_id',
    						'preProducto',
    						'preCompra',
    						'cantidad'
    						];

    public function puchase()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Purchase');
      }
      public function variant()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Variant');
      }

}