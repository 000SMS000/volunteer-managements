<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'إدارة المتطوعين') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-950 antialiased">
        <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="flex size-10 items-center justify-center rounded-md bg-teal-700 text-white shadow-sm shadow-teal-900/20">
                        <x-app-logo-icon class="size-6 fill-current" />
                    </span>
                    <span class="grid text-start">
                        <span class="text-sm font-semibold">إدارة المتطوعين</span>
                        <span class="text-xs text-slate-500">تنظيم، مهام، وتنسيب</span>
                    </span>
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="primary-button">لوحة التحكم</a>
                        @else
                            <a href="{{ route('login') }}" class="secondary-button">تسجيل الدخول</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="primary-button">إنشاء حساب</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <main class="mx-auto grid min-h-[calc(100vh-73px)] max-w-7xl items-center gap-10 px-4 py-10 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <section class="flex flex-col gap-6">
                <div class="inline-flex w-fit items-center rounded-full border border-teal-200 bg-teal-50 px-3 py-1 text-sm font-medium text-teal-800">
                    منصة تشغيل للفرق التطوعية
                </div>

                <div class="space-y-4">
                    <h1 class="max-w-3xl text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl">
                        إدارة المتطوعين والمهام من مكان واحد.
                    </h1>
                    <p class="max-w-2xl text-base leading-7 text-slate-600">
                        تابع المتطوعين، أماكن العمل، المهام، وعمليات التنسيب عبر واجهة واضحة وسريعة تناسب الاستخدام اليومي.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="primary-button">فتح لوحة التحكم</a>
                    @else
                        <a href="{{ route('login') }}" class="primary-button">تسجيل الدخول</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="secondary-button">إنشاء حساب</a>
                        @endif
                    @endauth
                </div>
            </section>

            <section class="panel overflow-hidden">
                <div class="border-b border-slate-200 bg-white px-5 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-950">لمحة تشغيلية</p>
                            <p class="mt-1 text-xs text-slate-500">واجهة مبسطة للمتابعة اليومية</p>
                        </div>
                        <div class="flex gap-1.5">
                            <span class="size-2.5 rounded-full bg-red-400"></span>
                            <span class="size-2.5 rounded-full bg-amber-400"></span>
                            <span class="size-2.5 rounded-full bg-emerald-400"></span>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 p-5">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs text-slate-500">متطوعون</p>
                            <p class="mt-2 text-2xl font-semibold">128</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs text-slate-500">مهام نشطة</p>
                            <p class="mt-2 text-2xl font-semibold">34</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs text-slate-500">أماكن عمل</p>
                            <p class="mt-2 text-2xl font-semibold">12</p>
                        </div>
                    </div>

                    <div class="rounded-lg border border-slate-200">
                        <div class="grid grid-cols-4 border-b border-slate-200 bg-slate-100 px-4 py-3 text-xs font-semibold text-slate-600">
                            <span>المتطوع</span>
                            <span>المهمة</span>
                            <span>المكان</span>
                            <span>الحالة</span>
                        </div>
                        <div class="divide-y divide-slate-200 text-sm">
                            <div class="grid grid-cols-4 px-4 py-3">
                                <span>أحمد ناصر</span>
                                <span>استقبال</span>
                                <span>المركز الرئيسي</span>
                                <span class="font-medium text-emerald-700">منسّب</span>
                            </div>
                            <div class="grid grid-cols-4 px-4 py-3">
                                <span>ليان عمر</span>
                                <span>تنظيم</span>
                                <span>قاعة التدريب</span>
                                <span class="font-medium text-emerald-700">منسّب</span>
                            </div>
                            <div class="grid grid-cols-4 px-4 py-3">
                                <span>سارة خليل</span>
                                <span>إرشاد</span>
                                <span>نقطة التسجيل</span>
                                <span class="font-medium text-amber-700">قيد المتابعة</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
