<div class="page-shell">
    @if (session()->has('message'))
        <div class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-200">
            {{ session('message') }}
        </div>
    @endif

    <section class="panel">
        <div class="panel-header">
            <div>
                <h1 class="text-xl font-semibold text-slate-950 dark:text-white">تنسيب المتطوعين</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">اختر المتطوع ومكان العمل، ثم اربطه بمهمة متاحة لذلك المكان.</p>
            </div>
        </div>

        <div class="grid gap-4 p-5 md:grid-cols-[1fr_1fr_auto] md:items-end">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">المتطوع</label>
                <select wire:model="volunteerId" class="form-control">
                    <option value="">اختر متطوعاً</option>
                    @foreach ($volunteers as $volunteer)
                        <option value="{{ $volunteer->id }}">{{ $volunteer->name }}</option>
                    @endforeach
                </select>
                @error('volunteerId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">مكان العمل</label>
                <select wire:model.live="workplaceId" class="form-control">
                    <option value="">اختر مكان عمل</option>
                    @foreach ($workplaces as $workplace)
                        <option value="{{ $workplace->id }}">{{ $workplace->name }}</option>
                    @endforeach
                </select>
                @error('workplaceId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="button" wire:click="openModal" class="primary-button">
                <flux:icon.plus class="ms-2 size-4" />
                اختيار مهمة
            </button>
        </div>
    </section>

    <section class="panel overflow-hidden">
        <div class="panel-header">
            <div>
                <h2 class="text-base font-semibold text-slate-950 dark:text-white">المتطوعون المنسبون</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">قائمة التنسيبات الحالية حسب المتطوع والمهمة والمكان.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>المتطوع</th>
                        <th>مكان العمل</th>
                        <th>المهمة</th>
                        <th>التاريخ</th>
                        <th class="w-28">الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignments as $assignment)
                        <tr>
                            <td class="font-medium">{{ $assignment->volunteer?->name ?? 'غير متوفر' }}</td>
                            <td>{{ $assignment->taskWorkplace?->workplace?->name ?? 'غير متوفر' }}</td>
                            <td>{{ $assignment->taskWorkplace?->task?->name ?? 'غير متوفر' }}</td>
                            <td>{{ $assignment->assigned_at?->format('Y-m-d') ?? 'غير محدد' }}</td>
                            <td>
                                <button type="button" wire:click="deleteAssignment({{ $assignment->id }})" wire:confirm="هل أنت متأكد من حذف التنسيب؟" class="danger-button">حذف</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500 dark:text-zinc-400">لا توجد تنسيبات حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 p-4 backdrop-blur-sm">
            <div class="panel w-full max-w-lg overflow-hidden">
                <div class="panel-header">
                    <h2 class="text-base font-semibold text-slate-950 dark:text-white">اختيار المهمة</h2>
                </div>

                <div class="space-y-4 p-5">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">المهمة</label>
                        <select wire:model="taskId" class="form-control">
                            <option value="">اختر مهمة</option>
                            @foreach ($availableTasks as $task)
                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                            @endforeach
                        </select>
                        @error('taskId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 pt-4 dark:border-zinc-800">
                        <button type="button" wire:click="$set('showModal', false)" class="secondary-button">إلغاء</button>
                        <button type="button" wire:click="assignTask" class="primary-button">إضافة</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
