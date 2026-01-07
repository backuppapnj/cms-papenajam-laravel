<div class="py-12 bg-white dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <header class="mb-12 text-center">
            <flux:heading size="xl" class="mb-2">{{ $procedure->title }}</flux:heading>
            <flux:subheading>Panduan alur layanan perkara di Pengadilan Agama Penajam</flux:subheading>
        </header>

        @if($procedure->getFirstMediaUrl('infographics'))
            <div class="rounded-2xl overflow-hidden mb-12 shadow-xl border border-zinc-100 dark:border-zinc-800">
                <img src="{{ $procedure->getFirstMediaUrl('infographics') }}" alt="{{ $procedure->title }}" class="w-full h-auto">
            </div>
        @endif

        @if($procedure->content)
            <div class="prose prose-lg dark:prose-invert max-w-none bg-zinc-50 dark:bg-zinc-800 p-8 md:p-12 rounded-2xl border border-zinc-100 dark:border-zinc-700 leading-relaxed">
                {!! nl2br($procedure->content) !!}
            </div>
        @endif

        @if(!$procedure->getFirstMediaUrl('infographics') && !$procedure->content)
            <div class="text-center py-12 text-zinc-500">
                <flux:icon name="information-circle" class="w-12 h-12 mx-auto mb-4 opacity-20" />
                <p>Informasi prosedur belum tersedia.</p>
            </div>
        @endif
    </div>
</div>
