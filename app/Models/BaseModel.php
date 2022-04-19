<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseModel extends Model
{
    abstract public function rules();

    abstract public function attributesLabel();

    public function customValidationMessages()
    {
        return [];
    }

    public function validate()
    {
        return Validator::make($this->attributesToArray(), $this->rules(), $this->customValidationMessages(), $this->attributesLabel());
    }
}
