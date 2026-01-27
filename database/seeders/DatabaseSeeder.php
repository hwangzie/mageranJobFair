<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Perusahaan;
use App\Models\JobPosting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'nomor_telepon' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // Create Company Users
        $perusahaan1 = User::create([
            'name' => 'PT. Tech Indonesia',
            'email' => 'company1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'company',
            'nomor_telepon' => '081234567891',
            'email_verified_at' => now(),
        ]);

        // profile perushaan 1
        Perusahaan::create([
            'user_id' => $perusahaan1->id,
            'nama_perusahaan' => 'PT. Tech Indonesia',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'deskripsi' => 'Perusahaan teknologi terkemuka di Indonesia yang fokus pada pengembangan perangkat lunak dan solusi digital inovatif.',
        ]);

        $perusahaan2 = User::create([
            'name' => 'CV. Digital Solutions',
            'email' => 'company2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'company',
            'nomor_telepon' => '081234567892',
            'email_verified_at' => now(),
        ]);

        // profile perushaan 2
        Perusahaan::create([
            'user_id' => $perusahaan2->id,
            'nama_perusahaan' => 'CV. Digital Solutions',
            'alamat' => 'Jl. Sudirman No. 456, Bandung',
            'deskripsi' => 'Penyedia layanan digital terkemuka yang menawarkan solusi IT lengkap mulai dari pengembangan web hingga pemasaran digital.',
        ]);


        // Create Job Seeker Users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'jobseeker1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'job_seeker',
            'nomor_telepon' => '081234567893',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'jobseeker2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'job_seeker',
            'nomor_telepon' => '081234567894',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'jobseeker3@example.com',
            'password' => Hash::make('password123'),
            'role' => 'job_seeker',
            'nomor_telepon' => '081234567895',
            'email_verified_at' => now(),
        ]);

        // Create Job Postings for Company 1
        $job1 = JobPosting::create([
            'perusahaan_id' => $perusahaan1->id,
            'title' => 'Senior Full Stack Developer',
            'slug' => Str::slug('Senior Full Stack Developer'),
            'deskripsi' => '<p>We are looking for an experienced Full Stack Developer to join our dynamic team. You will be responsible for developing and maintaining web applications using modern technologies.</p><p><strong>Key Responsibilities:</strong></p><ul><li>Develop front-end and back-end components</li><li>Collaborate with cross-functional teams</li><li>Write clean, maintainable code</li><li>Participate in code reviews</li></ul>',
            'syarat' => '<ul><li>Bachelor\'s degree in Computer Science or related field</li><li>5+ years of experience in web development</li><li>Proficient in Laravel, Vue.js, and MySQL</li><li>Strong problem-solving skills</li><li>Excellent communication skills</li></ul>',
            'lokasi' => 'Jakarta',
            'tipe_pekerjaan' => 'Full-time',
            'gaji_min' => 15000000,
            'gaji_max' => 25000000,
            'status' => 'buka',
        ]);

        JobPosting::create([
            'perusahaan_id' => $perusahaan2->id,
            'title' => 'UI/UX Designer',
            'slug' => Str::slug('UI/UX Designer'),
            'deskripsi' => '<p>Join our creative team as a UI/UX Designer. You will design intuitive and engaging user interfaces for our digital products.</p><p><strong>What You\'ll Do:</strong></p><ul><li>Create wireframes and prototypes</li><li>Design user interfaces</li><li>Conduct user research</li><li>Work with developers to implement designs</li></ul>',
            'syarat' => '<ul><li>3+ years of UI/UX design experience</li><li>Portfolio showcasing design work</li><li>Proficient in Figma, Adobe XD</li><li>Understanding of user-centered design principles</li><li>Strong attention to detail</li></ul>',
            'lokasi' => 'Jakarta',
            'tipe_pekerjaan' => 'Full-time',
            'gaji_min' => 10000000,
            'gaji_max' => 18000000,
            'status' => 'buka',
        ]);

        JobPosting::create([
            'perusahaan_id' => $perusahaan1->id,
            'title' => 'DevOps Engineer',
            'slug' => Str::slug('DevOps Engineer'),
            'deskripsi' => '<p>We need a skilled DevOps Engineer to manage our infrastructure and deployment pipelines.</p>',
            'syarat' => '<ul><li>Experience with AWS/GCP</li><li>Knowledge of Docker and Kubernetes</li><li>CI/CD pipeline experience</li><li>Linux administration skills</li></ul>',
            'lokasi' => 'Jakarta',
            'tipe_pekerjaan' => 'Full-time',
            'gaji_min' => 12000000,
            'gaji_max' => 20000000,
            'status' => 'buka',
        ]);

        // Create Job Postings for Company 2
        JobPosting::create([
            'perusahaan_id' => $perusahaan2->id,
            'title' => 'Digital Marketing Specialist',
            'slug' => Str::slug('Digital Marketing Specialist'),
            'deskripsi' => '<p>Looking for a creative Digital Marketing Specialist to develop and execute marketing campaigns across various digital channels.</p><p><strong>Responsibilities:</strong></p><ul><li>Manage social media accounts</li><li>Create content for digital campaigns</li><li>Analyze campaign performance</li><li>SEO/SEM optimization</li></ul>',
            'syarat' => '<ul><li>2+ years in digital marketing</li><li>Experience with Google Analytics, Facebook Ads</li><li>Strong copywriting skills</li><li>Creative thinking</li><li>Data-driven mindset</li></ul>',
            'lokasi' => 'Bandung',
            'tipe_pekerjaan' => 'Full-time',
            'gaji_min' => 8000000,
            'gaji_max' => 15000000,
            'status' => 'buka',
        ]);

        JobPosting::create([
            'perusahaan_id' => $perusahaan1->id,
            'title' => 'Frontend Developer',
            'slug' => Str::slug('Frontend Developer'),
            'deskripsi' => '<p>Join our team as a Frontend Developer and create amazing user experiences.</p>',
            'syarat' => '<ul><li>Strong JavaScript/TypeScript skills</li><li>Experience with React or Vue.js</li><li>HTML5, CSS3, responsive design</li><li>Git version control</li></ul>',
            'lokasi' => 'Bandung',
            'tipe_pekerjaan' => 'Contract',
            'gaji_min' => 9000000,
            'gaji_max' => 16000000,
            'status' => 'buka',
        ]);

        JobPosting::create([
            'perusahaan_id' => $perusahaan1->id,
            'title' => 'Project Manager',
            'slug' => Str::slug('Project Manager'),
            'deskripsi' => '<p>Experienced Project Manager needed to oversee digital projects from inception to delivery.</p>',
            'syarat' => '<ul><li>PMP certification preferred</li><li>5+ years project management experience</li><li>Agile/Scrum methodology</li><li>Leadership skills</li></ul>',
            'lokasi' => 'Bandung',
            'tipe_pekerjaan' => 'Full-time',
            'gaji_min' => 13000000,
            'gaji_max' => 22000000,
            'status' => 'buka',
        ]);
    }
}
