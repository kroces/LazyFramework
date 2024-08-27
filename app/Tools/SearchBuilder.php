<?php

namespace App\Tools;

class SearchBuilder{
    private $model, $search_params, $o, $q, $om, $q_plus, $filters, $pages;

    public function __construct($model, $request, $pages = 20){
        $this->model = $model;

        $this->q = $request->input("q");
        $this->o = $request->input("o", "");
        $this->om = $request->input('om', "asc");
        $this->q_plus = [];
        $this->search_params = [];
        $this->filters = [];
        $this->pages = $pages;
    }

    public function setPages($pages){
        $this->pages = $pages;
    }

    public function search($data){
        if($this->q){
            foreach($data as $param){
                $this->search_params[] = [
                    "name"=>$param["name"], 
                    "op"=>$param["op"], 
                    "text"=>isset($param["text"])?str_replace("##", $this->q, $param["text"]):$this->q
                ];
                
            }
        }
    }

    public function addSearch($name, $op, $text, $input){
        if(strlen($text) != 0)
            $this->q_plus[$input] = ["name"=>$name, "op"=>$op, "text"=>$text];
    }

    public function orderBy(){
        if($this->o){
            $this->model->orderBy($this->o, $this->om);
        }
    }

    public function addFilter($model, $field, $op, $text, $external_name, $local_name){
        if($this->q){
            $this->filters[$local_name] = ["data"=>$model->where($field, $op, $text?str_replace("##", $this->q, $text):$this->q)->get()->map(function ($data) use($external_name){
                return $data->$external_name;
            })->toArray()];
        }
    }

    public function addFilterArray($data, $key){
        if($this->q)
            $this->filters[$key] = ["data"=>$data];
    }

    public function build(){
        $q = $this->search_params;
        $q_plus = $this->q_plus;
        $filters = $this->filters;

        $this->model->where(function ($query) use($q, $filters){
            foreach($q as $param){
                if(isset($filters[$param["name"]])){
                    $query->orWhereIn(
                        $param["name"], 
                        $filters[$param["name"]]["data"]
                    );
                }
                else{
                    $query->orWhere(
                        $param["name"], 
                        $param["op"], 
                        isset($param["text"])?str_replace("##", $this->q, $param["text"]):$this->q
                    );
                }
            }
        });
        foreach($q_plus as $param){
            $this->model->where(
                $param["name"], 
                $param["op"], 
                $param["text"]
            );
        }
        
        $models = $this->model->paginate($this->pages);

        $search = ["q"=>$this->q];
        foreach($this->q_plus as $key=>$q){
            $search[$key] = $q["text"];
        }
        $models->appends($search);
        return array_merge($search, ["models"=>$models, "getParameters"=>$this->makeGetParameters($search), "o"=>$this->o, "om"=>$this->om]);
    }

    private function makeGetParameters($dataArray){
        $getParametersString = "";
        foreach($dataArray as $key=>$text){
            $getParametersString .= "$key=". urldecode($text)."&";
        }
        return $getParametersString;
    }

}