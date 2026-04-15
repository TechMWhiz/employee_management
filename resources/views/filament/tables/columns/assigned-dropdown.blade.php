<div x-data="{ open: false }" class="relative inline-block text-left">
    @php
        $state = $record->assigned_employee_ids ?? null;
        if (is_array($state) && count($state)) {
            $ids = $state;
        } elseif (is_string($state) && ($decoded = json_decode($state, true)) && is_array($decoded)) {
            $ids = $decoded;
        } elseif (is_string($state) && str_contains($state, ',')) {
            $ids = array_filter(array_map('trim', explode(',', $state)));
        } else {
            $ids = [];
        }
        $employees = count($ids) ? \App\Models\Employee::whereIn('id', $ids)->get() : collect();
    @endphp

    @if(!count($employees))
        <span class="text-gray-400">—</span>
    @else
        <div class="text-sm text-gray-700 space-y-0.5">
            @foreach($employees as $emp)
                <div>{{ $emp->name }}</div>
            @endforeach
        </div>
    @endif
</div>
