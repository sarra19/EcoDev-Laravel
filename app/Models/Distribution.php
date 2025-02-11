<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity_to_distribute',
        'status',                
        'delivery_agence_id',  
        'recycling_center_id',
        'waste_id', // 

    ];

    // Relation to DepotCenter
    public function depotCenter()
    {
        return $this->belongsTo(DepotCenter::class); 
    }

    // Relation to DeliveryAgence
    public function deliveryAgence()
    {
        return $this->belongsTo(DeliveryAgence::class); 
    }

  

    public function waste()
    {
        return $this->belongsTo(Waste::class); // Relation avec Waste
    }

    public function recyclingCenter()
    {
        return $this->belongsTo(RecyclingCenter::class); 
    }


  
    public function distributions()
{
    return $this->hasMany(Distribution::class);
}

}