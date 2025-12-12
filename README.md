# WEAPS-SSU: Workforce Employment Alumni Portal System

<p align="center">
  <img src="https://cdn.bulan.sorsu.edu.ph/images/ssu-logo.webp" alt="SSU Logo" width="200">
  <br>
  <strong>SorSu State University Alumni Job Portal</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red.svg" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Filament-4-blue.svg" alt="Filament 4">
  <img src="https://img.shields.io/badge/PHP-8.2+-purple.svg" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="MIT License">
</p>

## 📋 Overview

WEAPS-SSU is a comprehensive job portal system designed specifically for SorSu State University (SSU) alumni. The platform connects qualified alumni with employers, featuring advanced verification systems, AI-powered content validation, and comprehensive analytics.

### 🎯 Key Features

- **Multi-Role Architecture**: Separate interfaces for Alumni, Employers, and Administrators
- **AI Content Validation**: Advanced detection of AI-generated resumes and content
- **School Verification**: Secure alumni verification through SSU records
- **Advanced Job Matching**: Intelligent job-alumni matching system
- **Analytics Dashboard**: Comprehensive reporting and insights
- **Company Reviews**: Alumni feedback and rating system
- **Real-time Notifications**: Email and in-app notifications
- **Mobile Responsive**: Optimized for all devices

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL/PostgreSQL

### Installation

```bash
# Clone the repository
git clone <repository-url>
cd weaps-ssu

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
# Run migrations and seeders
php artisan migrate --seed

# Build assets
npm run build

# Start the development server
php artisan serve
```

### Seeding Commands
```bash
php seed.php
php active_user.php
php update_seed.php
php artisan db:seed --class=CarrerSeeder
php artisan db:seed --class=ApplicantSeeder
```

## 👥 User Roles & Access

### 🔐 Administrator Panel (`/admin`)
- User and company verification management
- System analytics and reporting
- Content moderation and oversight
- Platform configuration and maintenance

📖 **[Complete Admin Guide](ADMIN_README.md)**

### 👨‍🎓 Alumni Portal (Public Interface)
- Job search and application system
- Curriculum vitae management
- Company research and reviews
- Professional networking tools

📖 **[Complete Alumni Guide](ALUMNI_README.md)**

### 🏢 Employer Panel (`/`)
- Job posting and management
- Applicant screening and evaluation
- Company profile management
- Recruitment analytics and reporting

📖 **[Complete Employer Guide](EMPLOYER_README.md)**

## 🏗️ Architecture

### Tech Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Livewire 3, Alpine.js
- **Admin Panel**: Filament 4
- **Database**: MySQL/PostgreSQL with Eloquent ORM
- **Styling**: Tailwind CSS
- **Authentication**: Laravel Sanctum + Social Auth
- **File Storage**: Laravel Storage with signed URLs

### Key Dependencies
- `filament/filament`: Admin panel framework
- `jeffgreco13/filament-breezy`: User profile management
- `bezhansalleh/filament-shield`: Role-based permissions
- `leandrocfe/filament-apex-charts`: Analytics charts
- `laravel/socialite`: Social authentication
- `maatwebsite/excel`: Data export functionality

## 📊 Database Schema

### Core Models
- **Users**: Base user model with role management
- **CurriculumVitae**: Alumni resume and profile data
- **Company**: Employer organization profiles
- **Carrer**: Job posting information
- **Applicant**: Job application records
- **SystemLog**: Audit trail for all activities

### Key Relationships
- User ↔ CurriculumVitae (One-to-One)
- User ↔ Company (One-to-Many)
- Company ↔ Carrer (One-to-Many)
- Carrer ↔ Applicant (One-to-Many)
- User ↔ Applicant (One-to-Many)

## 🔒 Security Features

- **Role-Based Access Control**: Spatie Laravel Permission integration
- **AI Content Detection**: Automated validation of user-generated content
- **File Security**: Signed URLs for private file access
- **CSRF Protection**: Laravel's built-in CSRF protection
- **Input Validation**: Comprehensive validation on all forms
- **Audit Logging**: Complete activity tracking

## 📈 Analytics & Reporting

### Available Metrics
- Application frequency and trends
- Hiring success rates
- User engagement statistics
- Job posting performance
- Company review analytics
- Alumni employment tracking

### Dashboard Widgets
- Real-time statistics cards
- Interactive charts and graphs
- Applicant distribution analytics
- Career posting trends
- Gender and employment status breakdowns

## 🌐 API Endpoints

### Public Endpoints
- `GET /cv/{id}` - View curriculum vitae
- `GET /career/{id}` - Job details
- `POST /career/apply` - Submit job application
- `POST /company/review/store` - Submit company review

### Admin Endpoints
- `GET /inActiveResume` - Inactive resume management
- `POST /api/a/i/varification` - AI content verification
- `POST /verification/update-role/{type}` - User verification

## 🚀 Deployment

### Production Setup
```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Run queue worker (if using queues)
php artisan queue:work
```

### Environment Variables
```env
# Application
APP_NAME="WEAPS-SSU"
APP_ENV=production
APP_KEY=base64:your-app-key
APP_DEBUG=false

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=weaps_ssu
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password

# File Storage
FILESYSTEM_DISK=public
AWS_ACCESS_KEY_ID=your-aws-key
AWS_SECRET_ACCESS_KEY=your-aws-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Check the role-specific README files
- **Issues**: Report bugs via GitHub Issues
- **Discussions**: Join community discussions
- **Email**: Contact the development team

## 🙏 Acknowledgments

- **Laravel Framework**: For the robust backend foundation
- **Open Source Community**: For the amazing tools and libraries

---

<p align="center">
  <strong>Built with ❤️ for SSU Alumni</strong>
  <br>
  Connecting talent with opportunity since 2024
</p>
