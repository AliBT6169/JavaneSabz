<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DTOMakerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new DTO class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fullPath = explode('/', $this->argument('name'));

        $name = Str::studly(end($fullPath));
        $pathDir = 'DTOs\\';
        for ($i = 0; $i < count($fullPath) - 1; $i++) {
            $pathDir .= $fullPath[$i] . '\\';
        }
        $path = app_path("{$pathDir}{$name}.php");
        if (File::exists($path)) {
            $this->error("DTO already exists!");
            return;
        }
        File::ensureDirectoryExists(app_path($pathDir));
        $pathDir = rtrim($pathDir, '\\');
        $stub = <<<PHP
<?php

namespace App\\{$pathDir};

class {$name}
{
    public function __construct()
    {

    }
}
PHP;

        File::put($path, $stub);
        $this->info("DTO {$name} created successfully in {$path}");
    }
}
