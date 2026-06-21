<!DOCTYPE html>

<html>
<head>
    <title>Test Event CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 30px;
    }

    img {
        border-radius: 8px;
    }

    .preview img {
        width: 100px;
        margin: 5px;
    }

    table {
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid #ccc;
        padding: 10px;
        vertical-align: top;
    }
</style>

</head>
<body>

<h1>Event Testing Page</h1>

@if ($errors->any()) <div style="color:red"> <ul>
@foreach($errors->all() as $error) <li>{{ $error }}</li>
@endforeach </ul> </div>
@endif

@if(session('success')) <div style="color:green">
{{ session('success') }} </div>
@endif

<h2>
@if(isset($editEvent))
    Edit Event
@else
    Create Event
@endif
</h2>

<form
    action="{{ isset($editEvent)
        ? route('event.update', $editEvent->id)
        : route('event.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    @if(isset($editEvent))
        @method('PUT')
    @endif

<div>
    <label>Title</label><br>
    <input type="text"
           name="title"
           value="{{ $editEvent->title ?? '' }}"
           required>
</div>

<br>

<div>
    <label>Description</label><br>
    <textarea name="description"
              rows="4"
              cols="50"
              required>{{ $editEvent->description ?? '' }}</textarea>
</div>

<br>

<div>
    <label>Category</label><br>

    <select name="category" required>

        <option value="music_festival"
             {{ isset($editEvent) && $editEvent->category == 'music_festival' ? 'selected' : '' }}>
             Music Festival
        </option>
        
        <option value="seminar_education"
             {{ isset($editEvent) && $editEvent->category == 'seminar_education' ? 'selected' : '' }}>
              Seminar Education
        </option>

        <option value="sports"
             {{ isset($editEvent) && $editEvent->category == 'sports' ? 'selected' : '' }}>
              Sports
        </option>

        <option value="arts_theater_culture"
             {{ isset($editEvent) && $editEvent->category == 'arts_theater_culture' ? 'selected' : '' }}>
              Arts Theater Culture
        </option>

        <option value="lifestyle_holiday"
             {{ isset($editEvent) && $editEvent->category == 'lifestyle_holiday' ? 'selected' : '' }}>
             Lifestyle Holiday
        </option>

        <option value="attraction_tourism"
             {{ isset($editEvent) && $editEvent->category == 'attraction_tourism' ? 'selected' : '' }}>
             Attraction Tourism
        </option>


    </select>
</div>
<br>
<div>
    <label>Maximum Ticket Per Order</label><br>
    <input
        type="number"
        name="max_ticket_per_order"
        min="1"
           value="{{ $editEvent->max_ticket_per_order?? '' }}"
        required
    >
</div>
<div>
    <label>Venue Name</label><br>
    <input type="text"
           name="venue_name"
           value="{{ $editEvent->venue_name ?? '' }}"
           required>
</div>

<br>

<div>
    <label>Venue Address</label><br>
    <textarea name="address"
              required>{{ $editEvent->address ?? '' }}</textarea>
</div>
<div>
    <label>City</label><br>
    <textarea name="city"
              required>{{ $editEvent->city ?? '' }}</textarea>
</div>

<br>

<div>
    <label>Event Date</label><br>
    <input type="datetime-local"
           name="event_date"
           value="{{ $editEvent->event_date ?? '' }}"
           required>
</div>
<div>
        <label>Start Time</label><br>
        <input type="time"
               name="start_time"
           value="{{ $editEvent->start_time ?? '' }}"
               required>
    </div>
<div>
        <label>End Time</label><br>
        <input type="time"
               name="end_time"
           value="{{ $editEvent->end_time ?? '' }}"
               required>
    </div>

<br>

<div>
    <label>Terms & Conditions</label><br>
    <textarea name="terms_and_conditions"
              rows="4"
              cols="50"
              required>{{ $editEvent->terms_and_conditions ?? '' }}</textarea>
</div>

<br>

<div>
    <label>Poster</label><br>

    @if(isset($editEvent) && $editEvent->poster_path)
        <img src="{{ $editEvent->poster_url }}"
             width="120"><br>
        <small>Poster saat ini</small><br><br>
    @endif

    <input type="file" name="poster" accept="image/*">

    <small>Biarkan kosong jika tidak ingin mengganti</small>
</div>

<br>
@if(isset($editEvent))
    <div>
        <label>Gallery Lama</label><br>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            @foreach($editEvent->galleries as $gallery)
                <div style="position:relative;">
                    <img src="{{ $gallery->image_url }}"
                         width="100"
                         style="border-radius:8px;">

                    <!-- tombol delete -->
                    <button type="button"
                            onclick="removeGallery({{ $gallery->id }}, this)"
                            style="position:absolute; top:0; right:0;">
                        X
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div>
    <label>Gallery Images</label><br>

    <input
        type="file"
        name="gallery[]"
        multiple
        accept="image/*"
        id="galleryInput"
    >
</div>

<br>

<div id="preview" class="preview"></div>

<br>
<h3>Ticket Types</h3>

<div id="ticket-container">

@if(isset($editEvent))
    @foreach($editEvent->ticketTypes as $ticket)
        <div class="ticket-item" style="border:1px solid #ccc;padding:10px;margin-bottom:10px;">

            <input type="hidden" name="ticket_id[]" value="{{ $ticket->id }}">

            <input type="text" name="ticket_name[]" value="{{ $ticket->name }}" required>
            <input type="number" name="ticket_type_price[]" value="{{ $ticket->price }}" required>
            <input type="number" name="ticket_type_quota[]" value="{{ $ticket->quota }}" required>
            <input type="datetime-local" name="start_sale[]" value="{{ $ticket->start_sale }}" required>
            <input type="datetime-local" name="end_sale[]" value="{{ $ticket->end_sale }}" required>

            <button type="button" onclick="removeTicket(this)">Hapus</button>

        </div>
    @endforeach
@else
    <!-- default 1 form -->
    <div class="ticket-item" style="border:1px solid #ccc;padding:10px;margin-bottom:10px;">
        <input type="text" name="ticket_name[]" required>
        <input type="number" name="ticket_type_price[]" required>
        <input type="number" name="ticket_type_quota[]" required>
        <input type="datetime-local" name="start_sale[]" required>
        <input type="datetime-local" name="end_sale[]" required>

        <button type="button" onclick="removeTicket(this)">Hapus</button>
    </div>
@endif

</div>

<button type="button" onclick="addTicketType()">+ Tambah Ticket</button>
<br><br>

<button type="submit">
@if(isset($editEvent))
    Update Event
@else
    Create Event
@endif
</button>


</form>

<hr>

<h2>Event List</h2>

<table>

<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Poster</th>
    <th>Gallery</th>
    <th>Kategori Tiket</th>
    <th>Status</th>
    <th>Action</th>
</tr>

@foreach($events as $event)

<tr>

    <td>{{ $event->id }}</td>

    <td>
        {{ $event->title }}
    </td>

    <td>

        @if($event->poster_path)

            <img
                src="{{ $event->poster_url }}"
                width="120"
            >

        @endif

    </td>

    <td>

        @foreach($event->galleries as $image)

            <img
                src="{{ $image->image_url }}"
                width="80"
            >

        @endforeach

    </td>
    <td>

    @foreach($event->ticketTypes as $ticket)

        <div>
            <b>{{ $ticket->name }}</b><br>
            Harga:
            Rp {{ number_format($ticket->price) }}<br>

            Kuota:
            {{ $ticket->quota }}
        </div>

        <hr>

    @endforeach

</td>

    <td>{{ $event->status }}</td>
    <td>

    @if($event->status === 'draft')

<form action="{{ route('event.update', $event->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="hidden"
           name="status"
           value="pending">

    <input type="hidden"
           name="max_ticket_per_order"
           value="{{ $event->max_ticket_per_order }}">

    <button type="submit">
        Ajukan
    </button>

</form>
        <form action="{{ route('event.edit',$event->id) }}"
              method="GET"
              style="margin-bottom:10px;">

            @csrf

            <button type="submit">
                Edit
            </button>

        </form>

    @endif

    <form action="{{ route('event.destroy',$event->id) }}"
          method="POST">

        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>

    </form>

</td>

</tr>

@endforeach


</table>

<script>

document.getElementById('galleryInput')
.addEventListener('change', function(event){

    const preview =
        document.getElementById('preview');

    preview.innerHTML = '';

    Array.from(event.target.files)
    .forEach(file => {

        const reader =
            new FileReader();

        reader.onload = function(e){

            const img =
                document.createElement('img');

            img.src = e.target.result;

            preview.appendChild(img);
        }

        reader.readAsDataURL(file);

    });

});

</script>
<script>

function addTicketType()
{
    const container =
        document.getElementById('ticket-container');

    container.insertAdjacentHTML(
        'beforeend',
        `
        <div class="ticket-item"
             style="border:1px solid #ccc;padding:10px;margin-bottom:10px;">

            <div>
                <label>Ticket Name</label><br>
                <input type="text"
                       name="ticket_name[]"
                       required>
            </div>

            <br>

            <div>
                <label>Price</label><br>
                <input type="number"
                       name="ticket_type_price[]"
                       min="0"
                       required>
            </div>

            <br>

            <div>
                <label>Quota</label><br>
                <input type="number"
                       name="ticket_type_quota[]"
                       min="1"
                       required>
            </div>

            <br>

            <div>
                <label>Start Sale</label><br>
                <input type="datetime-local"
                       name="start_sale[]"
                       required>
            </div>

            <br>

            <div>
                <label>End Sale</label><br>
                <input type="datetime-local"
                       name="end_sale[]"
                       required>
            </div>

            <br>

            <button type="button"
                    onclick="this.parentElement.remove()">
                Hapus Ticket Type
            </button>

        </div>
        `
    );
}

</script>
<script>
function removeGallery(id, el) {
    if (!confirm("Yakin mau hapus gambar ini?")) return;

    fetch('/gallery/' + id, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            el.parentElement.remove();
        }
    });
}
</script>

</body>
</html>
