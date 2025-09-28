<?php

namespace Database\Factories;

use App\Models\CurriculumVitae;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumVitaeFactory extends Factory
{
    protected $model = CurriculumVitae::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'job_title' => $this->faker->jobTitle,
            'summary' => $this->faker->paragraph,
            'highest_degree' => $this->faker->randomElement([
                'BS in Computer Science',
                'BS in Information Technology',
                'BS in Information System',
                'BS in Accountancy',
                'BS in Accounting Information System',
                'BS in Entrepreneurship (BS Entrep)',
                'Bachelor of Public Administration'
            ]),
            'university' => 'Sorsogon State University',
            'graduation_year' => $this->faker->numberBetween(2000, 2025),
            'years_of_experience' => $this->faker->numberBetween(0, 25),
            'skills' => [
                ['name' => 'JavaScript', 'level' => 90],
                ['name' => 'PHP', 'level' => 85],
                ['name' => 'Python', 'level' => 80],
                ['name' => 'React', 'level' => 88],
                ['name' => 'Node.js', 'level' => 82],
                ['name' => 'SQL', 'level' => 75],
                ['name' => 'Git', 'level' => 95],
                ['name' => 'Agile Methodology', 'level' => 85],
                ['name' => 'Problem Solving', 'level' => 90],
                ['name' => 'Team Leadership', 'level' => 80],
            ],
            'work_experience' => [
                [
                    'title' => 'Senior Software Developer',
                    'company' => 'Tech Innovations Inc.',
                    'dates' => '2020 - Present',
                    'description' => [
                        'Led development of scalable web applications serving 100K+ users',
                        'Implemented CI/CD pipelines reducing deployment time by 40%',
                        'Mentored junior developers and conducted code reviews',
                        'Collaborated with cross-functional teams to deliver projects on time'
                    ]
                ],
                [
                    'title' => 'Software Developer',
                    'company' => 'Digital Solutions Ltd.',
                    'dates' => '2018 - 2020',
                    'description' => [
                        'Developed RESTful APIs and responsive front-end interfaces',
                        'Optimized database queries improving performance by 30%',
                        'Participated in agile development processes',
                        'Contributed to open-source projects'
                    ]
                ],
                [
                    'title' => 'Junior Developer',
                    'company' => 'Startup Hub',
                    'dates' => '2016 - 2018',
                    'description' => [
                        'Built interactive web applications using modern frameworks',
                        'Implemented user authentication and authorization systems',
                        'Conducted unit and integration testing',
                        'Assisted in system architecture design'
                    ]
                ],
                [
                    'title' => 'Intern Developer',
                    'company' => 'Code Masters',
                    'dates' => '2015 - 2016',
                    'description' => [
                        'Learned software development best practices',
                        'Contributed to small-scale projects',
                        'Participated in team meetings and brainstorming sessions',
                        'Gained experience with version control systems'
                    ]
                ]
            ],
            'education' => [
                [
                    'degree' => 'Bachelor of Science in Computer Science',
                    'institution' => 'Sorsogon State University',
                    'dates' => '2012 - 2016',
                    'gpa' => '3.8/4.0'
                ],
                [
                    'degree' => 'Master of Science in Software Engineering',
                    'institution' => 'University of the Philippines',
                    'dates' => '2017 - 2019',
                    'gpa' => '3.9/4.0'
                ],
                [
                    'degree' => 'High School Diploma',
                    'institution' => 'Sorsogon National High School',
                    'dates' => '2008 - 2012',
                    'gpa' => '4.0/4.0'
                ]
            ],
            'certifications' => [
                [
                    'name' => 'AWS Certified Solutions Architect',
                    'issuer' => 'Amazon Web Services',
                    'date' => '2023'
                ],
                [
                    'name' => 'Certified Scrum Master',
                    'issuer' => 'Scrum Alliance',
                    'date' => '2022'
                ],
                [
                    'name' => 'Google Cloud Professional Developer',
                    'issuer' => 'Google Cloud',
                    'date' => '2021'
                ],
                [
                    'name' => 'Oracle Java Programmer',
                    'issuer' => 'Oracle Corporation',
                    'date' => '2020'
                ]
            ],
            'awards' => [
                [
                    'name' => 'Employee of the Year',
                    'organization' => 'Tech Innovations Inc.',
                    'reason' => 'Outstanding performance and leadership in software development'
                ],
                [
                    'name' => 'Innovation Award',
                    'organization' => 'Digital Solutions Ltd.',
                    'reason' => 'Developed groundbreaking mobile application'
                ],
                [
                    'name' => 'Best Project Award',
                    'organization' => 'Startup Hub',
                    'reason' => 'Led team to deliver award-winning web platform'
                ],
                [
                    'name' => 'Academic Excellence Award',
                    'organization' => 'Sorsogon State University',
                    'reason' => 'Maintained highest GPA in Computer Science program'
                ]
            ],
            'affiliations' => [
                [
                    'organization' => 'Philippine Computer Society',
                    'role' => 'Member',
                    'duration' => '2018 - Present'
                ],
                [
                    'organization' => 'Association for Computing Machinery',
                    'role' => 'Student Member',
                    'duration' => '2014 - 2016'
                ],
                [
                    'organization' => 'IEEE Computer Society',
                    'role' => 'Professional Member',
                    'duration' => '2019 - Present'
                ],
                [
                    'organization' => 'Sorsogon IT Professionals Network',
                    'role' => 'Board Member',
                    'duration' => '2020 - Present'
                ]
            ],
            'publications' => [
                [
                    'title' => 'Scalable Microservices Architecture in PHP',
                    'journal' => 'Journal of Software Engineering',
                    'authors' => ['John Doe', 'Jane Smith'],
                    'date' => '2022'
                ],
                [
                    'title' => 'Machine Learning Applications in Web Development',
                    'journal' => 'International Journal of Computer Science',
                    'authors' => ['John Doe'],
                    'date' => '2021'
                ],
                [
                    'title' => 'Optimizing Database Performance in Laravel',
                    'journal' => 'PHP Developer Magazine',
                    'authors' => ['John Doe', 'Mike Johnson'],
                    'date' => '2020'
                ],
                [
                    'title' => 'Agile Methodologies in Startup Environments',
                    'journal' => 'Business Technology Review',
                    'authors' => ['John Doe'],
                    'date' => '2019'
                ]
            ],
            'volunteer_work' => [
                [
                    'organization' => 'Code for Philippines',
                    'role' => 'Technical Lead',
                    'duration' => '2021 - Present',
                    'contributions' => [
                        'Developed open-source tools for government digitization',
                        'Mentored young developers in rural areas',
                        'Organized coding workshops for underprivileged communities'
                    ]
                ],
                [
                    'organization' => 'Local Animal Shelter',
                    'role' => 'Web Developer Volunteer',
                    'duration' => '2019 - 2021',
                    'contributions' => [
                        'Built donation management system',
                        'Created pet adoption website',
                        'Maintained shelter\'s online presence'
                    ]
                ],
                [
                    'organization' => 'Youth Coding Initiative',
                    'role' => 'Instructor',
                    'duration' => '2017 - 2019',
                    'contributions' => [
                        'Taught programming to high school students',
                        'Developed curriculum for beginner coding courses',
                        'Organized hackathons and coding competitions'
                    ]
                ],
                [
                    'organization' => 'Environmental Conservation Group',
                    'role' => 'Data Analyst',
                    'duration' => '2016 - 2018',
                    'contributions' => [
                        'Analyzed environmental data for research projects',
                        'Created data visualization dashboards',
                        'Supported conservation awareness campaigns'
                    ]
                ]
            ],
            'references' => [
                [
                    'name' => 'Sarah Johnson',
                    'title' => 'CTO',
                    'contact' => 'sarah.johnson@techinnovations.com | (555) 123-4567',
                    'relationship' => 'Former Supervisor'
                ],
                [
                    'name' => 'Michael Chen',
                    'title' => 'Senior Developer',
                    'contact' => 'michael.chen@digitalsolutions.com | (555) 234-5678',
                    'relationship' => 'Colleague'
                ],
                [
                    'name' => 'Dr. Emily Rodriguez',
                    'title' => 'Professor',
                    'contact' => 'emily.rodriguez@sorsogonstate.edu | (555) 345-6789',
                    'relationship' => 'Academic Advisor'
                ],
                [
                    'name' => 'David Park',
                    'title' => 'Project Manager',
                    'contact' => 'david.park@startuphub.com | (555) 456-7890',
                    'relationship' => 'Former Manager'
                ]
            ],
            'languages' => [
                ['name' => 'English', 'proficiency' => 'Native'],
                ['name' => 'Filipino', 'proficiency' => 'Native'],
                ['name' => 'Spanish', 'proficiency' => 'Intermediate'],
                ['name' => 'Japanese', 'proficiency' => 'Basic']
            ],
            'projects' => [
                [
                    'title' => 'E-Commerce Platform',
                    'description' => 'Full-stack e-commerce solution with payment integration and inventory management',
                    'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Stripe API'],
                    'outcomes' => 'Increased sales by 150% for client, handled 10K+ transactions monthly'
                ],
                [
                    'title' => 'Healthcare Management System',
                    'description' => 'Web application for managing patient records and appointments',
                    'technologies' => ['Django', 'React', 'PostgreSQL', 'Docker'],
                    'outcomes' => 'Streamlined operations for 5 clinics, reduced administrative time by 60%'
                ],
                [
                    'title' => 'Real-time Chat Application',
                    'description' => 'Scalable chat platform with video calling and file sharing',
                    'technologies' => ['Node.js', 'Socket.io', 'MongoDB', 'WebRTC'],
                    'outcomes' => 'Supported 50K+ concurrent users, 99.9% uptime'
                ],
                [
                    'title' => 'Data Analytics Dashboard',
                    'description' => 'Interactive dashboard for business intelligence and reporting',
                    'technologies' => ['Python', 'D3.js', 'Flask', 'Redis'],
                    'outcomes' => 'Provided actionable insights, improved decision-making processes'
                ]
            ],
            'linkedin_url' => $this->faker->url,
            'github_url' => $this->faker->url,
            'portfolio_url' => $this->faker->url,
            'facebook_url' => $this->faker->url,
            'profile_picture' => 'https://randomuser.me/api/portraits/' . $this->faker->randomElement(['men', 'women']) . '/' . $this->faker->numberBetween(1, 99) . '.jpg',
        ];
    }
}