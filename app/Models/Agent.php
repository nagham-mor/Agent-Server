<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    //protected $dateformat= 'U';

    // public function boot(): void {
    //     Model::preventLazyLoading(! $this->app->isProduction());
    // }



}

// $agent = Agent::create(['name'=>'hello']);