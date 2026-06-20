<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\TicketType;
use App\Models\EventGallery;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA MASTER EVENT KOMUNITAS URBAN & KREATIF (TERMS & CONDITIONS DETAIL)
        $eventsData = [
            [
                'event' => [
                    'promoter_id' => 2,
                    'title' => 'Saturday Live Session: Indie Music Night',
                    'description' => 'Sesi intim musik indie lokal bareng komunitas musisi kota. Nikmati malam minggu syahdu dengan alunan musik folk dan pop-indie.',
                    'category' => 'music_festival',
                    'age_rating' => 'all_ages',
                    'venue_name' => 'The Backyard Creative Space',
                    'address' => 'Jl. Kenanga No. 18 (Area Outdoor Café)',
                    'city' => 'Bandung',
                    'event_date' => '2026-08-15',
                    'start_time' => '19:00:00',
                    'end_time' => '22:00:00',
                    'max_ticket_per_order' => 4,
                    'poster_path' => 'events/indie-night.jpg',
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'terms_and_conditions' => "1. Tiket yang sudah dibeli bersifat final dan tidak dapat dibatalkan, di-refund, atau diuangkan kembali.\n2. Pembeli wajib menunjukkan E-Ticket resmi beserta kartu identitas (KTP/SIM/Paspor) yang sah pada saat registrasi masuk.\n3. Satu E-Ticket hanya berlaku untuk 1 (satu) orang pengunjung.\n4. Harga tiket sudah termasuk 1 (satu) minuman gratis yang dapat ditukarkan di area bar kafe.\n5. Pengunjung dilarang membawa makanan dan minuman dari luar area The Backyard Creative Space.\n6. Dilarang keras membawa senjata tajam, senjata api, obat-obatan terlarang, serta minuman beralkohol.\n7. Penyelenggara berhak mengeluarkan pengunjung yang membuat kegaduhan atau tidak mematuhi protokol ketertiban demi kenyamanan bersama.",
                ],
                'tickets' => [
                    ['name' => 'Early Bird', 'price' => 35000, 'quota' => 30],
                    ['name' => 'Regular Pass', 'price' => 50000, 'quota' => 70],
                ],
                'galleries' => [
                    'galleries/indie-1.jpg', 'galleries/indie-2.jpg'
                ]
            ],
            [
                'event' => [
                    'promoter_id' => 2,
                    'title' => 'Tech & Coffee: Building Startup with AI',
                    'description' => 'Sharing session santai sesama tech-enthusiast dan developer lokal. Kupas tuntas pemanfaatan AI untuk efisiensi bisnis rintisan.',
                    'category' => 'seminar_education',
                    'age_rating' => '13_plus',
                    'venue_name' => 'Kopi & Ruang Kerja Co-Working',
                    'address' => 'Sudirman Avenue Blk C/12',
                    'city' => 'Jakarta',
                    'event_date' => '2026-09-05',
                    'start_time' => '10:00:00',
                    'end_time' => '13:00:00',
                    'max_ticket_per_order' => 5,
                    'poster_path' => 'events/tech-coffee.jpg',
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'terms_and_conditions' => "1. Registrasi ulang dibuka 45 menit sebelum acara dimulai. Pengunjung disarankan datang tepat waktu untuk menghindari antrean.\n2. E-Ticket akan di-scan di pintu masuk. Harap siapkan barcode dengan kecerahan layar handphone yang cukup.\n3. Fasilitas yang didapatkan meliputi akses workshop, free-flow coffee/tea, kudapan ringan, serta E-Certificate resmi yang dikirimkan maksimal H+3 acara melalui email terdaftar.\n4. Pengunjung diwajibkan membawa laptop atau perangkat pendukung sendiri jika ingin mengikuti sesi praktik secara langsung.\n5. Dilarang melakukan perekaman video secara utuh selama pemaparan materi tanpa izin tertulis dari panitia.\n6. Panitia tidak bertanggung jawab atas kehilangan barang pribadi milik pengunjung selama acara berlangsung.",
                ],
                'tickets' => [
                    ['name' => 'Seat Pass', 'price' => 45000, 'quota' => 50],
                ],
                'galleries' => [
                    'galleries/tech-1.jpg', 'galleries/tech-2.jpg'
                ]
            ],
            [
                'event' => [
                    'promoter_id' => 4,
                    'title' => '3on3 Community Basketball League',
                    'description' => 'Turnamen basket 3on3 antar komunitas regional. Tunjukkan skill tim kamu dan bawa pulang hadiah jutaan rupiah!',
                    'category' => 'sports',
                    'age_rating' => 'all_ages',
                    'venue_name' => 'Gor Pemuda Indoor Court',
                    'address' => 'Kompleks Olahraga Rakyat',
                    'city' => 'Surabaya',
                    'event_date' => '2026-07-20',
                    'start_time' => '09:00:00',
                    'end_time' => '17:00:00',
                    'max_ticket_per_order' => 2,
                    'poster_path' => 'events/basketball-league.jpg',
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'terms_and_conditions' => "1. Tiket penonton berlaku untuk akses satu hari penuh ke area tribun GOR Pemuda Indoor Court.\n2. Pengunjung wajib menjaga kebersihan dan dilarang membuang sampah sembarangan di area tribun maupun lapangan.\n3. Penonton dilarang memasuki area *court* (lapangan pertandingan) kecuali atas instruksi dari panitia atau wasit.\n4. Dilarang membawa atribut politik, spanduk yang bersifat provokatif, rasis, atau mengandung unsur SARA.\n5. Semua pengunjung wajib menggunakan sepatu olahraga atau alas kaki yang tidak merusak lantai lapangan indoor.\n6. Apabila terjadi keributan atau tindakan anarkis, pihak keamanan berhak mengusir pelaku dari area GOR tanpa ada pengembalian uang tiket.\n7. Keputusan panitia dan wasit pertandingan bersifat mutlak dan tidak dapat diganggu gugat.",
                ],
                'tickets' => [
                    ['name' => 'General Admission', 'price' => 20000, 'quota' => 150],
                ],
                'galleries' => [
                    'galleries/basket-1.jpg', 'galleries/basket-2.jpg'
                ]
            ],
            [
                'event' => [
                    'promoter_id' => 2,
                    'title' => 'Art & Verse: Malam Puisi Pop-Up',
                    'description' => 'Kolaborasi pameran seni visual lokal mini dengan panggung pembacaan puisi kontemporer. Ruang berekspresi tanpa batas.',
                    'category' => 'arts_theater_culture',
                    'age_rating' => 'all_ages',
                    'venue_name' => 'Kala Kini Art Gallery',
                    'address' => 'Jl. Braga No. 44',
                    'city' => 'Bandung',
                    'event_date' => '2026-10-31',
                    'start_time' => '19:00:00',
                    'end_time' => '21:30:00',
                    'max_ticket_per_order' => 4,
                    'poster_path' => 'events/art-verse.jpg',
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'terms_and_conditions' => "1. Pengunjung wajib menjaga ketenangan dan suasana kondusif selama acara pembacaan puisi dan teater berlangsung.\n2. Dilarang menyentuh, merusak, atau mengotori instalasi karya seni yang dipajang di dalam Kala Kini Art Gallery.\n3. Diperbolehkan mengambil foto menggunakan kamera handphone tanpa menyalakan fitur lampu kilat (*flash photography*).\n4. Penggunaan kamera profesional (DSLR/Mirrorless) untuk keperluan komersial wajib melaporkan diri ke meja registrasi terlebih dahulu.\n5. Gerbang masuk galeri akan ditutup 15 menit setelah pertunjukan utama dimulai demi menjaga kekhusyukan acara.\n6. Pengunjung yang terlambat baru diperbolehkan masuk pada saat sesi jeda atau *break*.",
                ],
                'tickets' => [
                    ['name' => 'Art Pass', 'price' => 30000, 'quota' => 80],
                ],
                'galleries' => [
                    'galleries/art-1.jpg'
                ]
            ],
            [
                'event' => [
                    'promoter_id' => 5,
                    'title' => 'Sunday Urban Market: Food & Thrifting',
                    'description' => 'Pasar akhir pekan anak muda! Berburu baju-baju vintage/thrift pilihan sekalian jajan kuliner artisan lokal yang hits.',
                    'category' => 'lifestyle_holiday',
                    'age_rating' => 'all_ages',
                    'venue_name' => 'Downtown Parking Lot & Plaza',
                    'address' => 'Pusat Belanja Sudirman',
                    'city' => 'Jakarta',
                    'event_date' => '2026-12-20',
                    'start_time' => '10:00:00',
                    'end_time' => '21:00:00',
                    'max_ticket_per_order' => 5,
                    'poster_path' => 'events/urban-market.jpg',
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'terms_and_conditions' => "1. Tiket fisik atau E-Ticket harian wajib disimpan selama berada di dalam area festival.\n2. Tiket masuk yang valid dapat ditukarkan dengan voucher potongan belanja senilai Rp5.000 di tenant thrift atau F&B tertentu dengan syarat minimum belanja.\n3. Pengunjung bertanggung jawab penuh atas barang belanjaan dan barang bawaan pribadi masing-masing.\n4. Transaksi di dalam area market disarankan menggunakan pembayaran non-tunai (QRIS/E-Wallet), namun tetap sediakan uang tunai secukupnya.\n5. Pembeli diharapkan membawa kantong belanja ramah lingkungan sendiri (*tote bag*) guna mengurangi sampah plastik.\n6. Area ini ramah hewan peliharaan (*pet-friendly*), dengan syarat hewan peliharaan menggunakan tali pengikat (*leash*) dan kebersihannya dijaga oleh pemilik.",
                ],
                'tickets' => [
                    ['name' => 'Daily Pass Ticket', 'price' => 15000, 'quota' => 300],
                ],
                'galleries' => [
                    'galleries/market-1.jpg', 'galleries/market-2.jpg'
                ]
            ],
            [
                'event' => [
                    'promoter_id' => 5,
                    'title' => 'City Heritage Photowalk',
                    'description' => 'Jalan santai bersama komunitas fotografi menyusuri sudut-sudut arsitektur tua kota lama sambil berburu foto estetik.',
                    'category' => 'attraction_tourism',
                    'age_rating' => 'all_ages',
                    'venue_name' => 'Titik Kumpul Post Office Heritage',
                    'address' => 'Kawasan Kota Lama',
                    'city' => 'Semarang',
                    'event_date' => '2026-11-10',
                    'start_time' => '06:30:00',
                    'end_time' => '10:00:00',
                    'max_ticket_per_order' => 3,
                    'poster_path' => 'events/photowalk.jpg',
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'terms_and_conditions' => "1. Tiket pendaftaran sudah termasuk atribut photowalk (peta rute, stiker komunitas) dan air mineral botol.\n2. Pengunjung bebas menggunakan jenis kamera apapun, mulai dari kamera HP, Analog, Mirrorless, hingga DSLR.\n3. Rute jalan kaki akan melewati area publik dan jalan raya umum. Seluruh peserta wajib mengutamakan keselamatan dan mematuhi rambu lalu lintas.\n4. Dilarang memotret objek atau area militer/privat yang memiliki tanda larangan memotret.\n5. Selama photowalk berlangsung, peserta dilarang merusak fasilitas cagar budaya atau mengganggu kenyamanan pejalan kaki lainnya.\n6. Acara akan tetap berlangsung jika hujan ringan (gerimis). Peserta disarankan membawa pelindung kamera tambahan (*rain cover*) dan payung/jas hujan pribadi.",
                ],
                'tickets' => [
                    ['name' => 'Registration Fee', 'price' => 25000, 'quota' => 60],
                ],
                'galleries' => [
                    'galleries/photo-1.jpg'
                ]
            ],
        ];

        // 2. KODE EKSEKUSI INSERT DATABASE
        foreach ($eventsData as $item) {
            $event = Event::create($item['event']);

            foreach ($item['tickets'] as $ticketData) {
                TicketType::create([
                    'event_id'   => $event->id,
                    'name'       => $ticketData['name'],
                    'price'      => $ticketData['price'],
                    'quota'      => $ticketData['quota'],
                    'sold'       => 0,
                    'start_sale' => now(),
                    'end_sale'   => now()->addMonths(3),
                    'status'     => 'active',
                ]);
            }

            foreach ($item['galleries'] as $imgPath) {
                EventGallery::create([
                    'event_id'   => $event->id,
                    'image_path' => $imgPath,
                ]);
            }
        }
    }
}