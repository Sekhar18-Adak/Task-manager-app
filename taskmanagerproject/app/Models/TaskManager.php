<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskManager extends Model
{
    protected $table = "_task_manager"; // Ensure this matches your actual database table name
    // Define primary key (if it's different, change it)
    // public $timestamps = false; // Disable timestamps if `created_at` and `updated_at` are not in the table
    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'Task_Description',
        'Task_Owner',
        'Task_Owner_Email',
        'Task_Eta',
        'Task_Status',
    ];
}
