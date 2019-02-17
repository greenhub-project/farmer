@extends('layouts.app')

@section('content')
<header class="bg-blue-darker -mt-8 mb-8">
    <div class="container mx-auto px-4 md:px-0">
        <div class="flex justify-center py-8">
            <header-stats-item label="Samples" model="samples"></header-stats-item>
            <header-stats-item label="Devices" model="devices"></header-stats-item>
            <header-stats-item label="Users" model="users"></header-stats-item>
        </div>
    </div>
</header>
<div class="container mx-auto px-4 md:px-0">
    <div class="mb-12">
        <div class="mb-6">
            <div class="text-xl tracking-wide mb-1">Datasets</div>
            <div class="text-grey-dark text-sm tracking-wide">Zipped files with the output of database tables in csv text format</div>
        </div>
        <div class="flex flex-wrap md:-mx-2">
            <dataset-card 
                title="Everything" 
                link="{{ public_path('/storage/dataset.zip') }}"
                 body="Includes devices, samples and apps.">
            </dataset-card>
            
            <dataset-card 
                title="Samples" 
                link="{{ public_path('/storage/samples.zip') }}"
                 body="Includes sample related files.">
            </dataset-card>

            <dataset-card 
                title="Devices" 
                link="{{ public_path('/storage/devices.zip') }}"
                 body="Includes only devices file.">
            </dataset-card>
        </div>
    </div>
    <div class="mb-8">
        <div class="mb-6">
            <div class="text-xl tracking-wide mb-1">API Credentials</div>
            <div class="text-grey-dark text-sm tracking-wide">For more information, visit the documentation at <a class="text-grey-dark hover:underline no-underline" href="https://docs.greenhubproject.org">https://docs.greenhubproject.org</a></div>
        </div>
        <api-credentials-table :user="{{ auth()->user() }}" token="{{ auth()->user()->api_token }}"></api-credentials-table>
    </div>
    <div class="text-grey text-xs">For suggestions, questions or any other enquiries please open an issue <a class="text-grey hover:underline no-underline" href="https://github.com/greenhub-project/farmer/issues/new">[here]</a>.</div>
</div>
@endsection
