<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\Project\VideoWasUploaded;
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

        Project::deleted(function ($project) {
            $email = auth()->user()->email;
            
            File::delete(
                "data/{$email}/done/{$project->filename}", 
                "data/{$email}/done/{$project->filename}.png",
                "data/{$email}/done/raw_{$project->filename}.png"
            );
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
