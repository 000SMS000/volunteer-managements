<div class="page-shell">
    @if (session()->has('message'))
        <div class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-200">
            {{ session('message') }}
        </div>
    @endif

    <section class="panel overflow-hidden">
        <div class="panel-header">
            <div>
                <h1 class="text-xl font-semibold text-slate-950 dark:text-white">إدارة المتطوعين</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">أضف المتطوعين وحدّث بيانات التواصل والرقم الجامعي.</p>
            </div>
            <button type="button" wire:click="openModal" class="primary-button">
                <flux:icon.plus class="ms-2 size-4" />
                إضافة متطوع
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الرقم الجامعي</th>
                        <th>البريد الإلكتروني</th>
                        <th class="w-40">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($volunteers as $volunteer)
                        <tr>
                            <td class="font-medium">{{ $volunteer->name }}</td>
                            <td>{{ $volunteer->volunteer_num }}</td>
                            <td>{{ $volunteer->email ?: 'غير مدخل' }}</td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" wire:click="openModal({{ $volunteer->id }})" class="secondary-button">تعديل</button>
                                    <button type="button" wire:click="delete({{ $volunteer->id }})" wire:confirm="هل أنت متأكد من حذف المتطوع؟" class="danger-button">حذف</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-500 dark:text-zinc-400">لا يوجد متطوعون حتى الآن.</td>
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
                        {{ $editingVolunteer ? 'تعديل بيانات المتطوع' : 'إضافة متطوع' }}
                    </h2>
                </div>

                <form wire:submit.prevent="save" class="space-y-4 p-5">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">اسم المتطوع</label>
                        <input wire:model="name" type="text" class="form-control" required>
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">الرقم الجامعي</label>
                        <input wire:model="volunteer_num" type="text" class="form-control" required>
                        @error('volunteer_num') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-zinc-200">البريد الإلكتروني</label>
                        <input wire:model="email" type="email" class="form-control" placeholder="name@example.com">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
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
