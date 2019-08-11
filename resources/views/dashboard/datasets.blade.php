<div class="mb-12">
  <div class="mb-6">
      <div class="text-xl tracking-wide mb-1">Datasets</div>
      <div class="text-grey-dark text-sm tracking-wide">Zipped files with the output of database tables in csv text format</div>
  </div>
  <div class="flex flex-wrap md:-mx-2">
      <dataset-card 
          title="Everything" 
          link="{{ url('/storage/dataset.7z') }}"
           body="Includes devices, samples and apps.">
      </dataset-card>
      
      <dataset-card 
          title="Samples" 
          link="{{ url('/storage/samples.7z') }}"
           body="Includes sample related files.">
      </dataset-card>

      <dataset-card 
          title="Devices" 
          link="{{ url('/storage/devices.7z') }}"
           body="Includes only devices file.">
      </dataset-card>
  </div>
</div>