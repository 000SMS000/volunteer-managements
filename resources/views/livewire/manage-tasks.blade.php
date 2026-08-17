<div class="page-shell">
    @if (session()->has('message'))
        <div class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-200">
            {{ session('message') }}
        </div>
    @endif

    <section class="panel overflow-hidden">
        <div class="panel-header">
            <div>
                <h1 class="text-xl font-semibold text-slate-950 dark:text-white">إدارة المهام</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">عرّف المهام واربطها بأماكن العمل المناسبة.</p>
            </div>
            <button type="button" wire:click="openModal" class="primary-button">
                <flux:icon.plus class="ms-2 size-4" />
                إضافة مهمة
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الوصف</th>
                        <th>أماكن العمل</th>
                        <th class="w-40">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="font-medium">{{ $task->name }}</td>
                            <td>{{ $task->description ?: 'لا يوجد وصف' }}</td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($task->workplaces as $workplace)
                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 dark:bg-zinc-800 dark:text-zinc-200">
                                            {{ $workplace->name }}
                                        </span>
                                    @empty
                                        <span class="text-slate-500 dark:text-zinc-400">غير مرتبطة</span>
                                    @endforelse
                                </div>
                            </td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" wire:click="openModal({{ $task->id }})" class="secondary-button">تعديل</button>
                                    <button type="button" wire:click="delete({{ $task->id }})" wire:confirm="هل أنت متأكد من حذف المهمة؟" class="danger-button">حذف</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-500 dark:text-zinc-400">لا توجد مهام حتى الآن.</td>
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
                    <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                        {{ $editingTask ? 'تعديل المهمة' : 'إضافة مهمة' }}
                    </h2>
                </div>

                <form wire:submit.prevent="save" class="space-y-4 p-5">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">اسم المهمة</label>
                        <input wire:model="name" type="text" class="form-control" required>
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">أماكن العمل المرتبطة</label>
                        <select wire:model="selectedWorkplaces" multiple class="form-control min-h-32">
                            @foreach ($allWorkplaces as $workplace)
                                <option value="{{ $workplace->id }}">{{ $workplace->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedWorkplaces') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">الوصف</label>
                        <textarea wire:model="description" class="form-control min-h-24"></textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 pt-4 dark:border-zinc-800">
                        <button type="button" wire:click="$set('showModal', false)" class="secondary-button">إلغاء</button>
                        <button type="submit" class="primary-button">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
