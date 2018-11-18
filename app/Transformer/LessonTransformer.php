<?php 
namespace App\Transformer;

class LessonTransformer extends Transformer{
    
    public function transformer($lesson){
        return [
            'title'=>$lesson['title'],
            'content'=>$lesson['body'],
            'is_free'=>(boolean)$lesson['free'],
        ];
    }
}
