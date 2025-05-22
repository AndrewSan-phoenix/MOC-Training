# Ministery of Commerence MOC-Training
Complete Laravel 12 - Livewire project with crud operations, datatables and landing page for MOC Training
 <livewire:custom-table wire:key="galleries-{{ $galleries->count() }}-{{ $galleries->pluck('id')->join('-') }}"
        :config="[
            'columns' => [
                ['label' => 'Image', 'key' => 'file_name'],
                ['label' => 'Description', 'key' => 'description'],
                ['label' => 'Batch', 'key' => 'batch.name'], model ထဲမာ public function batch()
            ],
          