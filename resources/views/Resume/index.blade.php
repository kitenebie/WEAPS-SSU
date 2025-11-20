<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="/css/resume/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
@php
    $data = App\Models\User::find($alumni_id);
@endphp

<body>
    <div class="resume">
        <div class="base">
            <div class="profile">
                <div class="photo">
                    <img
                        src="{{ $data->curriculumVitae->profile_picture != null ? 'https://weapssorsu-bc.site/storage/' . $data->curriculumVitae->profile_picture : 'https://cdn.bulan.sorsu.edu.ph/images/ssu-logo.webp' }}" />
                </div>
                <div class="info">
                    <h1 class="name">{{ $data->name ?? '' }}</h1>
                    <h3 class="job">{{ $data->curriculumVitae->job_title ?? 'Open for all position' }}</h3>
                </div>
            </div>
            <div class="about">
                <h3>About Me</h3>
                {{ $data->curriculumVitae->summary ?? '' }}
            </div>
            <div class="contact">
                <h3>Contact Me</h3>
                <div class="call">
                    <a href="tel:{{ $data->curriculumVitae->phone ?? '' }}"><i
                            class="fas fa-phone"></i><span>{{ $data->curriculumVitae->phone ?? '' }}</span></a>
                </div>
                <div class="address">
                    <a href="#"><i
                            class="fas fa-map-marker"></i><span>{{ $data->curriculumVitae->address ?? '' }}</span></a>
                </div>
                <div class="email">
                    <a href="mailto:{{ $data->curriculumVitae->email ?? '' }}"><i
                            class="fas fa-envelope"></i><span>{{ $data->curriculumVitae->email ?? '' }}</span></a>
                </div>
                @if ($data->curriculumVitae->portfolio_url)
                    <div class="website">
                        <a href="{{ $data->curriculumVitae->portfolio_url }}" target="_blank">
                            <i
                                class="fas fa-home"></i><span>{{ $data->curriculumVitae->portfolio_url ?? '' }}</span></a>
                    </div>
                @endif
            </div>
            <div class="follow">
                <h3>Follow Me</h3>
                <div class="box">
                    <a href="{{ $data->curriculumVitae->facebook_url ?? "#" }}" target="_blank"><i
                            class="fab fa-facebook"></i></a>
                    <a href="{{ $data->curriculumVitae->github_url ?? "#" }}" target="_blank"><i
                            class="fab fa-github"></i></a>
                    <a href="{{ $data->curriculumVitae->linkedin_url ?? "#" }}" target="_blank"><i
                            class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="func">
            <div class="work">
                <h3><i class="fa fa-briefcase"></i>Experience</h3>
                {{ $data->curriculumVitae->work_experience }}
                <ul>
                    <li>
                        <span>Technical Consultant -<br />Web Design</span><small>Fiserv</small><small>Apr 2018 -
                            Now</small>
                    </li>
                    <li>
                        <span>Web Designer</span><small>Lynden</small><small>Jan 2018 - Apr 2018</small>
                    </li>
                    <li>
                        <span>Intern - Web Design</span><small>Lynden</small><small>Aug 2017 - Dec 2017</small>
                    </li>
                </ul>
            </div>
            <div class="edu">
                <h3><i class="fa fa-graduation-cap"></i>Education</h3>
                <ul>
                    <li>
                        <span>Bachelor of Science<br />Web Design and
                            Development</span><small>BYU-Idaho</small><small>Jan. 2016 - Apr. 2018</small>
                    </li>
                    <li>
                        <span>Computer Science</span><small>Edmonds Community College</small><small>Sept. 2014 - Dec.
                            2015</small>
                    </li>
                    <li>
                        <span>High School</span><small>Henry M. Jackson High School</small><small>Jan. 2013 - Jun.
                            2015</small>
                    </li>
                </ul>
            </div>
            <div class="skills-prog">
                <h3><i class="fas fa-code"></i>Programming Skills</h3>
                <ul>
                    <li data-percent="95">
                        <span>HTML5</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                    <li data-percent="90">
                        <span>CSS3 & SCSS</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                    <li data-percent="60">
                        <span>JavaScript</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                    <li data-percent="50">
                        <span>jQuery</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                    <li data-percent="40">
                        <span>JSON</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                    <li data-percent="55">
                        <span>PHP</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                    <li data-percent="40">
                        <span>MySQL</span>
                        <div class="skills-bar">
                            <div class="bar"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="skills-soft">
                <h3><i class="fas fa-bezier-curve"></i>Software Skills</h3>
                <ul>
                    <li data-percent="90">
                        <svg viewbox="0 0 100 100">
                            <circle cx="50" cy="50" r="45"></circle>
                            <circle class="cbar" cx="50" cy="50" r="45"></circle>
                        </svg><span>Illustrator</span><small></small>
                    </li>
                    <li data-percent="75">
                        <svg viewbox="0 0 100 100">
                            <circle cx="50" cy="50" r="45"></circle>
                            <circle class="cbar" cx="50" cy="50" r="45"></circle>
                        </svg><span>Photoshop</span><small></small>
                    </li>
                    <li data-percent="85">
                        <svg viewbox="0 0 100 100">
                            <circle cx="50" cy="50" r="45"></circle>
                            <circle class="cbar" cx="50" cy="50" r="45"></circle>
                        </svg><span>InDesign</span><small></small>
                    </li>
                    <li data-percent="65">
                        <svg viewbox="0 0 100 100">
                            <circle cx="50" cy="50" r="45"></circle>
                            <circle class="cbar" cx="50" cy="50" r="45"></circle>
                        </svg><span>Dreamweaver</span><small></small>
                    </li>
                </ul>
            </div>
            <div class="interests">
                <h3><i class="fas fa-star"></i>Interests</h3>
                <div class="interests-items">
                    <div class="art">
                        <i class="fas fa-palette"></i><span>Art</span>
                    </div>
                    <div class="art">
                        <i class="fas fa-book"></i><span>Books</span>
                    </div>
                    <div class="movies">
                        <i class="fas fa-film"></i><span>Movies</span>
                    </div>
                    <div class="music">
                        <i class="fas fa-headphones"></i><span>Music</span>
                    </div>
                    <div class="games">
                        <i class="fas fa-gamepad"></i><span>Games</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/resume/script.js"></script>
</body>

</html>
