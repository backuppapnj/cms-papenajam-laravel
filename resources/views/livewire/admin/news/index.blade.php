<?php

use App\Models\News;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public function delete(News $news)
    {
        $news->delete();
        $this->js("Flux.toast('Berita berhasil dihapus.')");
    }

    public function with(): array
    {
        return [
            'news' => News::latest()->paginate(10),
        ];
    }
}; ?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Manajemen Berita</flux:heading>
        <flux:button href="{{ route('admin.news.create') }}" variant="primary" icon="plus">Tambah Berita</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Judul</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Tanggal Publikasi</flux:table.column>
            <flux:table.column>Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($news as $item)
                <flux:table.row wire:key="{{ $item->id }}">
                    <flux:table.cell class="font-medium">{{ $item->title }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="{{ $item->is_published ? 'green' : 'zinc' }}">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>{{ $item->published_at?->format('d M Y H:i') ?? '-' }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:dropdown>
                            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" />

                            <flux:menu>
                                <flux:menu.item href="{{ route('admin.news.edit', $item) }}" icon="pencil-square">Edit</flux:menu.item>
                                <flux:menu.item wire:click="delete({{ $item->id }})" icon="trash" variant="danger" wire:confirm="Apakah Anda yakin ingin menghapus berita ini?">Hapus</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>

