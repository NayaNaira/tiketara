<?php

namespace App\Http\Controllers;

use App\Models\EventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventGalleryController extends Controller
{
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $uploadedImages = [];

        foreach ($request->file('images') as $file) {
            $path = $file->store('events', 'public');

            $gallery = EventGallery::create([
                'event_id' => $eventId,
                'image_path' => $path
            ]);

            $uploadedImages[] = $gallery;
        }

        return response()->json([
            'success' => true,
            'message' => 'Images uploaded successfully',
            'data' => $uploadedImages
        ]);
    }

    public function destroy($id)
    {
        $image = EventGallery::findOrFail($id);

        // delete file dari storage
        Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}