<?
namespace App\Http\Controllers\Tools;

class Prepare
{
    static public function objectToArray($data)
    {
        $array = (array)$data;
        foreach($array as $key => &$field){
            if(is_object($field))$field = $this->objectToarray($field);
        }
        return $array;
    }
    
    
}
