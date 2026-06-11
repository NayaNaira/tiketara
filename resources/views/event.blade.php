<!DOCTYPE html>

<html>
<head>
    <title>Test Event CRUD</title>

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

<h2>Create Event</h2>

<form action="{{ route('event.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div>
    <label>Title</label><br>
    <input type="text"
           name="title"
           required>
</div>

<br>

<div>
    <label>Description</label><br>
    <textarea name="description"
              rows="4"
              cols="50"
              required></textarea>
</div>

<br>

<div>
    <label>Ticket Price</label><br>
    <input type="number"
           name="ticket_price"
           min="0"
           required>
</div>

<br>

<div>
    <label>Category</label><br>

    <select name="category" required>

        <option value="music_festival">
            Music Festival
        </option>

        <option value="seminar_education">
            Seminar Education
        </option>

        <option value="sports">
            Sports
        </option>

        <option value="arts_theater_culture">
            Arts Theater Culture
        </option>

        <option value="lifestyle_holiday">
            Lifestyle Holiday
        </option>

        <option value="attraction_tourism">
            Attraction Tourism
        </option>

    </select>
</div>

<br>

<div>
    <label>Ticket Quota</label><br>
    <input type="number"
           name="ticket_quota"
           min="1"
           required>
</div>
<div>
    <label>Maximum Ticket Per Order</label><br>
    <input
        type="number"
        name="max_ticket_per_order"
        min="1"
        value="5"
        required
    >
</div>
<div>
    <label>Venue Name</label><br>
    <input type="text"
           name="venue_name"
           required>
</div>

<br>

<div>
    <label>Venue Address</label><br>
    <textarea name="address"
              required></textarea>
</div>
<div>
    <label>City</label><br>
    <textarea name="city"
              required></textarea>
</div>

<br>

<div>
    <label>Event Date</label><br>
    <input type="datetime-local"
           name="event_date"
           required>
</div>
<div>
        <label>Start Time</label><br>
        <input type="time"
               name="start_time"
               required>
    </div>
<div>
        <label>End Time</label><br>
        <input type="time"
               name="end_time"
               required>
    </div>

<br>

<div>
    <label>Terms & Conditions</label><br>
    <textarea name="terms_and_conditions"
              rows="4"
              cols="50"
              required></textarea>
</div>

<br>

<div>
    <label>Poster</label><br>

    <input
        type="file"
        name="poster"
        accept="image/*"
        required
    >
</div>

<br>

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

    <div class="ticket-item" style="border:1px solid #ccc;padding:10px;margin-bottom:10px;">

        <div>
            <label>Ticket Name</label><br>
            <input type="text" name="ticket_name[]" required>
        </div>

        <br>

        <div>
            <label>Price</label><br>
            <input type="number" name="ticket_type_price[]" min="0" required>
        </div>

        <br>

        <div>
            <label>Quota</label><br>
            <input type="number" name="ticket_type_quota[]" min="1" required>
        </div>

        <br>

        <div>
            <label>Start Sale</label><br>
            <input type="datetime-local" name="start_sale[]" required>
        </div>

        <br>

        <div>
            <label>End Sale</label><br>
            <input type="datetime-local" name="end_sale[]" required>
        </div>

    </div>

</div>

<button type="button" onclick="addTicketType()">
    + Tambah Ticket Type
</button>

<br><br>

<button type="submit">
    Create Event
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
                src="{{ asset('storage/'.$event->poster_path) }}"
                width="120"
            >

        @endif

    </td>

    <td>

        @foreach($event->galleries as $image)

            <img
                src="{{ asset('storage/'.$image->image_path) }}"
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

    <br><br>

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

</body>
</html>
