<x-layouts.app :title="__('لوحة التحكم')">
    @php
        $volunteerCount = \App\Models\Volunteer::count();
        $workplaceCount = \App\Models\Workplace::count();
        $taskCount = \App\Models\Task::count();
        $assignmentCount = \App\Models\Assignment::count();
        $assignedVolunteerCount = \App\Models\Volunteer::has('assignments')->count();
        $unassignedTaskCount = \App\Models\Task::doesntHave('workplaces')->count();
        $topWorkplaces = \App\Models\Workplace::withCount('assignments')
            ->orderByDesc('assignments_count')
            ->take(5)
            ->get();
        $topVolunteers = \App\Models\Volunteer::withCount('assignments')
            ->orderByDesc('assignments_count')
            ->take(5)
            ->get();
        $recentTasks = \App\Models\Task::with('workplaces')
            ->latest()
            ->take(5)
            ->get();
        $recentAssignments = \App\Models\Assignment::with(['volunteer', 'taskWorkplace.task', 'taskWorkplace.workplace'])
            ->latest('assigned_at')
            ->take(5)
            ->get();
    @endphp

    <div class="page-shell">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-teal-700 dark:text-teal-300">مرحباً {{ auth()->user()->name }}</p>
            <h1 class="text-2xl font-semibold text-slate-950 dark:text-white">لوحة التحكم</h1>
            <p class="max-w-2xl text-sm text-slate-600 dark:text-zinc-400">
                نظرة سريعة على المتطوعين، أماكن العمل، المهام، وآخر عمليات التنسيب.
            </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="panel p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">المتطوعون</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">{{ $volunteerCount }}</p>
                    </div>
                    <div class="rounded-md bg-teal-50 p-2 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300">
                        <flux:icon.users class="size-5" />
                    </div>
                </div>
            </div>

            <div class="panel p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">أماكن العمل</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">{{ $workplaceCount }}</p>
                    </div>
                    <div class="rounded-md bg-sky-50 p-2 text-sky-700 dark:bg-sky-400/10 dark:text-sky-300">
                        <flux:icon.building-office-2 class="size-5" />
                    </div>
                </div>
            </div>

            <div class="panel p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">المهام</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">{{ $taskCount }}</p>
                    </div>
                    <div class="rounded-md bg-amber-50 p-2 text-amber-700 dark:bg-amber-400/10 dark:text-amber-300">
                        <flux:icon.clipboard-document-list class="size-5" />
                    </div>
                </div>
            </div>

            <div class="panel p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">عمليات التنسيب</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">{{ $assignmentCount }}</p>
                    </div>
                    <div class="rounded-md bg-violet-50 p-2 text-violet-700 dark:bg-violet-400/10 dark:text-violet-300">
                        <flux:icon.user-plus class="size-5" />
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.4fr_0.8fr]">
            <section class="panel overflow-hidden">
                <div class="panel-header">
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">آخر عمليات التنسيب</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">أحدث المهام المرتبطة بالمتطوعين وأماكن العمل.</p>
                    </div>
                    <a href="{{ route('assign.volunteer') }}" class="secondary-button" wire:navigate>إدارة التنسيب</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>المتطوع</th>
                                <th>المهمة</th>
                                <th>مكان العمل</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentAssignments as $assignment)
                                <tr>
                                    <td>{{ $assignment->volunteer?->name ?? 'غير متوفر' }}</td>
                                    <td>{{ $assignment->taskWorkplace?->task?->name ?? 'غير متوفر' }}</td>
                                    <td>{{ $assignment->taskWorkplace?->workplace?->name ?? 'غير متوفر' }}</td>
                                    <td>{{ optional($assignment->assigned_at)->format('Y-m-d H:i') ?? $assignment->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-slate-500 dark:text-zinc-400">
                                        لا توجد عمليات تنسيب حتى الآن.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="panel p-5">
                <h2 class="text-base font-semibold text-slate-950 dark:text-white">إجراءات سريعة</h2>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 dark:border-zinc-800 dark:bg-zinc-950">
                        <p class="text-xs text-slate-500 dark:text-zinc-400">متطوعون منسّبون</p>
                        <p class="mt-1 text-xl font-semibold text-slate-950 dark:text-white">{{ $assignedVolunteerCount }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 dark:border-zinc-800 dark:bg-zinc-950">
                        <p class="text-xs text-slate-500 dark:text-zinc-400">مهام بلا أماكن</p>
                        <p class="mt-1 text-xl font-semibold text-slate-950 dark:text-white">{{ $unassignedTaskCount }}</p>
                    </div>
                </div>
                <div class="mt-4 grid gap-3">
                    <a href="{{ route('volunteers.manage') }}" class="secondary-button justify-between" wire:navigate>
                        <span>إضافة متطوع</span>
                        <flux:icon.arrow-left class="size-4" />
                    </a>
                    <a href="{{ route('workplaces.manage') }}" class="secondary-button justify-between" wire:navigate>
                        <span>إضافة مكان عمل</span>
                        <flux:icon.arrow-left class="size-4" />
                    </a>
                    <a href="{{ route('tasks.manage') }}" class="secondary-button justify-between" wire:navigate>
                        <span>إضافة مهمة</span>
                        <flux:icon.arrow-left class="size-4" />
                    </a>
                    <a href="{{ route('assign.volunteer') }}" class="primary-button justify-between">
                        <span>تنسيب متطوع</span>
                        <flux:icon.arrow-left class="size-4" />
                    </a>
                </div>
            </section>
        </div>

        <div class="grid gap-6 xl:grid-cols-3">
            <section class="panel overflow-hidden">
                <div class="panel-header">
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">أكثر أماكن العمل نشاطاً</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">مرتبة حسب عدد التنسيبات.</p>
                    </div>
                </div>

                <div class="divide-y divide-slate-200 dark:divide-zinc-800">
                    @forelse ($topWorkplaces as $workplace)
                        <div class="flex items-center justify-between gap-4 px-5 py-4">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ $workplace->name }}</p>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">{{ $workplace->location ?: 'غير محدد' }}</p>
                            </div>
                            <span class="rounded-full bg-teal-50 px-3 py-1 text-sm font-semibold text-teal-700 dark:bg-teal-400/10 dark:text-teal-300">
                                {{ $workplace->assignments_count }}
                            </span>
                        </div>
                    @empty
                        <p class="px-5 py-10 text-center text-sm text-slate-500 dark:text-zinc-400">لا توجد بيانات أماكن عمل بعد.</p>
                    @endforelse
                </div>
            </section>

            <section class="panel overflow-hidden">
                <div class="panel-header">
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">أكثر المتطوعين نشاطاً</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">مرتبة حسب عدد المهام المنسوبة.</p>
                    </div>
                </div>

                <div class="divide-y divide-slate-200 dark:divide-zinc-800">
                    @forelse ($topVolunteers as $volunteer)
                        <div class="flex items-center justify-between gap-4 px-5 py-4">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ $volunteer->name }}</p>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">{{ $volunteer->email ?: $volunteer->volunteer_num }}</p>
                            </div>
                            <span class="rounded-full bg-sky-50 px-3 py-1 text-sm font-semibold text-sky-700 dark:bg-sky-400/10 dark:text-sky-300">
                                {{ $volunteer->assignments_count }}
                            </span>
                        </div>
                    @empty
                        <p class="px-5 py-10 text-center text-sm text-slate-500 dark:text-zinc-400">لا توجد بيانات متطوعين بعد.</p>
                    @endforelse
                </div>
            </section>

            <section class="panel overflow-hidden">
                <div class="panel-header">
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">أحدث المهام</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">آخر المهام المضافة للنظام.</p>
                    </div>
                </div>

                <div class="divide-y divide-slate-200 dark:divide-zinc-800">
                    @forelse ($recentTasks as $task)
                        <div class="px-5 py-4">
                            <div class="flex items-center justify-between gap-4">
                                <p class="font-medium text-slate-900 dark:text-white">{{ $task->name }}</p>
                                <span class="text-xs text-slate-500 dark:text-zinc-400">{{ $task->created_at->format('Y-m-d') }}</span>
                            </div>
                            <p class="mt-1 line-clamp-2 text-sm text-slate-500 dark:text-zinc-400">{{ $task->description ?: 'لا يوجد وصف' }}</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @forelse ($task->workplaces as $workplace)
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 dark:bg-zinc-800 dark:text-zinc-200">
                                        {{ $workplace->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-amber-700 dark:text-amber-300">غير مرتبطة بمكان عمل</span>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="px-5 py-10 text-center text-sm text-slate-500 dark:text-zinc-400">لا توجد مهام حتى الآن.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-layouts.app>
