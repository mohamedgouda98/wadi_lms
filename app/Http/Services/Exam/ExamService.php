<?php

namespace App\Http\Services\Exam;

use Exception;

class ExamService
{

    
    public function run(string $method_name, array $args)
    {
        $type = $this->getExamType($args['type']); // to remove the & in True&false

        $className = "App\\Http\\Services\\Exam\\" . $type;

        if(class_exists($className))
        {
            $object = new $className();
            return $object->$method_name($args);
        }
        else
        {
            throw new Exception("class not found"); 
        }        
    }

    public function getExamType($type)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $type);
    }
}
