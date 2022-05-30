<?php

namespace App\Rules;

use App\Models\Vehicle;
use Illuminate\Contracts\Validation\Rule;

class OdometerRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $vehicle_id;
    private $type;
    private $message;
    public function __construct($vehicle_id = null, $type='start')
    {
        $this->vehicle_id = $vehicle_id;
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->message = 'Missing vehicle parameter';

        if(is_null($this->vehicle_id)){
            $this->message = 'Missing vehicle parameter';
            return false;
        }
        $vehicle = Vehicle::find($this->vehicle_id);
        $qry  = $vehicle->travels();

        if($this->type=='start'){
            if($qry->count() > 0 ){
                $latest_odometer = $vehicle->last_odometer;
                $this->message = 'Start odometer must be equal to ' . $latest_odometer;
                return $latest_odometer == $value;
            }
            return true;
        }
 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
