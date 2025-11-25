<x-filament-panels::page>
    <style>
        :root {
            --eh-primary: #7F1D1D;
            --eh-secondary: #991B1B;
            --eh-tertiary: #B91C1C;
            --eh-muted: #FEE2E2;
            --eh-surface: #FFFFFF;
        }

        .fi-header {
            display: none !important;
        }

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(127, 29, 29, 0.2);
        }

        .illustration-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .fi-main .fi-width-full {
            padding-bottom: 0;
        }

        ::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari */
        }

        .eh-scroll-container {
            width: 100%;
            height: 86vh;
            overflow-y: auto;
            padding: 0 1.5rem 1.5rem;
            box-sizing: border-box;
        }

        .eh-page-header {
            margin-bottom: 2rem;
        }

        #page-title {
            font-size: clamp(2.25rem, 1.5vw + 1.5rem, 3rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--eh-primary);
        }

        #welcome-message {
            font-size: clamp(1.125rem, 0.75vw + 1rem, 1.5rem);
            color: var(--eh-secondary);
        }

        .eh-section {
            margin-bottom: 2rem;
        }

        .eh-card {
            border-radius: 1.5rem;
            padding: 2rem;
            background: var(--eh-surface);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .eh-card--gradient {
            background: linear-gradient(135deg, var(--eh-primary) 0%, var(--eh-secondary) 100%);
            color: #FFFFFF;
        }

        .eh-card--gradient p,
        .eh-card--gradient h2,
        .eh-card--gradient span {
            color: inherit;
        }

        .eh-dual-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: center;
        }

        @media (min-width: 768px) {
            .eh-dual-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .eh-flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .eh-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .eh-stat-card {
            position: relative;
            border-radius: 1.5rem;
            padding: 1.5rem;
            background: var(--eh-surface);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .eh-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
            color: #FFFFFF;
            font-weight: 700;
        }

        .eh-text-center {
            text-align: center;
        }

        .eh-stat-description {
            margin-top: 0.5rem;
            color: var(--eh-secondary);
            font-size: 0.95rem;
        }

        .eh-badge-wrapper {
            margin-bottom: 1rem;
        }

        .eh-pill {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            background: #FFFFFF;
            color: var(--eh-primary);
        }

        .eh-feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem;
        }

        .eh-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .eh-feature-item + .eh-feature-item {
            margin-top: 0.75rem;
        }

        .eh-feature-icon {
            flex-shrink: 0;
            margin-top: 0.2rem;
        }

        .eh-primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--eh-primary);
            background: #FFFFFF;
            text-decoration: none;
            box-shadow: 0 20px 35px rgba(127, 29, 29, 0.2);
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .eh-primary-button:hover {
            background: var(--eh-muted);
            transform: scale(1.05);
        }

        .eh-hero-visual {
            position: relative;
        }

        .eh-badge-overlay {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            width: 120px;
            height: 120px;
        }

        #greeting-title,
        #resume-title,
        #ad-title {
            margin-bottom: 1rem;
            font-size: 2.3rem;
            font-weight: bolder
        }

        #greeting-message,
        #resume-subtitle,
        #ad-subtitle {
            margin-bottom: 1rem;
        }

        #resume-description,
        #ad-description {
            margin-bottom: 1.5rem;
        }

        #resume-badge,
        #ad-badge {
            font-weight: 600;
        }
    </style>
    <div class="eh-scroll-container">
        <header class="eh-page-header">
            <h1 id="page-title" style="color: #7F1D1D;"> Home</h1>
            <p id="welcome-message" style="color: #991B1B;"></p>
        </header><!-- Greeting Section -->
        <section class="eh-section">
            <div class="eh-card" style="background: #FFFFFF;">
                <div class="eh-dual-grid"><!-- Left side - Greeting text -->
                    <div>
                        <h2 id="greeting-title" style="color: #7F1D1D;">
                            Welcome Back {{ auth()->user()->first_name }}!</h2>
                        <p id="greeting-message" style="color: #991B1B;">Ready to take the next
                            step in your career journey? Let's make today count!</p>
                        <p id="greeting-subtitle" style="color: #B91C1C;">Your dream job is just one
                            application away. Keep pushing forward!</p>
                    </div><!-- Right side - Professional illustration -->
                    <div class="eh-flex-center">
                        <svg width="200" height="220" viewbox="0 0 200 220" fill="none"
                            xmlns="http://www.w3.org/2000/svg"><!-- Professional greeting person --> <!-- Head -->
                            <circle cx="100" cy="50" r="28" fill="#FEE2E2" />
                            <!-- Professional hairstyle -->
                            <ellipse cx="100" cy="35" rx="26" ry="22" fill="#7F1D1D" />
                            <path d="M74 45C74 45 78 40 85 42L83 50Z" fill="#7F1D1D" />
                            <path d="M126 45C126 45 122 40 115 42L117 50Z" fill="#7F1D1D" /> <!-- Friendly eyes -->
                            <ellipse cx="88" cy="50" rx="5" ry="6" fill="#7F1D1D" />
                            <ellipse cx="112" cy="50" rx="5" ry="6" fill="#7F1D1D" />
                            <circle cx="89" cy="49" r="2" fill="#FFFFFF" />
                            <circle cx="113" cy="49" r="2" fill="#FFFFFF" /> <!-- Friendly smile -->
                            <path d="M85 60C85 60 92 65 100 65C108 65 115 60 115 60" stroke="#7F1D1D" stroke-width="3"
                                stroke-linecap="round" /> <!-- Business suit -->
                            <path d="M72 78L100 78L128 78L128 145L72 145Z" fill="#7F1D1D" /> <!-- White shirt -->
                            <path d="M82 78L100 88L118 78" fill="#FFFFFF" />
                            <rect x="90" y="88" width="20" height="57" fill="#FFFFFF" /> <!-- Tie -->
                            <path d="M100 88L96 98L100 140L104 98Z" fill="#991B1B" />
                            <path d="M96 88L100 93L104 88Z" fill="#991B1B" /> <!-- Suit lapels -->
                            <path d="M72 78L82 78L82 125" stroke="#991B1B" stroke-width="3" />
                            <path d="M128 78L118 78L118 125" stroke="#991B1B" stroke-width="3" /> <!-- Buttons -->
                            <circle cx="100" cy="105" r="2.5" fill="#991B1B" />
                            <circle cx="100" cy="115" r="2.5" fill="#991B1B" />
                            <circle cx="100" cy="125" r="2.5" fill="#991B1B" /> <!-- Left arm waving -->
                            <path d="M50 75L65 88L72 78L68 115L58 110Z" fill="#991B1B" />
                            <ellipse cx="48" cy="72" rx="10" ry="8" fill="#FEE2E2" />
                            <!-- Waving hand gesture -->
                            <path d="M45 68L42 62M48 67L48 60M51 68L54 62" stroke="#7F1D1D" stroke-width="2.5"
                                stroke-linecap="round" /> <!-- Right arm at side -->
                            <path d="M150 95L135 88L128 78L128 120L138 125Z" fill="#991B1B" />
                            <ellipse cx="152" cy="98" rx="10" ry="8" fill="#FEE2E2" />
                            <!-- Professional trousers -->
                            <rect x="82" y="145" width="16" height="45" fill="#991B1B" />
                            <rect x="102" y="145" width="16" height="45" fill="#991B1B" /> <!-- Crease lines -->
                            <line x1="90" y1="145" x2="90" y2="190" stroke="#7F1D1D"
                                stroke-width="1.5" />
                            <line x1="110" y1="145" x2="110" y2="190" stroke="#7F1D1D"
                                stroke-width="1.5" /> <!-- Dress shoes -->
                            <ellipse cx="90" cy="195" rx="12" ry="7" fill="#7F1D1D" />
                            <ellipse cx="110" cy="195" rx="12" ry="7" fill="#7F1D1D" />
                            <ellipse cx="90" cy="195" rx="7" ry="4" fill="#991B1B" />
                            <ellipse cx="110" cy="195" rx="7" ry="4" fill="#991B1B" />
                            <!-- Decorative elements around -->
                            <circle cx="30" cy="40" r="4" fill="#FFD700" opacity="0.6" />
                            <circle cx="170" cy="40" r="4" fill="#FFD700" opacity="0.6" />
                            <circle cx="25" cy="80" r="3" fill="#B91C1C" opacity="0.5" />
                            <circle cx="175" cy="80" r="3" fill="#B91C1C" opacity="0.5" />
                            <!-- Success sparkles -->
                            <path d="M35 100L37 100M36 99L36 101" stroke="#FFD700" stroke-width="2"
                                stroke-linecap="round" />
                            <path d="M165 100L167 100M166 99L166 101" stroke="#FFD700" stroke-width="2"
                                stroke-linecap="round" />
                            <path d="M40 130L42 130M41 129L41 131" stroke="#4CAF50" stroke-width="2"
                                stroke-linecap="round" />
                            <path d="M160 130L162 130M161 129L161 131" stroke="#4CAF50" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        {{-- <main class="eh-stats-grid"><!-- Finding Careers Card -->
            <a href="/careers" class="stat-card eh-stat-card">
                <!-- Badge Banner -->
                <div class="eh-badge"
                    style="background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);"><span id="careers-count"
                        style="color: #FFFFFF;">{{ App\Models\Carrer::count() }}</span>
                </div>
                <div class="illustration-wrapper">
                    <svg width="100" height="120" viewbox="0 0 100 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg"><!-- Professional Head -->
                        <circle cx="50" cy="28" r="16" fill="#FEE2E2" />
                        <!-- Professional hairstyle - side part -->
                        <path
                            d="M36 22C36 14 42 10 50 10C58 10 64 14 64 22L64 28C64 28 62 24 58 24C54 24 52 26 50 26C48 26 46 24 42 24C38 24 36 28 36 28Z"
                            fill="#7F1D1D" />
                        <path d="M50 10C50 10 54 12 56 18" stroke="#991B1B" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Professional glasses -->
                        <rect x="39" y="26" width="10" height="8" rx="2" fill="none"
                            stroke="#7F1D1D" stroke-width="2" />
                        <rect x="51" y="26" width="10" height="8" rx="2" fill="none"
                            stroke="#7F1D1D" stroke-width="2" />
                        <line x1="49" y1="30" x2="51" y2="30" stroke="#7F1D1D"
                            stroke-width="2" /> <!-- Eyes behind glasses -->
                        <circle cx="44" cy="30" r="2" fill="#7F1D1D" />
                        <circle cx="56" cy="30" r="2" fill="#7F1D1D" /> <!-- Professional smile -->
                        <path d="M44 37C44 37 47 39 50 39C53 39 56 37 56 37" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Business suit jacket -->
                        <path d="M34 44L50 44L66 44L66 78L34 78Z" fill="#7F1D1D" /> <!-- White shirt and tie -->
                        <path d="M42 44L50 50L58 44" fill="#FFFFFF" />
                        <path d="M50 50L48 56L50 75L52 56Z" fill="#991B1B" /> <!-- Suit lapels -->
                        <path d="M34 44L42 44L42 60" stroke="#991B1B" stroke-width="2" />
                        <path d="M66 44L58 44L58 60" stroke="#991B1B" stroke-width="2" /> <!-- Buttons -->
                        <circle cx="50" cy="58" r="1.5" fill="#B91C1C" />
                        <circle cx="50" cy="64" r="1.5" fill="#B91C1C" />
                        <circle cx="50" cy="70" r="1.5" fill="#B91C1C" /> <!-- Professional arms -->
                        <path d="M28 50L34 44L34 68L30 72Z" fill="#991B1B" />
                        <path d="M72 50L66 44L66 68L70 72Z" fill="#991B1B" /> <!-- Hands -->
                        <ellipse cx="28" cy="74" rx="6" ry="5" fill="#FEE2E2" />
                        <ellipse cx="72" cy="74" rx="6" ry="5" fill="#FEE2E2" />
                        <!-- Briefcase -->
                        <rect x="68" y="68" width="22" height="16" rx="2" fill="#7F1D1D"
                            stroke="#991B1B" stroke-width="2" />
                        <rect x="77" y="65" width="4" height="6" rx="1" fill="#991B1B" />
                        <line x1="72" y1="76" x2="86" y2="76" stroke="#991B1B"
                            stroke-width="1" /> <!-- Professional trousers -->
                        <rect x="40" y="78" width="8" height="24" fill="#991B1B" />
                        <rect x="52" y="78" width="8" height="24" fill="#991B1B" /> <!-- Dress shoes -->
                        <ellipse cx="44" cy="104" rx="7" ry="4" fill="#7F1D1D" />
                        <ellipse cx="56" cy="104" rx="7" ry="4" fill="#7F1D1D" />
                        <!-- Professional search icon -->
                        <circle cx="18" cy="30" r="9" stroke="#7F1D1D" stroke-width="2.5"
                            fill="none" />
                        <line x1="25" y1="37" x2="32" y2="44" stroke="#7F1D1D"
                            stroke-width="2.5" stroke-linecap="round" /> <!-- Document icons -->
                        <rect x="10" y="50" width="12" height="16" rx="1" fill="#FEE2E2"
                            stroke="#7F1D1D" stroke-width="1.5" />
                        <line x1="12" y1="54" x2="20" y2="54" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="12" y1="58" x2="20" y2="58" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="12" y1="62" x2="18" y2="62" stroke="#7F1D1D"
                            stroke-width="1" />
                    </svg>
                </div>
                <div class="eh-text-center">
                    <div id="careers-label" style="color: #7F1D1D;">
                        Finding Careers
                    </div>
                    <p class="eh-stat-description" style="color: #991B1B;">Explore opportunities</p>
                </div>
            </a><!-- Career Bookmarks Card -->
            <a href="/Saved%20Jobs" class="stat-card eh-stat-card">
                <!-- Badge Banner -->
                <div class="eh-badge"
                    style="background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);"><span id="bookmarks-count"
                        style="color: #FFFFFF;">{{ App\Models\SaveCareer::where('user_id', auth()->user()->id)->count() }}</span>
                </div>
                <div class="illustration-wrapper">
                    <svg width="100" height="120" viewbox="0 0 100 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg"><!-- Professional Head -->
                        <circle cx="50" cy="28" r="16" fill="#FEE2E2" />
                        <!-- Professional hairstyle - shoulder length -->
                        <ellipse cx="50" cy="20" rx="16" ry="14" fill="#7F1D1D" />
                        <path d="M34 28L34 35C34 35 36 32 38 32" fill="#7F1D1D" />
                        <path d="M66 28L66 35C66 35 64 32 62 32" fill="#7F1D1D" />
                        <path d="M42 18C42 18 46 16 50 16C54 16 58 18 58 18" stroke="#991B1B" stroke-width="1"
                            stroke-linecap="round" /> <!-- Professional eyes -->
                        <ellipse cx="43" cy="28" rx="3" ry="4" fill="#7F1D1D" />
                        <ellipse cx="57" cy="28" rx="3" ry="4" fill="#7F1D1D" />
                        <circle cx="43" cy="27" r="1" fill="#FFFFFF" />
                        <circle cx="57" cy="27" r="1" fill="#FFFFFF" /> <!-- Subtle eyebrows -->
                        <path d="M39 24C39 24 41 23 45 23" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M61 24C61 24 59 23 55 23" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Professional smile -->
                        <path d="M44 35C44 35 47 37 50 37C53 37 56 35 56 35" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Business blazer -->
                        <path d="M34 44L50 44L66 44L66 78L34 78Z" fill="#991B1B" /> <!-- White blouse -->
                        <path d="M40 44L50 48L60 44" fill="#FFFFFF" />
                        <ellipse cx="50" cy="50" rx="8" ry="4" fill="#FFFFFF" />
                        <!-- Blazer lapels -->
                        <path d="M34 44L40 44L40 62" stroke="#7F1D1D" stroke-width="2" />
                        <path d="M66 44L60 44L60 62" stroke="#7F1D1D" stroke-width="2" /> <!-- Necklace/Accessory -->
                        <ellipse cx="50" cy="52" rx="3" ry="2" fill="#B91C1C" />
                        <!-- Professional arms -->
                        <path d="M26 52L34 44L34 70L28 74Z" fill="#7F1D1D" />
                        <path d="M74 52L66 44L66 70L72 74Z" fill="#7F1D1D" /> <!-- Hands holding folder -->
                        <ellipse cx="26" cy="76" rx="6" ry="5" fill="#FEE2E2" />
                        <ellipse cx="74" cy="76" rx="6" ry="5" fill="#FEE2E2" />
                        <!-- Professional folder with bookmarks -->
                        <rect x="32" y="65" width="36" height="28" rx="2" fill="#7F1D1D"
                            stroke="#991B1B" stroke-width="2" />
                        <path d="M32 70L38 65L44 70" fill="#991B1B" /> <!-- Multiple bookmarks/tabs -->
                        <rect x="40" y="62" width="4" height="8" fill="#B91C1C" />
                        <rect x="48" y="62" width="4" height="8" fill="#FEE2E2" />
                        <rect x="56" y="62" width="4" height="8" fill="#991B1B" /> <!-- Document lines -->
                        <line x1="38" y1="75" x2="62" y2="75" stroke="#FEE2E2"
                            stroke-width="1.5" />
                        <line x1="38" y1="80" x2="62" y2="80" stroke="#FEE2E2"
                            stroke-width="1.5" />
                        <line x1="38" y1="85" x2="58" y2="85" stroke="#FEE2E2"
                            stroke-width="1.5" /> <!-- Star/favorite icon -->
                        <path d="M50 78L51 81L54 81L52 83L53 86L50 84L47 86L48 83L46 81L49 81Z" fill="#FFD700" />
                        <!-- Professional skirt/trousers -->
                        <rect x="40" y="78" width="8" height="24" fill="#7F1D1D" />
                        <rect x="52" y="78" width="8" height="24" fill="#7F1D1D" />
                        <!-- Professional shoes -->
                        <ellipse cx="44" cy="104" rx="7" ry="4" fill="#991B1B" />
                        <ellipse cx="56" cy="104" rx="7" ry="4" fill="#991B1B" />
                        <!-- Bookmark icon -->
                        <rect x="78" y="28" width="12" height="16" rx="1" fill="#7F1D1D" />
                        <path d="M84 44L81 41L84 38L87 41Z" fill="#FEE2E2" />
                    </svg>
                </div>
                <div class="eh-text-center">
                    <div id="bookmarks-label" style="color: #7F1D1D;">
                        Career Bookmarks
                    </div>
                    <p class="eh-stat-description" style="color: #991B1B;">Saved favorites</p>
                </div>
            </a><!-- Submitted Applications Card -->
            <a href="/Applied%20Jobs" class="stat-card eh-stat-card">
                <!-- Badge Banner -->
                <div class="eh-badge"
                    style="background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);"><span
                        id="applications-count" style="color: #FFFFFF;">{{ App\Models\Applicant::where('user_id', auth()->user()->id)->count() }}</span>
                </div>
                <div class="illustration-wrapper">
                    <svg width="100" height="120" viewbox="0 0 100 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg"><!-- Professional Head -->
                        <circle cx="50" cy="28" r="16" fill="#FEE2E2" />
                        <!-- Professional bun hairstyle -->
                        <ellipse cx="50" cy="20" rx="15" ry="13" fill="#7F1D1D" />
                        <circle cx="68" cy="18" r="8" fill="#7F1D1D" />
                        <circle cx="68" cy="18" r="6" fill="#991B1B" /> <!-- Hair band/accessory -->
                        <ellipse cx="62" cy="20" rx="2" ry="3" fill="#B91C1C" />
                        <!-- Professional eyes -->
                        <ellipse cx="43" cy="28" rx="3" ry="4" fill="#7F1D1D" />
                        <ellipse cx="57" cy="28" rx="3" ry="4" fill="#7F1D1D" />
                        <circle cx="43" cy="27" r="1" fill="#FFFFFF" />
                        <circle cx="57" cy="27" r="1" fill="#FFFFFF" /> <!-- Professional eyebrows -->
                        <path d="M39 24C39 24 41 23 45 23" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M61 24C61 24 59 23 55 23" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Confident smile -->
                        <path d="M44 35C44 35 47 37 50 37C53 37 56 35 56 35" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Professional blouse/shirt -->
                        <path d="M34 44L50 44L66 44L66 78L34 78Z" fill="#B91C1C" /> <!-- White collar -->
                        <path d="M40 44L50 48L60 44L60 52L50 56L40 52Z" fill="#FFFFFF" /> <!-- Collar detail -->
                        <line x1="40" y1="44" x2="40" y2="52" stroke="#7F1D1D"
                            stroke-width="1.5" />
                        <line x1="60" y1="44" x2="60" y2="52" stroke="#7F1D1D"
                            stroke-width="1.5" /> <!-- Button -->
                        <circle cx="50" cy="60" r="2" fill="#7F1D1D" /> <!-- Professional arms -->
                        <path d="M28 52L34 44L34 70L30 74Z" fill="#991B1B" />
                        <path d="M72 52L66 44L66 70L70 74Z" fill="#991B1B" /> <!-- Hands -->
                        <ellipse cx="28" cy="76" rx="6" ry="5" fill="#FEE2E2" />
                        <ellipse cx="72" cy="76" rx="6" ry="5" fill="#FEE2E2" />
                        <!-- Professional application document -->
                        <rect x="66" y="58" width="24" height="30" rx="2" fill="#FFFFFF"
                            stroke="#7F1D1D" stroke-width="2" /> <!-- Document header -->
                        <rect x="69" y="61" width="18" height="4" fill="#7F1D1D" /> <!-- Document lines -->
                        <line x1="69" y1="68" x2="87" y2="68" stroke="#7F1D1D"
                            stroke-width="1.5" />
                        <line x1="69" y1="72" x2="87" y2="72" stroke="#7F1D1D"
                            stroke-width="1.5" />
                        <line x1="69" y1="76" x2="84" y2="76" stroke="#7F1D1D"
                            stroke-width="1.5" />
                        <line x1="69" y1="80" x2="87" y2="80" stroke="#7F1D1D"
                            stroke-width="1.5" /> <!-- Professional stamp/seal -->
                        <circle cx="78" cy="82" r="5" stroke="#4CAF50" stroke-width="2"
                            fill="none" />
                        <path d="M75 82L77 84L81 80" stroke="#4CAF50" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" /> <!-- Professional skirt -->
                        <path d="M34 78L38 78L40 102L36 102Z" fill="#7F1D1D" />
                        <path d="M66 78L62 78L60 102L64 102Z" fill="#7F1D1D" />
                        <rect x="42" y="78" width="16" height="24" fill="#7F1D1D" />
                        <!-- Professional heels -->
                        <path d="M38 102L40 106L42 106L42 102Z" fill="#991B1B" />
                        <path d="M58 102L58 106L60 106L62 102Z" fill="#991B1B" />
                        <!-- Professional icons - clipboard and pen -->
                        <rect x="12" y="55" width="14" height="18" rx="1" fill="#FEE2E2"
                            stroke="#7F1D1D" stroke-width="1.5" />
                        <rect x="15" y="53" width="8" height="3" rx="1" fill="#7F1D1D" />
                        <line x1="15" y1="59" x2="23" y2="59" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="15" y1="63" x2="23" y2="63" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="15" y1="67" x2="20" y2="67" stroke="#7F1D1D"
                            stroke-width="1" /> <!-- Pen -->
                        <rect x="8" y="68" width="3" height="12" fill="#991B1B"
                            transform="rotate(-25 9.5 74)" />
                        <path d="M6 82L7 83L9 81Z" fill="#7F1D1D" />
                    </svg>
                </div>
                <div class="eh-text-center">
                    <div id="applications-label" style="color: #7F1D1D;">
                        Submitted Applications
                    </div>
                    <p class="eh-stat-description" style="color: #991B1B;">Applications sent</p>
                </div>
            </a><!-- Job Offers Card -->
            <a href="/Job%20Offers" class="stat-card eh-stat-card">
                <!-- Badge Banner -->
                <div class="eh-badge"
                    style="background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);"><span id="offers-count"
                        style="color: #FFFFFF;">{{ App\Models\SelectedApplicant::where('applicant_id', auth()->user()->id)->count() }}</span>
                </div>
                <div class="illustration-wrapper">
                    <svg width="100" height="120" viewbox="0 0 100 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg"><!-- Professional Head -->
                        <circle cx="50" cy="28" r="16" fill="#FEE2E2" />
                        <!-- Professional short hairstyle -->
                        <path
                            d="M36 22C36 14 42 10 50 10C58 10 64 14 64 22L64 28C64 28 60 26 55 26C52 26 48 26 45 26C40 26 36 28 36 28Z"
                            fill="#7F1D1D" />
                        <path d="M42 14C42 14 46 12 50 12C54 12 58 14 58 14" stroke="#991B1B" stroke-width="1"
                            stroke-linecap="round" /> <!-- Professional confident eyes -->
                        <ellipse cx="43" cy="28" rx="3" ry="4" fill="#7F1D1D" />
                        <ellipse cx="57" cy="28" rx="3" ry="4" fill="#7F1D1D" />
                        <circle cx="43" cy="27" r="1" fill="#FFFFFF" />
                        <circle cx="57" cy="27" r="1" fill="#FFFFFF" /> <!-- Happy eyebrows raised -->
                        <path d="M38 23C38 23 40 22 44 22" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M62 23C62 23 60 22 56 22" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Big professional smile -->
                        <path d="M42 34C42 34 46 38 50 38C54 38 58 34 58 34" stroke="#7F1D1D" stroke-width="2"
                            stroke-linecap="round" /> <!-- Executive suit -->
                        <path d="M34 44L50 44L66 44L66 78L34 78Z" fill="#7F1D1D" /> <!-- White dress shirt -->
                        <path d="M42 44L50 50L58 44" fill="#FFFFFF" />
                        <rect x="45" y="50" width="10" height="28" fill="#FFFFFF" /> <!-- Suit lapels -->
                        <path d="M34 44L42 44L42 68" stroke="#991B1B" stroke-width="2.5" />
                        <path d="M66 44L58 44L58 68" stroke="#991B1B" stroke-width="2.5" /> <!-- Executive tie -->
                        <path d="M50 50L48 56L50 75L52 56Z" fill="#B91C1C" />
                        <path d="M48 50L50 53L52 50Z" fill="#B91C1C" /> <!-- Suit buttons -->
                        <circle cx="50" cy="60" r="1.5" fill="#991B1B" />
                        <circle cx="50" cy="66" r="1.5" fill="#991B1B" />
                        <circle cx="50" cy="72" r="1.5" fill="#991B1B" /> <!-- Pocket square -->
                        <rect x="38" y="48" width="4" height="3" fill="#FEE2E2" />
                        <!-- Arms raised professionally -->
                        <path d="M24 40L32 48L34 44L32 62L26 56Z" fill="#991B1B" />
                        <path d="M76 40L68 48L66 44L68 62L74 56Z" fill="#991B1B" /> <!-- Professional hands -->
                        <ellipse cx="24" cy="38" rx="6" ry="5" fill="#FEE2E2" />
                        <ellipse cx="76" cy="38" rx="6" ry="5" fill="#FEE2E2" />
                        <!-- Professional gesture -->
                        <path d="M22 36L20 33M24 35L24 32M26 36L28 33" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M78 36L80 33M76 35L76 32M74 36L72 33" stroke="#7F1D1D" stroke-width="1.5"
                            stroke-linecap="round" /> <!-- Award/Trophy -->
                        <ellipse cx="50" cy="15" rx="12" ry="9" fill="#FFD700"
                            stroke="#B8860B" stroke-width="2" />
                        <rect x="45" y="10" width="10" height="12" fill="#FFD700" stroke="#B8860B"
                            stroke-width="1.5" />
                        <rect x="40" y="8" width="20" height="5" rx="2" fill="#FFD700"
                            stroke="#B8860B" stroke-width="1.5" /> <!-- Star on trophy -->
                        <path d="M50 14L51 17L54 17L52 19L53 22L50 20L47 22L48 19L46 17L49 17Z" fill="#7F1D1D" />
                        <!-- Professional trousers -->
                        <rect x="40" y="78" width="8" height="24" fill="#991B1B" />
                        <rect x="52" y="78" width="8" height="24" fill="#991B1B" /> <!-- Crease lines -->
                        <line x1="44" y1="78" x2="44" y2="102" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="56" y1="78" x2="56" y2="102" stroke="#7F1D1D"
                            stroke-width="1" /> <!-- Dress shoes -->
                        <ellipse cx="44" cy="104" rx="7" ry="4" fill="#7F1D1D" />
                        <ellipse cx="56" cy="104" rx="7" ry="4" fill="#7F1D1D" />
                        <ellipse cx="44" cy="104" rx="4" ry="2" fill="#991B1B" />
                        <ellipse cx="56" cy="104" rx="4" ry="2" fill="#991B1B" />
                        <!-- Professional success elements --> <!-- Offer letter -->
                        <rect x="8" y="50" width="16" height="20" rx="1" fill="#FFFFFF"
                            stroke="#7F1D1D" stroke-width="2" />
                        <rect x="10" y="52" width="12" height="3" fill="#4CAF50" />
                        <line x1="11" y1="58" x2="21" y2="58" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="11" y1="62" x2="21" y2="62" stroke="#7F1D1D"
                            stroke-width="1" />
                        <line x1="11" y1="66" x2="18" y2="66" stroke="#7F1D1D"
                            stroke-width="1" /> <!-- Checkmark of approval -->
                        <circle cx="16" cy="64" r="4" fill="#4CAF50" />
                        <path d="M14 64L15.5 65.5L18 63" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" /> <!-- Professional confetti -->
                        <circle cx="20" cy="25" r="2" fill="#FFD700" />
                        <circle cx="80" cy="25" r="2" fill="#4CAF50" />
                        <path d="M28 20L30 22L28 24L26 22Z" fill="#B91C1C" />
                        <path d="M72 20L74 22L72 24L70 22Z" fill="#7F1D1D" />
                    </svg>
                </div>
                <div class="eh-text-center">
                    <div id="offers-label" style="color: #7F1D1D;">
                        Job Offers
                    </div>
                    <p class="eh-stat-description" style="color: #991B1B;">Congratulations!</p>
                </div>
            </a>
        </main><!-- Resume Builder Section --> --}}
        <br>
        {{-- <section class="eh-section">
            <div class="eh-card eh-card--gradient"
                style="background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);">
                <div class="eh-dual-grid">
                    <!-- Left side - Resume Preview Illustration -->
                    <div class="eh-flex-center">
                        <svg width="300" height="400" viewbox="0 0 300 400" fill="none"
                            xmlns="http://www.w3.org/2000/svg"><!-- Resume Document -->
                            <rect x="50" y="20" width="200" height="360" rx="8" fill="#FFFFFF"
                                stroke="#FEE2E2" stroke-width="3" /> <!-- Header section with photo placeholder -->
                            <circle cx="150" cy="70" r="25" fill="#FEE2E2" stroke="#7F1D1D"
                                stroke-width="2" />
                            <circle cx="145" cy="67" r="3" fill="#7F1D1D" />
                            <circle cx="155" cy="67" r="3" fill="#7F1D1D" />
                            <path d="M145 78C145 78 147 80 150 80C153 80 155 78 155 78" stroke="#7F1D1D"
                                stroke-width="2" stroke-linecap="round" /> <!-- Name lines -->
                            <rect x="70" y="110" width="160" height="8" rx="4" fill="#7F1D1D" />
                            <rect x="90" y="125" width="120" height="6" rx="3" fill="#991B1B" />
                            <!-- Contact info icons and lines -->
                            <circle cx="80" cy="150" r="4" fill="#B91C1C" />
                            <rect x="90" y="147" width="100" height="4" rx="2" fill="#FEE2E2" />
                            <circle cx="80" cy="165" r="4" fill="#B91C1C" />
                            <rect x="90" y="162" width="100" height="4" rx="2" fill="#FEE2E2" />
                            <!-- Section headers and content -->
                            <rect x="70" y="185" width="80" height="6" rx="3" fill="#7F1D1D" />
                            <rect x="70" y="200" width="160" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="210" width="150" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="220" width="140" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="240" width="70" height="6" rx="3" fill="#7F1D1D" />
                            <rect x="70" y="255" width="160" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="265" width="150" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="275" width="140" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="295" width="60" height="6" rx="3" fill="#7F1D1D" />
                            <rect x="70" y="310" width="160" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="320" width="150" height="3" rx="1.5" fill="#FEE2E2" />
                            <rect x="70" y="330" width="130" height="3" rx="1.5" fill="#FEE2E2" />
                            <!-- Checkmark badge -->
                            <circle cx="230" cy="50" r="20" fill="#4CAF50" />
                            <path d="M222 50L228 56L238 46" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round" /> <!-- Decorative stars -->
                            <path d="M35 100L37 100M36 99L36 101" stroke="#FFD700" stroke-width="3"
                                stroke-linecap="round" />
                            <path d="M265 200L267 200M266 199L266 201" stroke="#FFD700" stroke-width="3"
                                stroke-linecap="round" />
                            <path d="M40 300L42 300M41 299L41 301" stroke="#4CAF50" stroke-width="3"
                                stroke-linecap="round" />
                        </svg>
                    </div><!-- Right side - Resume Builder Content -->
                    <div>
                        <div class="eh-badge-wrapper"><span id="resume-badge"
                                class="eh-pill"
                                style="background: #FFFFFF; color: #7F1D1D;">Free Resume Builder</span>
                        </div>
                        <h2 id="resume-title" style="color: #FFFFFF;">
                            Create Your Professional Resume</h2>
                        <p id="resume-subtitle" style="color: #FEE2E2;">Stand Out
                            with a Polished Resume in Minutes</p>
                        <p id="resume-description" style="color: #FFFFFF; opacity: 0.9;">Build
                            a professional resume that gets you noticed! Simply fill out our easy form with your
                            information, and we'll generate a beautifully formatted resume ready to impress employers.
                            No design skills needed!</p><!-- Features list -->
                        <ul class="eh-feature-list">
                            <li class="eh-feature-item">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    class="eh-feature-icon">
                                    <circle cx="12" cy="12" r="10" fill="#FFD700" />
                                    <path d="M8 12L11 15L16 9" stroke="#7F1D1D" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span id="resume-feature-1" style="color: #FFFFFF;">Quick
                                    &amp; easy form - ready in 5 minutes</span>
                            </li>
                            <li class="eh-feature-item">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    class="eh-feature-icon">
                                    <circle cx="12" cy="12" r="10" fill="#FFD700" />
                                    <path d="M8 12L11 15L16 9" stroke="#7F1D1D" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span id="resume-feature-2"
                                    style="color: #FFFFFF;">Professional templates designed by experts</span>
                            </li>
                            <li class="eh-feature-item">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    class="eh-feature-icon">
                                    <circle cx="12" cy="12" r="10" fill="#FFD700" />
                                    <path d="M8 12L11 15L16 9" stroke="#7F1D1D" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span id="resume-feature-3" style="color: #FFFFFF;">Download
                                    instantly in PDF format</span>
                            </li>
                        </ul><!-- CTA Button -->
                        <a href="/Applicants/{{ App\Models\CurriculumVitae::where('user_id', auth()->user()->id)->first()->id }}/edit" id="resume-button"
                            class="eh-primary-button"
                            style="background: #FFFFFF; color: #7F1D1D;"> Start
                            Building Your Resume → </a>
                    </div>
                </div>
            </div>
        </section><!-- Advertisement Section -->
        <section class="eh-section">
            <div class="eh-card" style="background: #FFFFFF;">
                <div class="eh-dual-grid"><!-- Left side - Large Image -->
                    <div class="eh-hero-visual">
                        <svg width="100%" height="400" viewbox="0 0 500 400" fill="none"
                            xmlns="http://www.w3.org/2000/svg"><!-- Background gradient -->
                            <rect width="500" height="400" rx="12" fill="url(#grad1)" />
                            <defs>
                                <lineargradient id="grad1" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" style="stop-color:#7F1D1D;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#991B1B;stop-opacity:1" />
                                </lineargradient>
                            </defs> <!-- Decorative circles -->
                            <circle cx="50" cy="50" r="30" fill="#FEE2E2" opacity="0.2" />
                            <circle cx="450" cy="350" r="40" fill="#FEE2E2" opacity="0.2" />
                            <circle cx="420" cy="80" r="25" fill="#FEE2E2" opacity="0.15" />
                            <!-- Central professional figure -->
                            <g transform="translate(180, 80)"><!-- Head -->
                                <circle cx="70" cy="45" r="35" fill="#FEE2E2" />
                                <!-- Professional hairstyle -->
                                <ellipse cx="70" cy="30" rx="32" ry="28"
                                    fill="#B91C1C" />
                                <path d="M40 42C40 42 45 38 52 40L50 52Z" fill="#B91C1C" />
                                <path d="M100 42C100 42 95 38 88 40L90 52Z" fill="#B91C1C" /> <!-- Eyes -->
                                <ellipse cx="58" cy="45" rx="4" ry="5"
                                    fill="#7F1D1D" />
                                <ellipse cx="82" cy="45" rx="4" ry="5"
                                    fill="#7F1D1D" />
                                <circle cx="59" cy="44" r="2" fill="#FFFFFF" />
                                <circle cx="83" cy="44" r="2" fill="#FFFFFF" /> <!-- Smile -->
                                <path d="M55 55C55 55 62 60 70 60C78 60 85 55 85 55" stroke="#7F1D1D"
                                    stroke-width="3" stroke-linecap="round" /> <!-- Professional suit -->
                                <path d="M35 80L70 80L105 80L105 160L35 160Z" fill="#FFFFFF" />
                                <!-- Suit jacket over -->
                                <path d="M30 80L70 80L110 80L110 170L30 170Z" fill="#7F1D1D" opacity="0.9" />
                                <!-- Lapels -->
                                <path d="M30 80L45 80L45 130" stroke="#991B1B" stroke-width="3" />
                                <path d="M110 80L95 80L95 130" stroke="#991B1B" stroke-width="3" /> <!-- Tie -->
                                <path d="M70 80L66 95L70 155L74 95Z" fill="#B91C1C" /> <!-- Arms -->
                                <path d="M20 95L30 80L30 140L25 145Z" fill="#991B1B" />
                                <path d="M120 95L110 80L110 140L115 145Z" fill="#991B1B" /> <!-- Hands -->
                                <ellipse cx="20" cy="148" rx="10" ry="8"
                                    fill="#FEE2E2" />
                                <ellipse cx="120" cy="148" rx="10" ry="8"
                                    fill="#FEE2E2" /> <!-- Legs -->
                                <rect x="50" y="170" width="15" height="50" fill="#991B1B" />
                                <rect x="75" y="170" width="15" height="50" fill="#991B1B" />
                                <!-- Shoes -->
                                <ellipse cx="57" cy="222" rx="12" ry="6"
                                    fill="#7F1D1D" />
                                <ellipse cx="82" cy="222" rx="12" ry="6"
                                    fill="#7F1D1D" />
                            </g> <!-- Laptop/Computer -->
                            <rect x="150" y="280" width="200" height="8" rx="4" fill="#B91C1C" />
                            <rect x="180" y="200" width="140" height="85" rx="4" fill="#FEE2E2"
                                stroke="#7F1D1D" stroke-width="3" />
                            <rect x="190" y="210" width="120" height="65" fill="#7F1D1D" />
                            <!-- Screen content - job portal interface -->
                            <rect x="195" y="215" width="110" height="8" fill="#FFD700" />
                            <line x1="200" y1="230" x2="280" y2="230" stroke="#FEE2E2"
                                stroke-width="2" />
                            <line x1="200" y1="240" x2="280" y2="240" stroke="#FEE2E2"
                                stroke-width="2" />
                            <line x1="200" y1="250" x2="270" y2="250" stroke="#FEE2E2"
                                stroke-width="2" />
                            <rect x="200" y="260" width="35" height="8" rx="2" fill="#4CAF50" />
                            <!-- Decorative icons --> <!-- Briefcase icon -->
                            <g transform="translate(30, 150)">
                                <rect x="0" y="0" width="35" height="28" rx="3" fill="#FFD700" />
                                <rect x="13" y="-5" width="9" height="8" rx="2"
                                    fill="#B8860B" />
                                <line x1="5" y1="14" x2="30" y2="14"
                                    stroke="#B8860B" stroke-width="2" />
                            </g> <!-- Document icon -->
                            <g transform="translate(430, 200)">
                                <rect x="0" y="0" width="30" height="40" rx="2" fill="#FEE2E2"
                                    stroke="#7F1D1D" stroke-width="2" />
                                <line x1="5" y1="10" x2="25" y2="10"
                                    stroke="#7F1D1D" stroke-width="2" />
                                <line x1="5" y1="18" x2="25" y2="18"
                                    stroke="#7F1D1D" stroke-width="2" />
                                <line x1="5" y1="26" x2="20" y2="26"
                                    stroke="#7F1D1D" stroke-width="2" />
                            </g> <!-- Success checkmark -->
                            <circle cx="430" cy="160" r="20" fill="#4CAF50" />
                            <path d="M420 160L427 167L440 154" stroke="#FFFFFF" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" /> <!-- Text overlay --> <text
                                x="250" y="50" text-anchor="middle" fill="#FFFFFF" font-size="32"
                                font-weight="bold" font-family="Arial, sans-serif">
                                SSU JOB PORTAL
                            </text> <text x="250" y="370" text-anchor="middle" fill="#FEE2E2" font-size="18"
                                font-family="Arial, sans-serif">
                                Your Gateway to Career Success
                            </text>
                        </svg><!-- Small image in bottom-left corner -->
                        <div class="eh-badge-overlay" style="width: 120px; height: 120px;">
                            <svg width="120" height="120" viewbox="0 0 120 120" fill="none"
                                xmlns="http://www.w3.org/2000/svg"><!-- Badge background -->
                                <circle cx="60" cy="60" r="58" fill="#FFFFFF" stroke="#7F1D1D"
                                    stroke-width="3" />
                                <circle cx="60" cy="60" r="50" fill="#7F1D1D" /> <!-- Star badge -->
                                <path d="M60 25L65 45L85 45L70 57L75 77L60 65L45 77L50 57L35 45L55 45Z"
                                    fill="#FFD700" /> <!-- SSU Text --> <text x="60" y="95" text-anchor="middle"
                                    fill="#FFFFFF" font-size="16" font-weight="bold"
                                    font-family="Arial, sans-serif">
                                    SSU
                                </text> <text x="60" y="110" text-anchor="middle" fill="#FEE2E2" font-size="10"
                                    font-family="Arial, sans-serif">
                                    VERIFIED
                                </text>
                            </svg>
                        </div>
                    </div><!-- Right side - Advertisement Content -->
                    <div>
                        <div class="eh-badge-wrapper"><span id="ad-badge"
                                class="eh-pill"
                                style="background: #FEE2E2; color: #7F1D1D;">Featured Partner</span>
                        </div>
                        <h2 id="ad-title" style="color: #7F1D1D;">SSU
                            Job Portal</h2>
                        <p id="ad-subtitle" style="color: #991B1B;">Connect
                            with Top Employers Today</p>
                        <p id="ad-description" style="color: #B91C1C;">Discover thousands
                            of career opportunities tailored to your skills and experience. Join SSU Job Portal and take
                            your career to the next level with exclusive access to premium job listings, career
                            resources, and expert guidance.</p><!-- Features list -->
                        <ul class="eh-feature-list">
                            <li class="eh-feature-item">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    class="eh-feature-icon">
                                    <circle cx="12" cy="12" r="10" fill="#4CAF50" />
                                    <path d="M8 12L11 15L16 9" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span id="ad-feature-1" style="color: #991B1B;">Access to
                                    10,000+ verified job listings</span>
                            </li>
                            <li class="eh-feature-item">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    class="eh-feature-icon">
                                    <circle cx="12" cy="12" r="10" fill="#4CAF50" />
                                    <path d="M8 12L11 15L16 9" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span id="ad-feature-2" style="color: #991B1B;">Direct
                                    connections with hiring managers</span>
                            </li>
                            <li class="eh-feature-item">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    class="eh-feature-icon">
                                    <circle cx="12" cy="12" r="10" fill="#4CAF50" />
                                    <path d="M8 12L11 15L16 9" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span id="ad-feature-3" style="color: #991B1B;">Free
                                    career counseling and resume reviews</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> --}}
    </div>
</x-filament-panels::page>
