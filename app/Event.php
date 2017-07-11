<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_name', 'event_description', 'date', 'time'];
    
    public function getDateAttribute($value)
    {
        switch (date('n',strtotime($value))) {
            case 1:
                return "Jan";
                            break;
            case 2:
                return "Feb";
                                break;
            case 3:
                return "Mar";
                                break;
            case 4:
                return "Apr";
                                break;
            case 5:
                return "May";
                                break;
            case 6:
                return "Jun";
                                break;
            case 7:
                return "Jul";
                                break;
            case 8:
                return "Aug";
                                break;
            case 9:
                return "Sep";
                                break;
            case 10:
                return "Oct";
                                break;
            case 11:
                return "No";

                break;
            case 12:
                return "Dec";
                                break;
            
            default:
                # code...
                break;
        }
    }
}
