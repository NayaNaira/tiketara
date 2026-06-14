<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->insert([

            [
                'promoter_id' => 2,
                'title' => 'Jakarta Music Festival 2026',
                'description' => 'Festival musik terbesar dengan penampilan artis nasional dan internasional.',
                'category' => 'music_festival',
                'age_rating' => '17_plus',
                'venue_name' => 'Gelora Bung Karno',
                'address' => 'Jl. Pintu Satu Senayan',
                'city' => 'Jakarta',
                'event_date' => '2026-08-15',
                'start_time' => '15:00:00',
                'end_time' => '23:00:00',
                'max_ticket_per_order' => 5,
                'poster_path' => 'events/jakarta-music-festival.jpg',
                'status' => 'approved',
                'rejection_reason' => null,
                'terms_and_conditions' => 'Tiket yang sudah dibeli tidak dapat dikembalikan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'promoter_id' => 2,
                'title' => 'Indonesia Tech Summit',
                'description' => 'Seminar teknologi dan AI bersama para praktisi industri.',
                'category' => 'seminar_education',
                'age_rating' => '13_plus',
                'venue_name' => 'Jakarta Convention Center',
                'address' => 'Jl. Gatot Subroto',
                'city' => 'Jakarta',
                'event_date' => '2026-09-05',
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
                'max_ticket_per_order' => 10,
                'poster_path' => 'events/tech-summit.jpg',
                'status' => 'pending',
                'rejection_reason' => null,
                'terms_and_conditions' => 'Peserta wajib membawa identitas diri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'promoter_id' => 2,
                'title' => 'National Basketball Championship',
                'description' => 'Kejuaraan basket nasional antar provinsi.',
                'category' => 'sports',
                'age_rating' => 'all_ages',
                'venue_name' => 'Istora Senayan',
                'address' => 'Kompleks GBK',
                'city' => 'Jakarta',
                'event_date' => '2026-07-20',
                'start_time' => '13:00:00',
                'end_time' => '21:00:00',
                'max_ticket_per_order' => 6,
                'poster_path' => 'events/basketball.jpg',
                'status' => 'approved',
                'rejection_reason' => null,
                'terms_and_conditions' => 'Anak di bawah 5 tahun gratis tanpa kursi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'promoter_id' => 2,
                'title' => 'Bandung Theater Night',
                'description' => 'Pertunjukan teater modern dan budaya lokal.',
                'category' => 'arts_theater_culture',
                'age_rating' => '18_plus',
                'venue_name' => 'Bandung Creative Hub',
                'address' => 'Jl. Laswi No. 7',
                'city' => 'Bandung',
                'event_date' => '2026-10-31',
                'start_time' => '18:00:00',
                'end_time' => '23:30:00',
                'max_ticket_per_order' => 4,
                'poster_path' => 'events/theater-night.jpg',
                'status' => 'draft',
                'rejection_reason' => null,
                'terms_and_conditions' => 'Peserta wajib mengikuti aturan venue.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'promoter_id' => 2,
                'title' => 'Bali Summer Holiday Festival',
                'description' => 'Festival liburan musim panas dengan berbagai aktivitas keluarga.',
                'category' => 'lifestyle_holiday',
                'age_rating' => 'all_ages',
                'venue_name' => 'Atlas Beach Club',
                'address' => 'Jl. Pantai Berawa',
                'city' => 'Bali',
                'event_date' => '2026-12-20',
                'start_time' => '10:00:00',
                'end_time' => '22:00:00',
                'max_ticket_per_order' => 8,
                'poster_path' => 'events/bali-summer.jpg',
                'status' => 'approved',
                'rejection_reason' => null,
                'terms_and_conditions' => 'Tiket berlaku hanya pada tanggal yang tertera.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'promoter_id' => 2,
                'title' => 'Borobudur Heritage Tour',
                'description' => 'Wisata sejarah dan budaya ke kawasan Candi Borobudur.',
                'category' => 'attraction_tourism',
                'age_rating' => 'all_ages',
                'venue_name' => 'Candi Borobudur',
                'address' => 'Magelang, Jawa Tengah',
                'city' => 'Magelang',
                'event_date' => '2026-11-10',
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
                'max_ticket_per_order' => 10,
                'poster_path' => 'events/borobudur-tour.jpg',
                'status' => 'approved',
                'rejection_reason' => null,
                'terms_and_conditions' => 'Peserta wajib hadir 30 menit sebelum keberangkatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}