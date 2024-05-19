<?php

namespace App\Traits;
trait HtmlTrait
{

    public function getDeleteLink($row, $route)
    {
        $btn = ' <a type="button" href="javascript:void(0)" data-toggle="modal" data-target="#deletemodel'. $row->id.'" class="lbtn btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a></div>';
        $btn = $btn. $this->modal($row, route($route, $row->id));
        return $btn;
    }
    public function href($route, $name)
    {
        return '<a class="btn btn-secondary mb-1"
        href="'. $route .'">
        '. __($name) .'
    </a>';
    }
    public function update($route, $text, $color){
        return '<form method="POST" action="'.$route.'">
        <input type="hidden" name="_token" value="'. csrf_token()  .'" /> 
        <button type="submit" class="btn btn-'.$color.' mb-1">
            '. $text . '
        </button>
    </form>';
    }

        public function h_edit($route){
        return '<a class="btn btn-info btn-circle" href="' . $route . '">
        <i class="fas fa-edit"></i></a>';
    }

    public function h_delete($row, $text ='<i class="fas fa-trash"></i>'){
        $c = '';
        if($text == '<i class="fas fa-trash"></i>') $c = 'btn-circle';
        return '<a class="btn btn-danger '. $c .'" href="#"
        data-toggle="modal"data-target="#deletemodel'.$row->id.'">
        '. $text .'
    </a>';
    }

    public function h_show($route){
        return '<a class="btn btn-warning btn-circle" href="' . $route . '">
        <i class="fas fa-eye"></i></a>';
    }

    public function modal($row, $route)
    {
        return '<div class="modal fade" id="deletemodel'. $row->id .'" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> '. __ ("Warning") . '</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> '. __ ("Are you sure you want to delete the element?"). '
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">'. __ ("Close") . '</button>
                    <form id="logout-form" action="'.$route.'"method="POST">
                        <input type="hidden" name="_token" value="'. csrf_token()  .'" />  '. method_field("Delete") .'
                        
                        <button type="submit" class="btn btn-danger">'. __ ("Delete") . '</button>
                    </form>
    
                </div>
            </div>
        </div>
    </div>';
    }

}
