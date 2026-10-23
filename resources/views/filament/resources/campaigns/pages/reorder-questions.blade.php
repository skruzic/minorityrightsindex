<x-filament-panels::page>
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <table class="w-full table-auto divide-y divide-gray-200 dark:divide-white/10 text-sm">
            <thead class="bg-gray-50 dark:bg-white/5">
                <tr>
                    <th class="px-4 py-3 text-left font-medium">Order</th>
                    <th class="px-4 py-3 text-left font-medium">Code</th>
                    <th class="px-4 py-3 text-left font-medium">Question</th>
                    <th class="px-4 py-3 text-left font-medium">Parent</th>
                    <th class="px-4 py-3 text-right font-medium">Move</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                @forelse ($this->questions as $question)
                    <tr wire:key="question-{{ $question->id }}">
                        <td class="px-4 py-3 whitespace-nowrap">{{ $question->lft }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ $question->code }}</td>
                        <td class="px-4 py-3">
                            @if ((int) $question->parent_id > 0)
                                <span class="text-gray-400">↳</span>
                            @endif
                            {{ \Illuminate\Support\Str::limit($question->text, 80) }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ ((int) $question->parent_id > 0) ? $question->parent_id : '—' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-right space-x-2">
                            <x-filament::button
                                size="sm"
                                color="gray"
                                wire:click="moveUp({{ $question->id }})"
                            >
                                Up
                            </x-filament::button>
                            <x-filament::button
                                size="sm"
                                color="gray"
                                wire:click="moveDown({{ $question->id }})"
                            >
                                Down
                            </x-filament::button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            No questions in this campaign.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
