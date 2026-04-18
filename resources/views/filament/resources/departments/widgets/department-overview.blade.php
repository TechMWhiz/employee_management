<x-filament::section>
    <h2>{{ $record->name }} Summary</h2>
    <p>Total Employees: {{ $record->employees()->count() }}</p>

    <ul>
        @foreach ($record->subDepartments as $sub)
            <li>{{ $sub->name }}: {{ $sub->employees()->count() }}</li>
        @endforeach
    </ul>
</x-filament::section>
