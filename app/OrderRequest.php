<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderRequest extends Model
{
    protected $fillable = ['expectedOrganicQuantity', 'expectedPlasticQuantity', 'expectedPaperQuantity', 'expectedGlassQuantity', 'expectedMetalQuantity','expectedElectronicQuantity','areaId'];
}
