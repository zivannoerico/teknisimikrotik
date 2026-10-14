<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::firstOrCreate(
            ['email' => 'admin@teknisimikrotik.id'],
            [
                'name' => 'Administrator MikroTik',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Settings Website
        $settings = [
            'site_name' => 'TEKNISI MIKROTIK INDONESIA',
            'site_tagline' => 'Solusi Jasa Setting MikroTik Profesional, Cepat & Bergaransi',
            'whatsapp_number' => '6281234567890',
            'whatsapp_display' => '0812-3456-7890',
            'email' => 'support@teknisimikrotik.id',
            'address' => 'Jl. Jaringan Cepat No. 88, Jakarta Selatan & Melayani Remote Seluruh Indonesia',
            'operational_hours' => 'Senin - Sabtu: 08.00 - 22.00 WIB (Layanan Darurat 24/7)',
            'experience_years' => '8+',
            'completed_projects' => '1.250+',
            'happy_clients' => '980+',
            'uptime_guarantee' => '99.9%',
            'hero_title' => 'Jaringan Lambat & Sering Putus? Kami Bantu Optimalkan Jaringan MikroTik Anda.',
            'hero_subtitle' => 'Solusi konfigurasi jaringan yang disesuaikan dengan kebutuhan bisnis Anda, mulai dari manajemen bandwidth hingga keamanan dan kestabilan koneksi.',
        ];

        foreach ($settings as $key => $val) {
            Setting::set($key, $val);
        }

        // 3. Services
        $services = [
            [
                'title' => 'Multi-ISP Load Balancing & Failover',
                'slug' => 'multi-isp-load-balancing-failover',
                'icon' => 'network',
                'badge' => 'Paling Populer',
                'short_description' => 'Gabungkan 2 atau lebih ISP untuk kecepatan maksimal dan internet otomatis beralih tanpa jeda jika satu ISP mati.',
                'full_description' => 'Solusi cerdas bagi perusahaan yang bergantung pada internet 24/7. Menggunakan teknik PCC (Per Connection Classifier), ECMP, atau NTH yang disesuaikan dengan kebutuhan lalu lintas data Anda. Dilengkapi mekanisme script failover deteksi ping gateway.',
                'features' => [
                    'Metode PCC / ECMP / NTH Load Balancing',
                    'Deteksi ISP Down otomatis (Failover < 2 detik)',
                    'Pisah traffic browsing, streaming, dan aplikasi bisnis',
                    'Monitoring gateway via ping check',
                    'Backup konfigurasi cloud & lokal',
                ],
                'price_start' => 'Rp 450.000',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Bandwidth Management & QoS Prioritas',
                'slug' => 'bandwidth-management-qos',
                'icon' => 'gauge',
                'badge' => 'Esensial Kantor',
                'short_description' => 'Atur jatah bandwidth adil (Simple Queue / Queue Tree), prioritaskan Zoom meeting, ERP, dan batasi download/streaming berlebih.',
                'full_description' => 'Sering meeting online putus-putus karena ada karyawan yang nonton YouTube 4K? Dengan manajemen QoS bertingkat, traffic penting bisnis dijamin lancar dengan latency rendah bahkan saat internet sedang dipakai penuh.',
                'features' => [
                    'Queue Tree hierarkis atau Simple Queue dinamis',
                    'Prioritas packet VoIP / Zoom / Google Meet',
                    'Batas kecepatan per departemen / IP address',
                    'Burst limit untuk loading web cepat',
                    'Laporan penggunaan bandwidth',
                ],
                'price_start' => 'Rp 350.000',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Sistem Hotspot & Billing Voucher Cafe/Hotel',
                'slug' => 'hotspot-billing-voucher',
                'icon' => 'wifi',
                'badge' => 'Favorit Usaha',
                'short_description' => 'Template login page modern responsif brand Anda sendiri, integrasi Mikhmon voucher, limit waktu/kuota, dan isolasi antar pengguna.',
                'full_description' => 'Maksimalkan kepuasan pelanggan cafe, restoran, hotel, atau kos-kosan dengan login WiFi profesional yang menampilkan logo Anda. Dukungan penuh integrasi Mikhmon untuk generate ribuan voucher dengan mudah.',
                'features' => [
                    'Desain Login Page modern responsif & custom logo',
                    'Setup Mikhmon online / offline server',
                    'Limitasi per jam, per hari, atau berbasis kuota MB/GB',
                    'User profile kecepatan terpisah (Staff vs Tamu)',
                    'Proteksi Netcut, ARP spoofing & Client Isolation',
                ],
                'price_start' => 'Rp 500.000',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'VPN Antar Cabang (Site-to-Site & Remote Access)',
                'slug' => 'vpn-antar-cabang-remote-access',
                'icon' => 'shield-lock',
                'badge' => 'Keamanan Tinggi',
                'short_description' => 'Hubungkan kantor pusat dan cabang dengan tunnel terenkripsi (WireGuard / IPSec / L2TP / OpenVPN) serta akses aman kerja dari rumah.',
                'full_description' => 'Akses server lokal kantor, file sharing, aplikasi database ERP, dan CCTV cabang dari mana saja secara aman dengan enkripsi militer tanpa biaya sewa IP Publik statis di setiap cabang.',
                'features' => [
                    'Protokol modern WireGuard ultra-cepat & ringan',
                    'IPSec / L2TP enkripsi tingkat tinggi',
                    'Integrasi Dynamic DNS (Cloud MikroTik / Tunnel pihak ke-3)',
                    'Routing antar subnet otomatis',
                    'Panduan setup client Android, iOS, Windows, Mac',
                ],
                'price_start' => 'Rp 550.000',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Firewall Hardening & Proteksi Serangan Cyber',
                'slug' => 'firewall-hardening-security',
                'icon' => 'shield-check',
                'badge' => 'Proteksi Total',
                'short_description' => 'Kunci akses router dari brute force attack, port scanning, DDoS ringan, DNS hijacking, dan blokir situs berbahaya.',
                'full_description' => 'Amankan router Anda dari hacker global. Kami menerapkan checklist standard MikroTik Security Best Practices, menonaktifkan service rawan, membuat address list blacklist dinamis, dan menutup celah Winbox.',
                'features' => [
                    'Proteksi brute force SSH, FTP, Winbox, API',
                    'Tutup service default yang tidak dipakai',
                    'Blokir DoH bypass dan DNS Leak',
                    'Filter konten terlarang & judi via Layer 7 / RAW',
                    'Pencatatan log aktivitas mencurigakan',
                ],
                'price_start' => 'Rp 400.000',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Maintenance Jaringan Bulanan & Monitoring',
                'slug' => 'maintenance-jaringan-bulanan',
                'icon' => 'clock-history',
                'badge' => 'Untuk Bisnis',
                'short_description' => 'Dukungan teknisi standby, audit berkala, backup rutin otomatis, penanganan masalah darurat, dan konsultasi tak terbatas.',
                'full_description' => 'Fokuslah pada pertumbuhan bisnis Anda dan serahkan stabilitas infrastruktur jaringan kepada tim teknisi MikroTik bersertifikat. Layanan SLA jelas dan respon cepat saat kendala teknis.',
                'features' => [
                    'SLA Respon cepat < 30 menit',
                    'Backup script berkala ke Telegram / Email',
                    'Update RouterOS berkala yang aman & stabil',
                    'Inspeksi kesehatan CPU, memory, dan log traffic',
                    'Laporan performa jaringan bulanan',
                ],
                'price_start' => 'Rp 750.000 / bln',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'Setting Dasar & Konfigurasi Awal RouterOS',
                'slug' => 'setting-dasar-konfigurasi-awal',
                'icon' => 'cpu',
                'badge' => 'Setup Baru',
                'short_description' => 'Konfigurasi dari router kondisi nol pabrik: setup WAN, DHCP Server, DNS caching, NAT Masquerade, serta hardening akses.',
                'full_description' => 'Baru membeli router MikroTik tapi bingung cara settingnya? Kami bantu dari nol sampai seluruh perangkat di kantor/rumah terhubung internet dengan aman, cepat, dan rapi.',
                'features' => [
                    'Setup WAN DHCP / PPPoE Client / Static IP',
                    'Konfigurasi DHCP Server & Lease reservation',
                    'DNS Caching lokal untuk respon browsing cepat',
                    'Update RouterOS & firmware ke versi Long Term stabil',
                    'Backup script siap pakai di cloud & file lokal',
                ],
                'price_start' => 'Rp 250.000',
                'is_featured' => false,
                'sort_order' => 7,
            ],
            [
                'title' => 'VLAN & Segmentasi Jaringan Terisolasi',
                'slug' => 'vlan-segmentasi-jaringan',
                'icon' => 'layers',
                'badge' => 'Standard Enterprise',
                'short_description' => 'Pisahkan traffic divisi kantor, tamu, server lokal, dan IP Camera CCTV ke VLAN terpisah demi privasi dan keamanan tinggi.',
                'full_description' => 'Cegah virus/ransomware dari laptop karyawan menyebar ke server database. Menggunakan teknologi 802.1Q VLAN di MikroTik dan manage switch, setiap segmen jaringan terisolasi sempurna.',
                'features' => [
                    'Trunking & Access Port VLAN 802.1Q',
                    'Inter-VLAN Routing dengan firewall filter ketat',
                    'DHCP Server terpisah di masing-masing VLAN ID',
                    'Isolasi traffic CCTV & Server dari akses internet publik',
                    'Mencegah broadcast storm & loop jaringan',
                ],
                'price_start' => 'Rp 500.000',
                'is_featured' => false,
                'sort_order' => 8,
            ],
            [
                'title' => 'Solusi Jaringan RT/RW Net & PPPoE Server',
                'slug' => 'rtrw-net-pppoe-server-billing',
                'icon' => 'broadcast-pin',
                'badge' => 'Bisnis ISP Lokal',
                'short_description' => 'Konfigurasi PPPoE Server terintegrasi billing voucher, isolasi antar pelanggan, limit FUP otomatis, dan manajemen IP pool.',
                'full_description' => 'Bangun infrastruktur RT/RW Net yang handal dan anti-komplain. Kami setting PPPoE Server MikroTik dengan sistem isolasi pelanggan, sistem auto-isolir saat jatuh tempo, dan manajemen bandwidth rapi.',
                'features' => [
                    'Setup PPPoE Server & IP Pool dinamis/statis',
                    'Limitasi bandwidth per paket pelanggan (PCQ)',
                    'Integrasi aplikasi billing / Mikhmon / User Manager',
                    'Isolir otomatis saat jatuh tempo tagihan',
                    'Proteksi router dari akses unauthorized pelanggan',
                ],
                'price_start' => 'Rp 650.000',
                'is_featured' => false,
                'sort_order' => 9,
            ],
            [
                'title' => 'Network Monitoring Telegram & Setting OLT',
                'slug' => 'monitoring-telegram-setting-olt',
                'icon' => 'robot',
                'badge' => 'Otomasi Modern',
                'short_description' => 'Notifikasi real-time via Bot Telegram saat ISP putus atau router reboot, serta konfigurasi dasar OLT GPON/EPON untuk RT/RW Net.',
                'full_description' => 'Ketahui kendala jaringan Anda sebelum pelanggan komplain. Script monitoring MikroTik akan langsung mengirim pesan Telegram ketika gateway mati, link down, atau suhu CPU router abnormal.',
                'features' => [
                    'Script Bot Telegram Netwatch deteksi gateway down',
                    'Laporan harian penggunaan bandwidth otomatis',
                    'Notifikasi router reboot & perubahan konfigurasi',
                    'Setup dasar OLT GPON / EPON (HIOSO, VSOL, HSGQ)',
                    'Konfigurasi VLAN profile & DBA profile OLT',
                ],
                'price_start' => 'Rp 600.000',
                'is_featured' => false,
                'sort_order' => 10,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 4. Pricing Plans
        $plans = [
            [
                'name' => 'Paket Basic / Rumah / Kos',
                'badge' => 'Ekonomis',
                'price' => 350000,
                'billing_period' => 'sekali setting',
                'description' => 'Cocok untuk rumah tinggal, kos-kosan kecil (1-15 kamar), atau toko retail 1 ISP.',
                'features' => [
                    'Setting 1 ISP (DHCP / PPPoE Client / Static)',
                    'Konfigurasi DHCP Server & DNS Caching',
                    'Simple Queue Bandwidth Management adil',
                    'Firewall dasar & amankan service Winbox',
                    'Garansi remote & revisi 7 hari',
                    'Free backup script konfigurasi',
                ],
                'is_popular' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Paket Bisnis & Multi-ISP',
                'badge' => 'Paling Rekomendasi',
                'price' => 650000,
                'billing_period' => 'sekali setting',
                'description' => 'Pilihan utama kantor, cafe/restoran, klinik, dan bisnis yang butuh internet stabil 100%.',
                'features' => [
                    'Load Balancing 2-3 ISP (Metode PCC akurat)',
                    'Otomatis Failover (Auto pindah jika ISP drop)',
                    'Pisah traffic Browsing, Streaming, Game/VoIP',
                    'Queue Tree bandwidth prioritas Zoom/ERP',
                    'Firewall Hardening anti-bruteforce',
                    'Garansi pengerjaan & monitoring 14 hari',
                    'Dukungan remote via AnyDesk / TeamViewer',
                ],
                'is_popular' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Paket Enterprise & Antar Cabang',
                'badge' => 'Lengkap & Maksimal',
                'price' => 1250000,
                'billing_period' => 'sekali setting',
                'description' => 'Dirancang untuk perusahaan multi-cabang, pabrik, hotel berbintang, dan sekolah.',
                'features' => [
                    'Semua fitur Paket Bisnis & Multi-ISP',
                    'Setup VPN Inter-Branch (WireGuard / IPSec / OSPF)',
                    'Hotspot login page branding + Mikhmon voucher',
                    'VLAN Management untuk isolasi divisi kerja',
                    'Audit keamanan mendalam & RouterOS hardening',
                    'Auto-backup script ke Bot Telegram / Email',
                    'Garansi pendampingan penuh 30 hari',
                    'Prioritas konsultasi teknis langsung',
                ],
                'is_popular' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::updateOrCreate(['name' => $plan['name']], $plan);
        }

        // 5. Portfolios
        $portfolios = [
            [
                'title' => 'Optimalisasi Jaringan & Failover 3 ISP PT. Surya Logistik Makmur',
                'slug' => 'optimalisasi-failover-pt-surya-logistik',
                'client_name' => 'PT. Surya Logistik Makmur',
                'category' => 'Perkantoran',
                'location' => 'Tanjung Priok, Jakarta Utara',
                'summary' => 'Penanganan internet sering putus di kantor operasional pengiriman barang dengan load balancing 3 provider (Indihome, Biznet, MyRepublic).',
                'challenge' => 'Sistem monitoring logistik real-time sering offline saat salah satu provider gangguan, dan kecepatan download driver mengganggu meeting direksi.',
                'solution' => 'Menggunakan MikroTik CCR2004-16G-2S+, menerapkan load balancing PCC 3 ISP dengan script failover rekursif, serta Queue Tree prioritas tinggi untuk traffic ERP & Zoom.',
                'result' => 'Uptime operasional mencapai 99.98%, keluhan meeting patah-patah turun drastis 0%, staf dapat bekerja tanpa gangguan pergantian jalur.',
                'device_used' => 'MikroTik CCR2004-16G-2S+',
                'image' => 'portfolio-office.jpg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Sistem Hotspot Login & Voucher Terpadu Grand Palace Hotel & Convention',
                'slug' => 'hotspot-voucher-grand-palace-hotel',
                'client_name' => 'Grand Palace Hotel & Convention',
                'category' => 'Perhotelan',
                'location' => 'Semarang, Jawa Tengah',
                'summary' => 'Pemasangan sistem voucher terisolasi per kamar dan tamu lobby dengan integrasi Mikhmon dan template branding elegan.',
                'challenge' => 'Tamu mengeluh sinyal lambat akibat ada yang menggunakan download torrent tanpa batas, serta login lama.',
                'solution' => 'Konfigurasi MikroTik RB4011iGS+, custom responsive landing page dengan logo hotel, rate limit per user 10 Mbps, dan isolasi client agar antar tamu tidak dapat saling intip file sharing.',
                'result' => 'Review kepuasan WiFi tamu di OTA naik dari rating 3.2 ke 4.8 bintang, pemakaian bandwidth terkontrol rata.',
                'device_used' => 'MikroTik RB4011iGS+RM',
                'image' => 'portfolio-hotel.jpg',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Interkoneksi VPN WireGuard 8 Cabang Apotek & Klinik Sehat Prima',
                'slug' => 'interkoneksi-vpn-klinik-sehat-prima',
                'client_name' => 'Klinik Sehat Prima',
                'category' => 'Instansi Kesehatan',
                'location' => 'Bandung Raya & Cimahi',
                'summary' => 'Penyatuan database resep elektronik dan stok obat antar 8 cabang apotek ke server pusat di Bandung.',
                'challenge' => 'Cabang tidak memiliki IP Publik Statis, biaya sewa leased line sangat mahal, sinkronisasi stok obat sering terlambat.',
                'solution' => 'Pembangunan tunnel VPN WireGuard berkecepatan tinggi dengan routing lokal otomatis di router MikroTik hEX RB750Gr3 setiap cabang.',
                'result' => 'Sinkronisasi resep real-time instan, menghemat biaya sewa dedicated network hingga belasan juta rupiah per bulan dengan keamanan terenkripsi.',
                'device_used' => 'MikroTik hEX RB750Gr3 (8 Unit)',
                'image' => 'portfolio-vpn.jpg',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Manajemen Bandwidth Anti-Lag Kafe Kopi Nostalgia (120 Seat)',
                'slug' => 'manajemen-bandwidth-kafe-kopi-nostalgia',
                'client_name' => 'Kafe Kopi Nostalgia',
                'category' => 'Cafe & Resto',
                'location' => 'Yogyakarta',
                'summary' => 'Solusi pengunjung WFC (Work From Cafe) yang butuh koneksi stabil untuk video call tanpa lag dan streaming lancar.',
                'challenge' => 'Banyak pelanggan bermain game online (Mobile Legends / Valorant) mengeluh ping naik ke 200ms saat ada yang streaming YouTube 4K.',
                'solution' => 'Pemisahan port game online ke jalur fast-track prioritas latency rendah, burst queue untuk loading cepat, dan batas kuota browsing adil.',
                'result' => 'Ping game stabil konsisten di 15-25ms walau kafe sedang penuh 100+ pengguna aktif bersamaan.',
                'device_used' => 'MikroTik RB760iGS (hEX S)',
                'image' => 'portfolio-cafe.jpg',
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($portfolios as $port) {
            Portfolio::updateOrCreate(['slug' => $port['slug']], $port);
        }

        // 6. Articles
        $articles = [
            [
                'title' => 'Cara Memilih Metode Load Balancing MikroTik: PCC vs ECMP vs NTH',
                'slug' => 'cara-memilih-metode-load-balancing-mikrotik',
                'category' => 'Tutorial Jaringan',
                'excerpt' => 'Pelajari perbedaan mendasar teknik PCC, ECMP, dan NTH untuk menentukan mana yang paling stabil untuk kebutuhan kantor dan warnet.',
                'content' => 'Banyak teknisi pemula terjebak menyatukan dua ISP menggunakan ECMP biasa, lalu mendapati perbankan online (BCA/Mandiri) sering logout sendiri. Di artikel ini kita bedah secara tuntas mengapa PCC (Per Connection Classifier) adalah pilihan paling stabil untuk perbankan dan sesi secure socket layer.',
                'author_name' => 'Tim Teknisi MikroTik',
                'read_time' => 6,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Checklist Wajib Amankan MikroTik Anda dari Serangan Brute Force & Hacker',
                'slug' => 'checklist-wajib-amankan-mikrotik-dari-hacker',
                'category' => 'Keamanan Siber',
                'excerpt' => 'Langkah praktis mengamankan port Winbox, mematikan service rawan, dan membuat firewall drop otomatis untuk IP penyerang.',
                'content' => 'Router MikroTik adalah pintu gerbang utama jaringan Anda. Jika dibiarkan dengan user admin dan password kosong atau port default 8291 terbuka bebas ke internet, router Anda bisa disusupi dalam hitungan menit. Ikuti panduan hardening 7 langkah ini.',
                'author_name' => 'Fahri Pratama (MTCNA/MTCRE)',
                'read_time' => 8,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Panduan Setting Hotspot MikroTik dengan Mikhmon untuk Pemula',
                'slug' => 'panduan-setting-hotspot-mikrotik-mikhmon',
                'category' => 'Hotspot & Voucher',
                'excerpt' => 'Langkah demi langkah integrasi RouterOS dengan aplikasi manajemen Mikhmon untuk cetak voucher WiFi bisnis Anda.',
                'content' => 'Mikhmon (MikroTik Hotspot Monitor) adalah tools favorit di Indonesia untuk mengelola voucher WiFi cafe, RT/RW Net, dan kos-kosan. Artikel ini membahas cara aktivasi API, binding user privilege, dan tips mendesain template voucher yang menarik.',
                'author_name' => 'Tim Teknisi MikroTik',
                'read_time' => 7,
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // 7. FAQs
        $faqs = [
            [
                'question' => 'Bagaimana cara kerja jasa setting MikroTik via remote?',
                'answer' => 'Sangat mudah dan cepat! Anda cukup menghubungkan router MikroTik ke PC/Laptop dengan kabel LAN, lalu install software remote resmi seperti AnyDesk, TeamViewer, atau UltraViewer. Teknisi kami akan langsung memandu Anda dan melakukan setting secara live transparan di depan layar Anda.',
                'category' => 'Layanan & Pengerjaan',
                'sort_order' => 1,
            ],
            [
                'question' => 'Apakah melayani kunjungan setting langsung on-site ke lokasi?',
                'answer' => 'Ya, kami melayani kunjungan teknisi langsung (on-site) untuk wilayah Jabodetabek, Bandung, Surabaya, dan sekitarnya untuk instalasi rackmount, penarikan kabel LAN/FO, dan konfigurasi full enterprise. Untuk luar kota, kami menyediakan layanan remote 100% yang sama efektifnya.',
                'category' => 'Layanan & Pengerjaan',
                'sort_order' => 2,
            ],
            [
                'question' => 'Berapa lama proses setting MikroTik biasanya berlangsung?',
                'answer' => 'Untuk setting dasar dan paket rumah/kos rata-rata memerlukan waktu 45 - 90 menit. Untuk paket multi-ISP, load balancing, QoS, dan Hotspot berkisar antara 2 - 3 jam tergantung kompleksitas topologi jaringan Anda.',
                'category' => 'Layanan & Pengerjaan',
                'sort_order' => 3,
            ],
            [
                'question' => 'Apakah ada garansi jika internet bermasalah setelah disetting?',
                'answer' => 'Pasti ada! Kami memberikan garansi purna-jual 7 hingga 30 hari (tergantung paket yang dipilih). Selama masa garansi, revisi setting, penyesuaian bandwidth, dan troubleshooting jika ada kendala bebas biaya tambahan.',
                'category' => 'Garansi & Biaya',
                'sort_order' => 4,
            ],
            [
                'question' => 'Bagaimana jika router saya belum memiliki IP Publik Statis untuk VPN?',
                'answer' => 'Tenang saja, kami memiliki solusi Cloud DDNS bawaan RouterOS dan layanan VPN Remote Reverse Tunneling. Anda tetap bisa mengakses MikroTik, server kantor, dan CCTV dari luar tanpa wajib sewa IP Publik statis bulanan yang mahal dari ISP.',
                'category' => 'Teknis',
                'sort_order' => 5,
            ],
            [
                'question' => 'Apakah router harus dibeli dari penyedia jasa?',
                'answer' => 'Tidak wajib. Anda bebas menggunakan router MikroTik yang sudah Anda miliki (seperti seri hEX, RB3011, RB4011, CCR, atau Cloud Core Router lainnya). Jika Anda belum memiliki unit, kami siap memberikan konsultasi gratis mengenai tipe dan spesifikasi hardware yang paling ideal sesuai kebutuhan jumlah user dan jalur ISP Anda.',
                'category' => 'Umum',
                'sort_order' => 7,
            ],
            [
                'question' => 'Apakah melayani klien di luar kota atau luar pulau?',
                'answer' => 'Sangat bisa! Layanan setting MikroTik kami dapat dilakukan secara remote 100% dari jarak jauh ke seluruh wilayah Indonesia menggunakan koneksi aman AnyDesk atau TeamViewer. Hasil konfigurasi remote terbukti sama presisi dan stabilnya dengan pengerjaan langsung di lokasi.',
                'category' => 'Layanan & Pengerjaan',
                'sort_order' => 8,
            ],
        ];

        foreach ($faqs as $f) {
            Faq::updateOrCreate(['question' => $f['question']], $f);
        }
    }
}
