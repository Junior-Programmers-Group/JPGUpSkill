<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Notes')</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; margin: 0; background: #f5f5f4; color: #1c1917; }
        header { background: #1c1917; color: #fff; padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; }
        header a { color: #fff; text-decoration: none; font-weight: 600; }
        main { max-width: 840px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: #fff; border: 1px solid #e7e5e4; border-radius: 8px; padding: 1.25rem; margin-bottom: 1rem; }
        h1 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { text-align: left; padding: .75rem 1rem; border-bottom: 1px solid #e7e5e4; vertical-align: top; }
        th { background: #fafaf9; }
        a { color: #2563eb; }
        .btn { display: inline-block; padding: .5rem .9rem; border-radius: 6px; border: 1px solid transparent; background: #2563eb; color: #fff; text-decoration: none; font-size: .95rem; cursor: pointer; }
        .btn-secondary { background: #fff; color: #1c1917; border-color: #d6d3d1; }
        .btn-danger { background: #dc2626; }
        .actions { display: flex; gap: .5rem; align-items: center; }
        label { display: block; font-weight: 600; margin-bottom: .35rem; }
        input[type=text], textarea { width: 100%; padding: .6rem .7rem; border: 1px solid #d6d3d1; border-radius: 6px; font: inherit; }
        textarea { min-height: 180px; resize: vertical; }
        .field { margin-bottom: 1rem; }
        .errors { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: .75rem 1rem; border-radius: 6px; }
        .flash { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: .75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .muted { color: #78716c; font-size: .85rem; }
        form { display: inline; }
    </style>
</head>
<body>
<header>
    <a href="{{ route('notes.index') }}">📒 Notes</a>
    <a href="{{ route('notes.create') }}">New note</a>
</header>
<main>
    @if (session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif

    @yield('content')
</main>
</body>
</html>
