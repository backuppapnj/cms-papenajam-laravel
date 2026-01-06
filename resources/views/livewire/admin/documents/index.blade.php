<?php

use App\Models\Document;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public function delete(Document $document)
    {
        $document->delete();
        $this->js("Flux.toast('Dokumen berhasil dihapus.')");
    }

    public function with(): array
    {
        return [
            'documents' => Document::latest()->paginate(10),
        ];
    }
}; ?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Manajemen Dokumen</flux:heading>
        <flux:button href="{{ route('admin.documents.create') }}" variant="primary" icon="plus">Upload Dokumen</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Judul</flux:table.column>
            <flux:table.column>Kategori</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Unduhan</flux:table.column>
            <flux:table.column>Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($documents as $item)
                <flux:table.row wire:key="{{ $item->id }}">
                    <flux:table.cell class="font-medium">{{ $item->title }}</flux:table.cell>
                    <flux:table.cell>{{ $item->category ?? '-' }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="{{ $item->is_published ? 'green' : 'zinc' }}">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>{{ $item->download_count }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:dropdown>
                            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" />

                            <flux:menu>
                                @if($item->getFirstMediaUrl('documents'))
                                    <flux:menu.item href="{{ $item->getFirstMediaUrl('documents') }}" icon="arrow-down-tray" target="_blank">Download</flux:menu.item>
                                @endif
                                <flux:menu.item wire:click="delete({{ $item->id }})" icon="trash" variant="danger" wire:confirm="Hapus dokumen ini?">Hapus</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $documents->links() }}
    </div>
</div>
