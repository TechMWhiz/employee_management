<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
// bootstrap kernel to use Eloquent
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$p = App\Models\Project::find(1);
if (! $p) {
    echo "Project not found\n";
    exit;
}
var_export($p->toArray());
echo "\nAssigned raw value: ";
$raw = \Illuminate\Support\Facades\DB::table('projects')->where('id', 1)->value('assigned_employee_ids');
var_export($raw);
echo "\n";

$state = $p->assigned_employee_ids;
if (is_array($state) && count($state)) {
    $ids = $state;
} elseif (is_string($state) && ($decoded = json_decode($state, true)) && is_array($decoded)) {
    $ids = $decoded;
} elseif (is_string($state) && str_contains($state, ',')) {
    $ids = array_filter(array_map('trim', explode(',', $state)));
} else {
    $ids = [];
}

var_export($ids);
$names = App\Models\Employee::whereIn('id', $ids)->pluck('name')->toArray();
var_export($names);
echo "\n";
