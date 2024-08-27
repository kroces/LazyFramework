<?php

namespace App\Models;

interface LazyModel{
    public function simpleView();
    public function formInputs();
    public function updateFormInputs();
    public function validateCreateArray();
    public function validateUpdateArray();
    public function showName();
    public function builder($request);
    public function builderData();
}
