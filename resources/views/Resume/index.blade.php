<!DOCTYPE html>
@php
    use Illuminate\Support\Facades\Auth;
    $applicant = Auth::user();
@endphp

<head>
    <title>{{ $applicant->name }}</title>
    <link rel="shortcut icon" href="иконка.ico">
    <style>
        a {
            color: #2287C9;
            text-decoration: underline;
        }

        a:active {
            color: #2287C9;
            text-decoration: underline;
        }

        a:visited {
            color: #2287C9;
            text-decoration: underline;
        }

        a:hover {
            color: #339900;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .resume-header .media {
                align-items: center;
                text-align: center;
            }

            .resume-header .media > a,
            .resume-header .media > img,
            .resume-header .media .picture {
                display: block;
                margin: 0 auto 1rem;
            }

            .resume-header .media > a {
                display: inline-flex;
                justify-content: center;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js"
        integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous">
    </script>
    <link id="theme-style" rel="stylesheet" href="/resume/style.css">
    <base target="_blank">
</head>

<body>
    <article class="resume-wrapper text-center position-relative">
        <div class="resume-wrapper-inner mx-auto text-left bg-white shadow-lg">
            <header class="resume-header pt-4 pt-md-0">
                <div class="media flex-column flex-md-row">
                    <a href="https://weapssorsu-bc.site/storage/{{ $applicant->curriculumVitae->profile_picture }}">
                        <img src="https://weapssorsu-bc.site/storage/{{ $applicant->curriculumVitae->profile_picture }}"
                            alt="image" border="0"width="220" height="220"></a>
                    <img class="mr-3 img-fluid picture mx-auto" src="assets/images/фотощька.jpg" alt="">
                    <div class="media-body p-4 d-flex flex-column flex-md-row mx-auto mx-lg-0">
                        <div class="primary-info">
                            <h1 class="name mt-0 mb-1 text-white text-uppercase text-uppercase">{{ $applicant->name }}
                            </h1>
                            <div class="title mb-3">{{ $applicant->curriculumVitae->job_title }}</div>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="mailto:{{ $applicant->email }}"><i
                                            class="far fa-envelope fa-fw mr-2"
                                            data-fa-transform="grow-3"></i>{{ $applicant->email }}</a></li>
                                <li><a><i class="fas fa-mobile-alt fa-fw mr-2"
                                            data-fa-transform="grow-6"></i>{{ $applicant->curriculumVitae->phone }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="secondary-info ml-md-auto mt-2">
                            <ul class="resume-social list-unstyled">

                                @if ($applicant->curriculumVitae->facebook_url)
                                    <li class="mb-3"><a href="{{ $applicant->curriculumVitae->facebook_url }}"><span
                                                class="fa-container text-center mr-2"><i
                                                    class="fab fa-facebook fa-fw"></i></span>{{ $applicant->name }}</a>
                                    </li>
                                @endif
                                @if ($applicant->curriculumVitae->github_url)
                                    <li class="mb-3"><a href="{{ $applicant->curriculumVitae->github_url }}"><span
                                                class="fa-container text-center mr-2"><i
                                                    class="fab fa-github fa-fw"></i></span>{{ $applicant->name }}</a>
                                    </li>
                                @endif
                                @if ($applicant->curriculumVitae->linkedin_url)
                                    <li class="mb-3"><a
                                            href="{{ $applicant->curriculumVitae->linkedin_url }}"><span
                                                class="fa-container text-center mr-2"><i
                                                    class="fab fa-linkedin fa-fw"></i></span>{{ $applicant->name }}</a>
                                    </li>
                                @endif
                                @if ($applicant->curriculumVitae->portfolio_url)
                                    <li><a href="{{ $applicant->curriculumVitae->portfolio_url }}"><span
                                                class="fa-container text-center mr-2"><i
                                                    class="fab fa-globe-asia"></i></span>{{ $applicant->name }}
                                        </a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <div class="resume-body p-5">
                <section class="resume-section summary-section mb-5">
                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">ABOUT</h2>
                    <div class="resume-section-content">
                        <p class="mb-0">{{ $applicant->curriculumVitae->summary }}</p>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-9">
                        @if ($applicant->curriculumVitae->education != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">EDUCATION
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->education as $education)
                                            <article class="resume-timeline-item position-relative pb-5">

                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $education['degree'] }}</h3>
                                                        {{-- <div class="resume-company-name ml-auto">
                                                    ГК «Основа»</div> --}}
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $education['year_graduated'] }}
                                                    </div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $education['school_name'] }}</p>
                                                    {{-- <ul>
                                                <li><a href="https://vk.com/@russianimp-top-5-faktov-ob-internete-v-metro-vo-vremena-rossiiskoi-impe?ref=group_block"
                                                        target="_blank">«Метро в Российской империи»</a></li>
                                                <li><a href="https://vk.com/russianimp?w=wall-44693766_143639"
                                                        target="_blank">Смешные
                                                        дореволюционные журналы</a></li>
                                                <li><a href="https://www.instagram.com/p/ByzmsdVopko/"
                                                        target="_blank">Политические
                                                        мемы</a></li>
                                            </ul> --}}
                                                </div>

                                            </article>

                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        @endif
                        @if ($applicant->curriculumVitae->work_experience != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">WORK
                                    EXPERIENCE
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->work_experience as $work_experience)
                                            <article class="resume-timeline-item position-relative pb-5">
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $work_experience['jobPosition'] }}</h3>
                                                        <div class="resume-company-name ml-auto">
                                                            {{ $work_experience['company_name'] }}</div>
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $work_experience['start_date'] }}
                                                        — {{ $work_experience['end_date'] }}</div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $work_experience['summary'] }}</p>
                                                </div>
                                            </article>

                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>

                        @endif
                        @if ($applicant->curriculumVitae->volunteer_work != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">VOLUNTEER
                                    WORK
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->volunteer_work as $volunteer_work)
                                            <article class="resume-timeline-item position-relative pb-5">
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $volunteer_work['organization'] }}</h3>
                                                        <div class="resume-company-name ml-auto">
                                                            {{ $volunteer_work['role'] }}</div>
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $volunteer_work['start_date'] }} —
                                                        {{ $volunteer_work['end_date'] }}</div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $volunteer_work['description'] }}</p>
                                                </div>
                                            </article>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        @endif
                        @if ($applicant->curriculumVitae->affiliations != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">AFFILIATIONS
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->affiliations as $affiliations)
                                            <article class="resume-timeline-item position-relative pb-5">
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $affiliations['organization'] }}</h3>
                                                        <div class="resume-company-name ml-auto">
                                                            {{ $affiliations['role'] }}</div>
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $affiliations['start_date'] }} —
                                                        {{ $affiliations['end_date'] }}</div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $affiliations['description'] }}</p>
                                                </div>
                                            </article>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        @endif
                        @if ($applicant->curriculumVitae->certifications != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">
                                    CERTIFICATIONS
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->certifications as $certifications)
                                            <article class="resume-timeline-item position-relative pb-5">
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $certifications['name'] }}</h3>
                                                        <div class="resume-company-name ml-auto">
                                                            {{ $certifications['issuer'] }}</div>
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $certifications['date_obtained'] }}</div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $certifications['credential_id'] }}</p>
                                                </div>
                                            </article>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        @endif
                        @if ($applicant->curriculumVitae->awards != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">AWARDS
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->awards as $awards)
                                            <article class="resume-timeline-item position-relative pb-5">
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $awards['name'] }}</h3>
                                                        <div class="resume-company-name ml-auto">
                                                            {{ $awards['organization'] }}</div>
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $awards['date_received'] }}</div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $awards['description'] }}</p>
                                                </div>
                                            </article>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        @endif
                        @if ($applicant->curriculumVitae->projects != null)
                            <section class="resume-section experience-section mb-5">
                                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">PROJECTS
                                </h2>
                                <div class="resume-section-content">
                                    <div class="resume-timeline position-relative">
                                        @forelse ($applicant->curriculumVitae->projects as $projects)
                                            <article class="resume-timeline-item position-relative pb-5">
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">
                                                            {{ $projects['name'] }}</h3>
                                                    </div>
                                                    <div class="resume-position-time">
                                                        {{ $projects['start_date'] }} - {{ $projects['end_date'] }}
                                                    </div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>{{ $projects['description'] }}</p>
                                                    <p>{{ $projects['outcomes'] }}</p>
                                                    <ul>
                                                        @forelse ($projects['technologies'] as $technologies)
                                                            <li>{{ $technologies }}</li>
                                                        @empty
                                                        @endforelse

                                                    </ul>
                                                </div>
                                            </article>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>

                    <div class="col-lg-3">
                        <section class="resume-section skills-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">SKILLS</h2>
                            <div class="resume-section-content">
                                <div class="resume-skill-item">
                                    {{-- <h4 class="resume-skills-cat font-weight-bold">В Адоуб</h4> --}}
                                    <ul class="list-unstyled mb-4"></ul>
                                    @forelse ($applicant->curriculumVitae->skills as $skils)
                                        <li class="mb-2">
                                            <div class="resume-skill-name">{{ $skils['name'] }}</div>
                                            <div class="progress resume-progress">
                                                <div class="progress-bar theme-progress-bar-dark" role="progressbar"
                                                    style="width: {{ $skils['level'] }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </li>

                                    @empty
                                    @endforelse
                                </div>
                        </section>
                        <section class="resume-section skills-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">LANGUAGES</h2>
                            <div class="resume-section-content">
                                <div class="resume-skill-item">
                                    {{-- <h4 class="resume-skills-cat font-weight-bold">В Адоуб</h4> --}}
                                    <ul class="list-unstyled mb-4"></ul>
                                    @forelse ($applicant->curriculumVitae->languages as $languages)
                                        <li class="mb-2">
                                            <div class="resume-degree  font-weight-bold">{{ $languages['name'] }}
                                            </div>
                                            <div class="font-weight-normal resume-skill-name">
                                                {{ $languages['proficiency'] }}
                                        </li>

                                    @empty
                                    @endforelse
                                </div>
                        </section>
                        <section class="resume-section education-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">REFERENCES</h2>
                            <div class="resume-section-content">
                                <ul class="list-unstyled">
                                    @forelse ($applicant->curriculumVitae->references as $references)
                                        <li class="mb-2">
                                            <div class="resume-degree font-weight-bold">{{ $references['name'] }}
                                            </div>
                                            <div class="resume-degree-org">Position: {{ $references['title'] }}</div>
                                            <div class="resume-degree-org">Company: {{ $references['company'] }}</div>
                                            <div class="resume-degree-org">{{ $references['email'] }}</div>
                                            <div class="resume-degree-org">{{ $references['phone'] }}</div>
                                            <div class="resume-degree-org">{{ $references['relationship'] }}</div>
                                        </li>

                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </section>
                        {{-- <section class="resume-section reference-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Хвалюсь</h2>
                            <div class="resume-section-content">
                                <ul class="list-unstyled resume-awards-list">
                                    <li class="mb-2 pl-4 position-relative">
                                        <i class="resume-award-icon fas fa-trophy position-absolute"
                                            data-fa-transform="shrink-2"></i>
                                        <div class="resume-award-name">Знаниями нейроэкономики</div>
                                        <div class="resume-award-desc"><a
                                                href="https://www.coursera.org/account/accomplishments/verify/DPCCM39K7M8F"
                                                target="_blank">Подтверждёнными сертификатом</a></div>
                                    </li>
                                    <li class="mb-0 pl-4 position-relative">
                                        <i class="resume-award-icon fas fa-trophy position-absolute"
                                            data-fa-transform="shrink-2"></i>
                                        <div class="resume-award-name">Школой редакторов Бюро Горбунова</div>
                                        <div class="resume-award-desc"><a
                                                href="https://bureau.ru/burosfera/stas-zveryanov" target="_blank">И
                                                кабинетом в Бюросфере</a></div>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <section class="resume-section language-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Разговариваю на
                            </h2>
                            <div class="resume-section-content">
                                <ul class="list-unstyled resume-lang-list">
                                    <li class="mb-2"><span class="resume-lang-name font-weight-bold">Русском</span>
                                        <small class="text-muted font-weight-normal">(Он ведь родной)</small>
                                    </li>
                                    <li class="mb-2 align-middle"><span
                                            class="resume-lang-name font-weight-bold">Английском</span>
                                        <small class="text-muted font-weight-normal">(С1)</small>
                                    </li>
                                    <li><span class="resume-lang-name font-weight-bold">Немецком</span> <small
                                            class="text-muted font-weight-normal">(В1)</small></li>
                                </ul>
                            </div>
                        </section>
                        <section class="resume-section interests-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Интересуюсь</h2>
                            <div class="resume-section-content">
                                <ul class="list-unstyled">
                                    <li class="mb-1">Видеоиграми</li>
                                    <li class="mb-1">Редактурой</li>
                                    <li class="mb-1">Дизайном</li>
                                </ul>
                            </div>
                        </section> --}}

                    </div>
                </div>
            </div>
        </div>
    </article>
</body>

</html>
