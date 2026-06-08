<!DOCTYPE html>
<html>
<head>
    <title>Test Acara</title>
</head>
<body>

<h1>CRUD Acara</h1>

@if(isset($edit))
    <h2>Edit Acara</h2>
    <form action="/test-acara/update/{{ $edit->id }}" method="POST">
@else
    <h2>Tambah Acara</h2>
    <form action="/test-acara" method="POST">
@endif

    @csrf

    <div>
        <label>ID Promotor</label><br>
        <input
            type="number"
            name="id_promotor"
            value="{{ $edit->id_promotor ?? '' }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Judul</label><br>
        <input
            type="text"
            name="judul"
            value="{{ $edit->judul ?? '' }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi" required>{{ $edit->deskripsi ?? '' }}</textarea>
    </div>

    <br>

    <div>
        <label>Harga</label><br>
        <input
            type="number"
            name="harga"
            value="{{ $edit->harga ?? '' }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Kategori</label><br>
        <select name="kategori" required>

            <option value="">Pilih Kategori</option>

            <option value="Musik & Festival"
                {{ ($edit->kategori ?? '') == 'Musik & Festival' ? 'selected' : '' }}>
                Musik & Festival
            </option>

            <option value="Seminar & Edukasi"
                {{ ($edit->kategori ?? '') == 'Seminar & Edukasi' ? 'selected' : '' }}>
                Seminar & Edukasi
            </option>

            <option value="Olahraga"
                {{ ($edit->kategori ?? '') == 'Olahraga' ? 'selected' : '' }}>
                Olahraga
            </option>

            <option value="Seni, Teater, & BUdaya"
                {{ ($edit->kategori ?? '') == 'Seni, Teater, & BUdaya' ? 'selected' : '' }}>
                Seni, Teater, & BUdaya
            </option>

            <option value="Gaya Hidup & Liburan"
                {{ ($edit->kategori ?? '') == 'Gaya Hidup & Liburan' ? 'selected' : '' }}>
                Gaya Hidup & Liburan
            </option>

            <option value="Atraksi & Wisata"
                {{ ($edit->kategori ?? '') == 'Atraksi & Wisata' ? 'selected' : '' }}>
                Atraksi & Wisata
            </option>

        </select>
    </div>

    <br>

    <div>
        <label>Kuota Tiket</label><br>
        <input
            type="number"
            name="kuota_tiket"
            value="{{ $edit->kuota_tiket ?? '' }}"
            required
        >
    </div>

    <br>

    <div>
        <label>URL Poster</label><br>
        <input
            type="text"
            name="url_poster"
            value="{{ $edit->url_poster ?? '' }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Syarat & Ketentuan</label><br>
        <textarea name="syarat_ketentuan" required>{{ $edit->syarat_ketentuan ?? '' }}</textarea>
    </div>

    <br>

    <button type="submit">
        @if(isset($edit))
            Update Acara
        @else
            Simpan Acara
        @endif
    </button>

</form>

<hr>

<h2>Daftar Acara</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach ($acara as $item)

    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->kategori }}</td>
        <td>{{ $item->harga }}</td>
        <td>{{ $item->status }}</td>

        <td>

            <a href="/test-acara/{{ $item->id }}">
                Edit
            </a>

            <form
                action="/test-acara/delete/{{ $item->id }}"
                method="POST"
                style="display:inline"
            >
                @csrf

                <button type="submit">
                    Hapus
                </button>

            </form>

            @if($item->status == 'pending')

                <form
                    action="/test-acara/approve/{{ $item->id }}"
                    method="POST"
                    style="display:inline"
                >
                    @csrf

                    <button type="submit">
                        Approve
                    </button>

                </form>

                <form
                    action="/test-acara/reject/{{ $item->id }}"
                    method="POST"
                    style="display:inline"
                >
                    @csrf

                    <button type="submit">
                        Reject
                    </button>

                </form>

            @endif

        </td>

    </tr>

    @endforeach

</table>

</body>
</html>