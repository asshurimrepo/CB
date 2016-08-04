<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Project;
use File;
use Log;

class WhenProjectIsUploaded extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::created(function ($project) {
            $project->options = File::get('../resources/default/options.json');
            $project->actions = File::get('../resources/default/actions.json');
            $project->save();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
