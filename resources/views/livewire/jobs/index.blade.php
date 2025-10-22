<div x-data="jobBoard()" x-init="init()" class="job-board-container">
    <style>
        .job-board-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #800000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .job-board-container .status {
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
        }

        .job-board-container .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 4rem;
        }

        .job-board-container .search-bar input {
            width: 90%;
            max-width: 500px;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #800000;
            font-size: 16px;
        }

        .job-board-container .job-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .job-board-container .job-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(128, 0, 0, 0.15);
            transition: transform 0.2s;
            border-top: 6px solid #800000;
        }

        .job-board-container .job-card:hover {
            transform: translateY(-5px);
        }

        .job-board-container .job-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #800000;
        }

        .job-board-container .job-summary {
            font-size: 14px;
            margin-bottom: 10px;
            color: #444;
        }

        .job-board-container .job-qualifications {
            font-size: 14px;
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .job-board-container .job-qualifications li {
            margin-bottom: 6px;
        }

        .job-board-container .job-link {
            display: inline-block;
            text-decoration: none;
            background: #800000;
            color: #FFD700;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .job-board-container .job-link:hover {
            background: #600000;
        }

        .job-board-container .count-chip {
            display: inline-block;
            background: #FFD700;
            color: #800000;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 13px;
            margin-left: 10px;
            font-weight: bold;
        }

        .job-board-container .loading {
            text-align: center;
            color: #800000;
            font-style: italic;
        }
        .title{
            font-size: 2.5rem;
            font-weight: 700;
        }
    </style>
    <img style="margin: 0 auto;" src="/Hiring.png" height="400" width="auto" alt="" srcset="">
    <h1 class="title">WEAPS JOB BOARD <span class="count-chip" x-text="jobCount + ' jobs'"></span></h1>
    
    <div class="status" x-text="status"></div>
    
    <div class="search-bar">
        <input 
            type="text" 
            x-model="search" 
            @input="filterJobs()" 
            placeholder="Search jobs by title or keyword..." 
        />
    </div>
    
    <div class="job-list">
        <template x-if="loading">
            <div class="loading">Loading jobs...</div>
        </template>
        
        <template x-if="!loading && filteredJobs.length === 0">
            <p style="grid-column:1/-1;text-align:center;color:#800000;">No jobs found</p>
        </template>
        
        <template x-for="job in filteredJobs" :key="job.title">
            <div class="job-card">
                <div class="job-title" x-text="job.title"></div>
                <div class="job-summary" x-text="job.job_summary || 'No summary available.'"></div>
                <ul class="job-qualifications">
                    <template x-for="qualification in job.qualifications" :key="qualification">
                        <li x-text="qualification"></li>
                    </template>
                </ul>
                <a :href="job.link" target="_blank" class="job-link">View on Site</a>
            </div>
        </template>
    </div>

    <script>
        function jobBoard() {
            return {
                search: '',
                jobs: [],
                filteredJobs: [],
                loading: true,
                status: 'Fetching jobs...',
                
                get jobCount() {
                    return this.filteredJobs.length;
                },

                init() {
                    this.fetchJobs();
                    // Refresh jobs every 15 seconds
                    setInterval(() => {
                        this.fetchJobs();
                    }, 15000);
                },

                async fetchJobs() {
                    this.loading = true;
                    this.status = 'Loading jobs...';
                    
                    try {
                        const [hondaJobs, mondeJobs] = await Promise.all([
                            this.fetchHondaJobs(),
                            this.fetchMondeJobs()
                        ]);

                        this.jobs = [...hondaJobs, ...mondeJobs];
                        this.filterJobs();
                        this.status = `Loaded ${this.jobs.length} jobs`;
                        this.loading = false;
                    } catch (error) {
                        console.error('Error fetching jobs:', error);
                        this.status = 'Error loading jobs';
                        this.loading = false;
                    }
                },

                async fetchHondaJobs() {
                    const PROXY = "https://api.allorigins.win/raw?url=";
                    const url = PROXY + encodeURIComponent("https://www.hondaph.com/careers");
                    
                    try {
                        const res = await fetch(url);
                        const html = await res.text();
                        return this.parseHonda(html);
                    } catch (err) {
                        console.error("Honda fetch failed", err);
                        return [];
                    }
                },

                parseHonda(html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");
                    const headers = doc.querySelectorAll(".collapse-header");

                    return [...headers].map(header => {
                        const titleDiv = header.querySelector("div");
                        const title = titleDiv?.textContent.trim() || "Untitled";

                        const dataTarget = titleDiv?.getAttribute("data-target");
                        const collapseId = dataTarget ? dataTarget.replace("#", "") : null;
                        const detailsDiv = collapseId ? doc.querySelector("#" + collapseId + " .collapse-data") : null;

                        let job_summary = "";
                        let qualifications = [];

                        if (detailsDiv) {
                            const paras = [...detailsDiv.querySelectorAll("p")].map(p => p.textContent.trim());
                            const summaryParts = [];
                            let inSummary = true;

                            for (let text of paras) {
                                if (/JOB QUALIFICATIONS/i.test(text)) {
                                    inSummary = false;
                                    continue;
                                }
                                if (/JOB SUMMARY/i.test(text)) continue;
                                if (inSummary && text) summaryParts.push(text);
                            }
                            job_summary = summaryParts.join(" ");
                            qualifications = [...detailsDiv.querySelectorAll("ul li")].map(li => li.textContent.trim());
                        }

                        return {
                            title,
                            job_summary,
                            qualifications,
                            link: "https://www.hondaph.com/careers"
                        };
                    });
                },

                async fetchMondeJobs() {
                    const PROXY = "https://api.allorigins.win/raw?url=";
                    const url = PROXY + encodeURIComponent("https://mondenissin.com/careers-and-opportunities/");
                    
                    try {
                        const res = await fetch(url);
                        const html = await res.text();
                        return this.parseMonde(html);
                    } catch (err) {
                        console.error("Monde fetch failed", err);
                        return [];
                    }
                },

                parseMonde(html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");
                    
                    return [...doc.querySelectorAll(".elementor-column.elementor-col-50")]
                        .map(col => {
                            const title = col.querySelector(".jet-listing-dynamic-field__content")?.textContent.trim();
                            if (!title || title.toLowerCase().includes("untitled")) return null;

                            const allContents = [...col.querySelectorAll(".jet-listing-dynamic-field__content")]
                                .map(el => el.textContent.trim())
                                .filter(Boolean);

                            const job_summary = allContents[1] || "";
                            const qualificationsRaw = allContents[2] || "";
                            const qualifications = qualificationsRaw.split(/\r?\n|;/).map(q => q.trim()).filter(Boolean);

                            const link = col.querySelector(".elementor-button-link")?.href ||
                                "https://mondenissin.com/careers-and-opportunities/";

                            return {
                                title,
                                job_summary,
                                qualifications,
                                link
                            };
                        })
                        .filter(Boolean);
                },

                filterJobs() {
                    const query = this.search.toLowerCase();
                    this.filteredJobs = this.jobs.filter(job =>
                        job.title.toLowerCase().includes(query) ||
                        job.job_summary.toLowerCase().includes(query) ||
                        job.qualifications.some(q => q.toLowerCase().includes(query))
                    );
                }
            }
        }
    </script>
</div>