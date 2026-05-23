<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User Aplikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 sm:p-10 text-gray-800">

    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 border-b pb-3">Daftar Pengguna Sistem</h1>

        @if($users->isEmpty())
            <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-lg text-center font-medium">
                Belum ada data user yang tersimpan di database.
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded-md shadow-sm border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-400 border-b border-gray-200 text-sm font-semibold text-black">
                            <th class="py-3 px-4 w-16 text-center">No</th>
                            <th class="py-3 px-4">Nama Lengkap</th>
                            <th class="py-3 px-4">Alamat Email</th>
                            <th class="py-3 px-4">Nomor WhatsApp</th>
                            <th class="py-3 px-4">Username Akun</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach ($users as $index => $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 text-center font-medium text-gray-500">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900">{{ $user->name }}</td>
                                <td class="py-3 px-4 text-black">{{ $user->email }}</td>
                                <td class="py-3 px-4 text-black">{{ $user->whatsapp }}</td>
                                <td class="py-3 px-4 text-sm font-mono text-indigo-600">
                                    {{ $user->username }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</body>
</html>
