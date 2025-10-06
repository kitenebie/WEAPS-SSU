// Tabs
function showTab(tab) {
    document
        .querySelectorAll(".tab-content")
        .forEach((el) => el.classList.add("hidden"));
    document.getElementById(tab + "-section").classList.remove("hidden");

    document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.classList.remove("border-red-900", "text-red-900", "font-semibold");
        btn.classList.add("border-transparent", "text-gray-600");
    });
    event.target.classList.add(
        "border-red-900",
        "text-red-900",
        "font-semibold"
    );
}

// Profile Modal
function openEditModal() {
    document.getElementById("editModal").classList.remove("hidden");
    document.getElementById("editCompanyName").value =
        document.getElementById("companyName").innerText;
    document.getElementById("editCompanyType").value =
        document.getElementById("companyType").innerText;
    document.getElementById("editLocation").value =
        document.getElementById("location").innerText;
    document.getElementById("editFounded").value =
        document.getElementById("founded").innerText;
    document.getElementById("editEmployees").value =
        document.getElementById("employees").innerText;
    document.getElementById("editDescription").value =
        document.getElementById("companyDescription").innerText;
    document.getElementById("editIndustry").value =
        document.getElementById("industry").innerText;
    document.getElementById("editCompanySize").value =
        document.getElementById("companySize").innerText;
}

function closeEditModal() {
    document.getElementById("editModal").classList.add("hidden");
}

function saveProfile() {
    document.getElementById("companyName").innerText =
        document.getElementById("editCompanyName").value;
    document.getElementById("companyType").innerText =
        document.getElementById("editCompanyType").value;
    document.getElementById("location").innerText =
        document.getElementById("editLocation").value;
    document.getElementById("founded").innerText =
        document.getElementById("editFounded").value;
    document.getElementById("employees").innerText =
        document.getElementById("editEmployees").value;
    document.getElementById("companyDescription").innerText =
        document.getElementById("editDescription").value;
    document.getElementById("industry").innerText =
        document.getElementById("editIndustry").value;
    document.getElementById("companySize").innerText =
        document.getElementById("editCompanySize").value;
    closeEditModal();
}

// Careers Modal
function addPosition() {
    document.getElementById("addPositionModal").classList.remove("hidden");
}

function closePositionModal() {
    document.getElementById("addPositionModal").classList.add("hidden");
}

function savePosition() {
    const title = document.getElementById("jobTitle").value;
    const location = document.getElementById("jobLocation").value;
    const type = document.getElementById("jobType").value;
    const description = document.getElementById("jobDescription").value;

    const jobPositions = document.getElementById("jobPositions");
    const newJob = document.createElement("div");
    newJob.className =
        "border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow";
    newJob.innerHTML = `
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h4 class="font-semibold text-lg text-gray-900">${title}</h4>
                        <p class="text-gray-600 mb-2">${type} • ${location}</p>
                        <p class="text-gray-700 text-sm">${description}</p>
                    </div>
                    <button class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                        Apply Now
                    </button>
                </div>
            `;
    jobPositions.appendChild(newJob);
    closePositionModal();
}

// Placeholder functions
function updateLogo() {
    alert("Change logo functionality coming soon!");
}

function updateCoverPhoto() {
    alert("Change cover photo functionality coming soon!");
}
