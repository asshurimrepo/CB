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
            $project->options = File::get('../data/default/options.json');
            $project->actions = File::get('../data/default/actions.json');
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
