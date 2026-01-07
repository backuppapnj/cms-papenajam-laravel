<div class="py-12 bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="p-8 md:p-12">
                <flux:heading size="xl" class="mb-8 border-b border-zinc-100 dark:border-zinc-700 pb-4 text-green-700 dark:text-green-400">
                    {{ $content->title ?? 'Sejarah Instansi' }}
                </flux:heading>

                @if($content)
                    <div class="prose prose-lg dark:prose-invert max-w-none text-zinc-700 dark:text-zinc-300 leading-relaxed">
                        {!! nl2br($content->content) !!}
                    </div>
                @else
                    <div class="text-center py-12 text-zinc-500">
                        <flux:icon name="information-circle" class="w-12 h-12 mx-auto mb-4 opacity-20" />
                        <p>Konten sejarah belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
