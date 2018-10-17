<?php
 
namespace App\Inspections;

class Spam
{
    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function detect($body)
    {
        //Detect invalid keywords.
        //$this->detectInvalidKeywords($body);
        // $this->detectKeyHeldDown($body);

        // return false;

        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }
        return false;
    }

    // protected function detectInvalidKeywords($body)
    // {
    //     $invalidKeywords = [
    //         'yahoo customer support'
    //     ];

    //     foreach ($invalidKeywords as $keyword){
    //         if(stripos($body, $keyword) !== false){
    //             throw new \Exception('Your reply contains spam.');
    //         }
    //     }
    // }
    
}