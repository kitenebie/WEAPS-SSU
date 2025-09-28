<?php

namespace Database\Seeders;

use App\Models\CurriculumVitae;
use Illuminate\Database\Seeder;

class SampleCurriculumVitaeSeeder extends Seeder
{
    public function run(): void
    {
        CurriculumVitae::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'middle_name' => 'Michael',
            'email' => 'john.doe@example.com',
            'phone' => '+1 (555) 123-4567',
            'address' => '123 Main Street, San Francisco, CA 94102',
            'job_title' => 'Senior Full Stack Developer',
            'summary' => 'Passionate and experienced full stack developer with 8+ years of expertise in modern web technologies. Proven track record of delivering scalable applications and leading development teams. Strong advocate for clean code, agile methodologies, and continuous learning.',
            'highest_degree' => 'Master of Science in Software Engineering',
            'university' => 'Stanford University',
            'graduation_year' => 2019,
            'years_of_experience' => 8,
            'skills' => [
                ['name' => 'JavaScript', 'level' => 95],
                ['name' => 'TypeScript', 'level' => 90],
                ['name' => 'React', 'level' => 92],
                ['name' => 'Node.js', 'level' => 88],
                ['name' => 'Python', 'level' => 85],
                ['name' => 'PHP', 'level' => 80],
                ['name' => 'Laravel', 'level' => 87],
                ['name' => 'MySQL', 'level' => 83],
                ['name' => 'MongoDB', 'level' => 78],
                ['name' => 'AWS', 'level' => 82],
                ['name' => 'Docker', 'level' => 80],
                ['name' => 'Git', 'level' => 95],
                ['name' => 'Agile/Scrum', 'level' => 90],
                ['name' => 'Team Leadership', 'level' => 85],
                ['name' => 'Problem Solving', 'level' => 93],
            ],
            'work_experience' => [
                [
                    'title' => 'Senior Full Stack Developer',
                    'company' => 'TechCorp Solutions',
                    'dates' => '2021 - Present',
                    'description' => [
                        'Lead development of microservices architecture serving 500K+ users',
                        'Mentor junior developers and conduct technical interviews',
                        'Implement CI/CD pipelines reducing deployment time by 60%',
                        'Collaborate with product teams to define technical requirements',
                        'Architect scalable solutions using cloud-native technologies'
                    ]
                ],
                [
                    'title' => 'Full Stack Developer',
                    'company' => 'InnovateLabs Inc.',
                    'dates' => '2019 - 2021',
                    'description' => [
                        'Developed RESTful APIs and responsive web applications',
                        'Optimized database queries improving performance by 40%',
                        'Integrated third-party services and payment gateways',
                        'Participated in agile development processes and sprint planning',
                        'Contributed to open-source projects and technical blogs'
                    ]
                ],
                [
                    'title' => 'Software Developer',
                    'company' => 'StartupXYZ',
                    'dates' => '2017 - 2019',
                    'description' => [
                        'Built MVPs for multiple startup products using modern frameworks',
                        'Implemented real-time features using WebSockets',
                        'Conducted code reviews and maintained coding standards',
                        'Worked closely with designers to implement pixel-perfect UIs',
                        'Managed deployment and monitoring of production applications'
                    ]
                ],
                [
                    'title' => 'Junior Developer',
                    'company' => 'WebDev Agency',
                    'dates' => '2016 - 2017',
                    'description' => [
                        'Developed custom websites and web applications for clients',
                        'Learned industry best practices and modern development workflows',
                        'Assisted in project estimation and client communication',
                        'Participated in team meetings and knowledge sharing sessions',
                        'Maintained and updated existing client websites'
                    ]
                ]
            ],
            'education' => [
                [
                    'degree' => 'Master of Science in Software Engineering',
                    'institution' => 'Stanford University',
                    'dates' => '2017 - 2019',
                    'gpa' => '3.9/4.0'
                ],
                [
                    'degree' => 'Bachelor of Science in Computer Science',
                    'institution' => 'University of California, Berkeley',
                    'dates' => '2013 - 2017',
                    'gpa' => '3.7/4.0'
                ],
                [
                    'degree' => 'Associate Degree in Information Technology',
                    'institution' => 'City College of San Francisco',
                    'dates' => '2011 - 2013',
                    'gpa' => '3.8/4.0'
                ]
            ],
            'certifications' => [
                [
                    'name' => 'AWS Certified Solutions Architect - Associate',
                    'issuer' => 'Amazon Web Services',
                    'date' => '2023'
                ],
                [
                    'name' => 'Certified Scrum Master (CSM)',
                    'issuer' => 'Scrum Alliance',
                    'date' => '2022'
                ],
                [
                    'name' => 'Google Cloud Professional Developer',
                    'issuer' => 'Google Cloud',
                    'date' => '2021'
                ],
                [
                    'name' => 'Oracle Certified Java Programmer',
                    'issuer' => 'Oracle Corporation',
                    'date' => '2020'
                ],
                [
                    'name' => 'Microsoft Certified: Azure Developer Associate',
                    'issuer' => 'Microsoft',
                    'date' => '2020'
                ]
            ],
            'awards' => [
                [
                    'name' => 'Developer of the Year',
                    'organization' => 'TechCorp Solutions',
                    'reason' => 'Outstanding contributions to company products and team leadership'
                ],
                [
                    'name' => 'Innovation Excellence Award',
                    'organization' => 'InnovateLabs Inc.',
                    'reason' => 'Developed groundbreaking features that increased user engagement by 200%'
                ],
                [
                    'name' => 'Rising Star Award',
                    'organization' => 'StartupXYZ',
                    'reason' => 'Exceptional performance and rapid learning in fast-paced startup environment'
                ],
                [
                    'name' => 'Academic Achievement Award',
                    'organization' => 'Stanford University',
                    'reason' => 'Graduated with highest honors in Software Engineering program'
                ],
                [
                    'name' => 'Hackathon Winner',
                    'organization' => 'Silicon Valley Tech Conference',
                    'reason' => 'First place in 48-hour coding competition for innovative mobile app'
                ]
            ],
            'affiliations' => [
                [
                    'organization' => 'Association for Computing Machinery (ACM)',
                    'role' => 'Professional Member',
                    'duration' => '2018 - Present'
                ],
                [
                    'organization' => 'IEEE Computer Society',
                    'role' => 'Senior Member',
                    'duration' => '2019 - Present'
                ],
                [
                    'organization' => 'Women Who Code',
                    'role' => 'Mentor',
                    'duration' => '2020 - Present'
                ],
                [
                    'organization' => 'San Francisco Tech Meetup',
                    'role' => 'Organizer',
                    'duration' => '2021 - Present'
                ],
                [
                    'organization' => 'Open Source Initiative',
                    'role' => 'Contributor',
                    'duration' => '2017 - Present'
                ]
            ],
            'publications' => [
                [
                    'title' => 'Microservices Architecture Patterns in Modern Web Development',
                    'journal' => 'Journal of Software Engineering and Applications',
                    'authors' => ['John Doe', 'Jane Smith', 'Mike Johnson'],
                    'date' => '2023'
                ],
                [
                    'title' => 'Optimizing React Applications for Performance',
                    'journal' => 'Front-End Developer Magazine',
                    'authors' => ['John Doe'],
                    'date' => '2022'
                ],
                [
                    'title' => 'Machine Learning Integration in Full-Stack Applications',
                    'journal' => 'AI and Software Development Review',
                    'authors' => ['John Doe', 'Sarah Wilson'],
                    'date' => '2021'
                ],
                [
                    'title' => 'Agile Development in Distributed Teams',
                    'journal' => 'Project Management Journal',
                    'authors' => ['John Doe', 'David Chen'],
                    'date' => '2020'
                ],
                [
                    'title' => 'Container Orchestration with Kubernetes',
                    'journal' => 'DevOps Today',
                    'authors' => ['John Doe'],
                    'date' => '2019'
                ]
            ],
            'volunteer_work' => [
                [
                    'organization' => 'Code for America',
                    'role' => 'Technical Lead',
                    'duration' => '2022 - Present',
                    'contributions' => [
                        'Lead development of civic technology solutions',
                        'Mentor volunteers in web development and data analysis',
                        'Organize coding workshops for government employees',
                        'Contribute to open-source civic tech projects'
                    ]
                ],
                [
                    'organization' => 'Girls Who Code',
                    'role' => 'Workshop Instructor',
                    'duration' => '2020 - 2022',
                    'contributions' => [
                        'Teach programming fundamentals to high school girls',
                        'Develop curriculum for introductory coding courses',
                        'Organize virtual coding camps during pandemic',
                        'Mentor participants in career development'
                    ]
                ],
                [
                    'organization' => 'Local Animal Shelter',
                    'role' => 'Web Developer',
                    'duration' => '2018 - 2020',
                    'contributions' => [
                        'Built donation and adoption management system',
                        'Created responsive website for shelter outreach',
                        'Implemented volunteer scheduling application',
                        'Maintained database of animal records'
                    ]
                ],
                [
                    'organization' => 'Tech Conference Organizer',
                    'role' => 'Volunteer Coordinator',
                    'duration' => '2019 - 2021',
                    'contributions' => [
                        'Coordinated volunteer teams for annual tech conference',
                        'Managed registration and check-in systems',
                        'Organized speaker and sponsor logistics',
                        'Facilitated networking events and workshops'
                    ]
                ]
            ],
            'references' => [
                [
                    'name' => 'Sarah Johnson',
                    'title' => 'VP of Engineering',
                    'contact' => 'sarah.johnson@techcorp.com | (555) 111-2222',
                    'relationship' => 'Former Manager'
                ],
                [
                    'name' => 'Michael Chen',
                    'title' => 'Senior Software Architect',
                    'contact' => 'michael.chen@innovatelabs.com | (555) 222-3333',
                    'relationship' => 'Colleague and Mentor'
                ],
                [
                    'name' => 'Dr. Emily Rodriguez',
                    'title' => 'Professor of Computer Science',
                    'contact' => 'emily.rodriguez@stanford.edu | (555) 333-4444',
                    'relationship' => 'Academic Advisor'
                ],
                [
                    'name' => 'David Park',
                    'title' => 'Product Manager',
                    'contact' => 'david.park@startupxyz.com | (555) 444-5555',
                    'relationship' => 'Former Collaborator'
                ]
            ],
            'languages' => [
                ['name' => 'English', 'proficiency' => 'Native'],
                ['name' => 'Spanish', 'proficiency' => 'Fluent'],
                ['name' => 'Mandarin Chinese', 'proficiency' => 'Intermediate'],
                ['name' => 'French', 'proficiency' => 'Basic']
            ],
            'projects' => [
                [
                    'title' => 'E-Commerce Analytics Platform',
                    'description' => 'Comprehensive analytics dashboard for e-commerce businesses with real-time data visualization and predictive insights',
                    'technologies' => ['React', 'Node.js', 'D3.js', 'MongoDB', 'Redis'],
                    'outcomes' => 'Increased client revenue by 35% through data-driven decisions, serving 100K+ daily active users'
                ],
                [
                    'title' => 'Healthcare Telemedicine App',
                    'description' => 'Secure video consultation platform connecting patients with healthcare providers',
                    'technologies' => ['React Native', 'WebRTC', 'Firebase', 'Node.js', 'PostgreSQL'],
                    'outcomes' => 'Facilitated 50K+ consultations, improved patient access to care by 300%'
                ],
                [
                    'title' => 'Smart City IoT Dashboard',
                    'description' => 'Real-time monitoring system for urban infrastructure and environmental sensors',
                    'technologies' => ['Vue.js', 'Python', 'InfluxDB', 'MQTT', 'Docker'],
                    'outcomes' => 'Monitored 10K+ sensors across city, reduced response time to infrastructure issues by 60%'
                ],
                [
                    'title' => 'Educational Gamification Platform',
                    'description' => 'Interactive learning platform with gamified courses and progress tracking',
                    'technologies' => ['Angular', 'Laravel', 'MySQL', 'WebSockets', 'AWS'],
                    'outcomes' => 'Engaged 25K+ students, improved course completion rates by 45%'
                ],
                [
                    'title' => 'Financial Portfolio Tracker',
                    'description' => 'Personal finance application for tracking investments and financial goals',
                    'technologies' => ['React', 'Express.js', 'MongoDB', 'Chart.js', 'JWT'],
                    'outcomes' => 'Helped users manage $50M+ in assets, 4.8-star app store rating'
                ]
            ],
            'linkedin_url' => 'https://linkedin.com/in/johndoe',
            'github_url' => 'https://github.com/johndoe',
            'portfolio_url' => 'https://johndoe.dev',
            'facebook_url' => 'https://facebook.com/johndoe.dev',
            'profile_picture' => 'https://randomuser.me/api/portraits/men/1.jpg',
        ]);
    }
}