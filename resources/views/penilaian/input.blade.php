<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Penilaian Alternatif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS simple biar tabel enak dibaca, boleh kamu ganti Bootstrap/Tailwind --}}
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            padding: 20px;
            background: #f4f4f5;
        }
        h1 {
            margin-bottom: 16px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #f9fafb;
            font-weight: 600;
        }
        td:first-child, th:first-child {
            text-align: left;
            white-space: nowrap;
        }
        input[type="number"] {
            width: 60px;
            padding: 4px;
            text-align: center;
        }
        .alert {
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .btn-submit {
            margin-top: 16px;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #2563eb;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-submit:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

    <h1>Input Penilaian Alternatif × Kriteria</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;">
            <ul style="margin:0;padding-left:18px;text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf

        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th>{{ $kriteria->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama }}</td>

                        @foreach ($kriterias as $kriteria)
                            @php
                                $existing = $existingPenilaian[$alternatif->id][$kriteria->id]->nilai
                                    ?? null;
                            @endphp
                            <td>
                                <input
                                    type="number"
                                    name="nilai[{{ $alternatif->id }}][{{ $kriteria->id }}]"
                                    value="{{ old("nilai.$alternatif->id.$kriteria->id", $existing) }}"
                                    step="0.01"
                                    min="0"
                                >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn-submit">
            Simpan Penilaian
        </button>
    </form>

</body>
</html>
