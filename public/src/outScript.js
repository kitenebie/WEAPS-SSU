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
    const modal = document.getElementById("addPositionModal");
    modal.classList.remove("hidden");
    setTimeout(() => {
        modal.classList.add("opacity-100", "scale-100");
    }, 10);
}

function closePositionModal() {
    const modal = document.getElementById("addPositionModal");
    modal.classList.remove("opacity-100", "scale-100");
    modal.classList.add("scale-95");
    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
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

// CSRF token setup
window.csrfToken =
    document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content") ||
    (window.Laravel && window.Laravel.csrfToken) ||
    "{{ csrf_token() }}";

// Tab functionality
function showTab(tabName) {
    const contents = document.querySelectorAll(".tab-content");
    contents.forEach((content) => content.classList.add("hidden"));

    const btns = document.querySelectorAll(".tab-btn");
    btns.forEach((btn) => {
        btn.classList.remove("border-red-900", "text-red-900");
        btn.classList.add("border-transparent", "text-gray-600");
    });

    const section = document.getElementById(tabName + "-section");
    if (section) section.classList.remove("hidden");

    if (window.event && window.event.target) {
        const el = window.event.target;
        el.classList.remove("border-transparent", "text-gray-600");
        el.classList.add("border-red-900", "text-red-900");
    }
}

function saveJob(careerId) {
    fetch("/career/save", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: JSON.stringify({ career_id: careerId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Job saved successfully!",
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: data.message || "Failed to save job.",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "An error occurred while saving the job.",
            });
        });
}

function applyNow(careerId) {
    fetch("/career/apply", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: JSON.stringify({ career_id: careerId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Application submitted successfully!",
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: data.message || "Failed to submit application.",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "An error occurred while submitting the application.",
            });
        });
}

// Reviews
function submitReview(companyId) {
    const ratingEl = document.getElementById("rating-value");
    const reviewEl = document.getElementById("review-text");
    const anonEl = document.getElementById("is-anonymous");

    if (!ratingEl) {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Rating input not found.",
        });
        return;
    }

    const rating = parseInt(ratingEl.value || "0", 10);
    const reviewText = reviewEl ? reviewEl.value : "";
    const isAnonymous = anonEl ? !!anonEl.checked : false;

    if (!rating || rating < 1 || rating > 5) {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Please select a rating.",
        });
        return;
    }

    const submitBtn = document.getElementById("submit-review-btn");
    const originalText = submitBtn ? submitBtn.textContent : null;
    if (submitBtn) {
        submitBtn.textContent = "Submitting...";
        submitBtn.disabled = true;
    }

    const formData = new FormData();
    formData.append("company_id", companyId);
    formData.append("rating", rating);
    formData.append("review_text", reviewText);
    formData.append("is_anonymous", isAnonymous ? "1" : "0");

    // Use the test endpoint if still enabled; replace with '/company/review/store' when finalized.
    fetch("/company/review/store-test", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: formData,
    })
        .then((response) => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Review submitted successfully!",
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    if (ratingEl) ratingEl.value = 5;
                    if (reviewEl) reviewEl.value = "";
                    if (anonEl) anonEl.checked = false;
                    initializeStarRating();

                    loadReviews(companyId);
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: data.message || "Failed to submit review.",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "An error occurred while submitting the review.",
            });
        })
        .finally(() => {
            if (submitBtn) {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
}

function loadReviews(companyId) {
    fetch("/company/" + companyId + "/reviews", {
        method: "GET",
        headers: {
            "X-CSRF-TOKEN": window.csrfToken,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                displayReviews(data);
            } else {
                console.error("Error loading reviews:", data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function displayReviews(data) {
    const container = document.getElementById("reviews-container");
    if (!container) return;

    const reviews = data.reviews?.data || [];
    const averageRating = data.average_rating || 0;
    const reviewCount = data.review_count || 0;

    const summaryHtml = `
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Overall Rating</h4>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-900">${averageRating}</div>
                                <div class="flex items-center mt-1">
                                    ${generateStarRating(averageRating)}
                                    <span class="ml-2 text-sm text-gray-600">(${reviewCount} ${
        reviewCount === 1 ? "review" : "reviews"
    })</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-5 gap-2">
                            ${generateRatingDistribution(
                                data.rating_distribution || {},
                                reviewCount
                            )}
                        </div>
                    </div>
                `;

    let reviewsHtml = "";
    if (reviews.length > 0) {
        reviews.forEach((review) => {
            reviewsHtml += `
                            <div class="border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-red-900 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">
                                                ${
                                                    review.user &&
                                                    !review.is_anonymous
                                                        ? (review.user
                                                              .first_name
                                                              ? review.user.first_name.charAt(
                                                                    0
                                                                )
                                                              : "U") +
                                                          (review.user.last_name
                                                              ? review.user.last_name.charAt(
                                                                    0
                                                                )
                                                              : "U")
                                                        : "AN"
                                                }
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                ${
                                                    review.user &&
                                                    !review.is_anonymous
                                                        ? `${
                                                              review.user
                                                                  .first_name ||
                                                              ""
                                                          } ${
                                                              review.user
                                                                  .last_name ||
                                                              ""
                                                          }`.trim() ||
                                                          "Anonymous User"
                                                        : "Anonymous User"
                                                }
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                ${generateStarRating(
                                                    review.rating
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        ${new Date(
                                            review.created_at
                                        ).toLocaleDateString()}
                                    </div>
                                </div>
                                ${
                                    review.review_text
                                        ? `<p class="text-gray-700">${review.review_text}</p>`
                                        : ""
                                }
                            </div>
                        `;
        });
    } else {
        reviewsHtml = `
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="text-lg mb-2">No reviews yet</p>
                            <p class="text-sm">Be the first to review this company!</p>
                        </div>
                    `;
    }

    container.innerHTML = summaryHtml + reviewsHtml;
}

function generateStarRating(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let stars = "";

    for (let i = 1; i <= 5; i++) {
        if (i <= fullStars) {
            stars += '<span class="text-yellow-400">★</span>';
        } else if (i === fullStars + 1 && hasHalfStar) {
            stars += '<span class="text-yellow-400">☆</span>';
        } else {
            stars += '<span class="text-gray-300">☆</span>';
        }
    }

    return stars;
}

function generateRatingDistribution(distribution, totalCount) {
    let html = "";
    for (let i = 5; i >= 1; i--) {
        const count = distribution[i] || 0;
        const percentage = totalCount > 0 ? (count / totalCount) * 100 : 0;
        html += `
                        <div class="flex items-center text-sm">
                            <span class="w-8 text-gray-600">${i}★</span>
                            <div class="flex-1 bg-gray-200 rounded-full h-2 mx-2">
                                <div class="bg-yellow-400 h-2 rounded-full" style="width: ${percentage}%"></div>
                            </div>
                            <span class="w-8 text-gray-600 text-right">${count}</span>
                        </div>
                    `;
    }
    return html;
}

function initializeStarRating() {
    const stars = document.querySelectorAll(".star");
    const ratingValue = document.getElementById("rating-value");
    const ratingText = document.getElementById("rating-text");

    if (!stars || stars.length === 0 || !ratingValue || !ratingText) return;

    const ratingLabels = {
        1: "Poor",
        2: "Fair",
        3: "Good",
        4: "Very Good",
        5: "Excellent",
    };

    stars.forEach((star) => {
        star.addEventListener("click", function () {
            const rating = parseInt(this.getAttribute("data-rating"));

            stars.forEach((s) => {
                const starRating = parseInt(s.getAttribute("data-rating"));
                if (starRating <= rating) {
                    s.textContent = "★";
                    s.classList.add("active");
                } else {
                    s.textContent = "☆";
                    s.classList.remove("active");
                }
            });

            ratingValue.value = rating;
            ratingText.textContent =
                rating +
                (rating === 1 ? " Star" : " Stars") +
                " - " +
                ratingLabels[rating];
        });

        star.addEventListener("mouseenter", function () {
            const rating = parseInt(this.getAttribute("data-rating"));
            stars.forEach((s) => {
                const starRating = parseInt(s.getAttribute("data-rating"));
                if (starRating <= rating) {
                    s.textContent = "★";
                    s.classList.add("text-yellow-400");
                } else {
                    s.textContent = "☆";
                    s.classList.remove("text-yellow-400");
                }
            });
        });

        star.addEventListener("mouseleave", function () {
            const currentRating = parseInt(ratingValue.value || "0", 10);
            stars.forEach((s) => {
                const starRating = parseInt(s.getAttribute("data-rating"));
                if (starRating <= currentRating) {
                    s.textContent = "★";
                    s.classList.add("active");
                } else {
                    s.textContent = "☆";
                    s.classList.remove("active");
                }
            });
        });
    });
}

function viewApplicant(userId) {
    window.open("/Applicants/" + userId, "_blank");
}

function updateApplicationStatus(applicantId, status) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to " + status + " this application?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: status === "approved" ? "#10B981" : "#EF4444",
        cancelButtonColor: "#6B7280",
        confirmButtonText: "Yes, " + status + " it!",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("/career/update-application-status", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                },
                body: JSON.stringify({
                    applicant_id: applicantId,
                    status: status,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Application " + status + " successfully!",
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text:
                                data.message ||
                                "Failed to update application status.",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "An error occurred while updating the application.",
                    });
                });
        }
    });
}

// Initialize after DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    initializeStarRating();

    // Try to detect companyId for loading reviews
    let companyId = document.getElementById("company-id")?.value;
    if (!companyId) {
        // Fallback: infer from submit button's onclick="submitReview({ID})"
        const btn = document.getElementById("submit-review-btn");
        const onClick = btn?.getAttribute("onclick") || "";
        const match = onClick.match(/submitReview\((\d+)\)/);
        companyId = match ? match[1] : null;
    }
    if (companyId) {
        loadReviews(companyId);
    }
});
// CSRF token setup
window.csrfToken =
    document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content") ||
    (window.Laravel && window.Laravel.csrfToken) ||
    "{{ csrf_token() }}";


function saveJob(careerId) {
    fetch("/career/save", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: JSON.stringify({ career_id: careerId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Job saved successfully!",
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: data.message || "Failed to save job.",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "An error occurred while saving the job.",
            });
        });
}

function applyNow(careerId) {
    fetch("/career/apply", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: JSON.stringify({ career_id: careerId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Application submitted successfully!",
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: data.message || "Failed to submit application.",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "An error occurred while submitting the application.",
            });
        });
}

// Reviews
function submitReview(companyId) {
    const ratingEl = document.getElementById("rating-value");
    const reviewEl = document.getElementById("review-text");
    const anonEl = document.getElementById("is-anonymous");

    if (!ratingEl) {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Rating input not found.",
        });
        return;
    }

    const rating = parseInt(ratingEl.value || "0", 10);
    const reviewText = reviewEl ? reviewEl.value : "";
    const isAnonymous = anonEl ? !!anonEl.checked : false;

    if (!rating || rating < 1 || rating > 5) {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Please select a rating.",
        });
        return;
    }

    const submitBtn = document.getElementById("submit-review-btn");
    const originalText = submitBtn ? submitBtn.textContent : null;
    if (submitBtn) {
        submitBtn.textContent = "Submitting...";
        submitBtn.disabled = true;
    }

    const formData = new FormData();
    formData.append("company_id", companyId);
    formData.append("rating", rating);
    formData.append("review_text", reviewText);
    formData.append("is_anonymous", isAnonymous ? "1" : "0");

    fetch("/company/review/store", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.csrfToken },
        body: formData,
    })
        .then((response) => {
            return response.json().then((data) => {
                if (!response.ok) {
                    throw new Error(
                        data.message || "Network response was not ok"
                    );
                }
                return data;
            });
        })
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Review submitted successfully!",
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    if (ratingEl) ratingEl.value = 5;
                    if (reviewEl) reviewEl.value = "";
                    if (anonEl) anonEl.checked = false;
                    initializeStarRating();
                    loadReviews(companyId);
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: data.message || "Failed to submit review.",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error!",
                text:
                    error.message ||
                    "An error occurred while submitting the review.",
            });
        })
        .finally(() => {
            if (submitBtn) {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
}

function loadReviews(companyId) {
    fetch("/company/" + companyId + "/reviews", {
        method: "GET",
        headers: { "X-CSRF-TOKEN": window.csrfToken },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) displayReviews(data);
            else console.error("Error loading reviews:", data.message);
        })
        .catch((error) => console.error("Error:", error));
}

function displayReviews(data) {
    const container = document.getElementById("reviews-container");
    if (!container) return;

    const reviews = data.reviews?.data || [];
    const averageRating = data.average_rating || 0;
    const reviewCount = data.review_count || 0;

    const summaryHtml = `
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-900">Overall Rating</h4>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-gray-900">${averageRating}</div>
                            <div class="flex items-center mt-1">
                                ${generateStarRating(averageRating)}
                                <span class="ml-2 text-sm text-gray-600">(${reviewCount} ${
        reviewCount === 1 ? "review" : "reviews"
    })</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-5 gap-2">
                        ${generateRatingDistribution(
                            data.rating_distribution || {},
                            reviewCount
                        )}
                    </div>
                </div>
            `;

    let reviewsHtml = "";
    if (reviews.length > 0) {
        reviews.forEach((review) => {
            reviewsHtml += `
                        <div class="border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-red-900 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">${
                                            review.user && !review.is_anonymous
                                                ? (review.user.first_name
                                                      ? review.user.first_name.charAt(
                                                            0
                                                        )
                                                      : "U") +
                                                  (review.user.last_name
                                                      ? review.user.last_name.charAt(
                                                            0
                                                        )
                                                      : "U")
                                                : "AN"
                                        }</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">${
                                            review.user && !review.is_anonymous
                                                ? `${
                                                      review.user.first_name ||
                                                      ""
                                                  } ${
                                                      review.user.last_name ||
                                                      ""
                                                  }`.trim() || "Anonymous User"
                                                : "Anonymous User"
                                        }</div>
                                        <div class="text-sm text-gray-600">
                                            ${generateStarRating(review.rating)}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    ${new Date(
                                        review.created_at
                                    ).toLocaleDateString()}
                                </div>
                            </div>
                            ${
                                review.review_text
                                    ? `<p class="text-gray-700">${review.review_text}</p>`
                                    : ""
                            }
                        </div>
                    `;
        });
    } else {
        reviewsHtml = `
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-lg mb-2">No reviews yet</p>
                        <p class="text-sm">Be the first to review this company!</p>
                    </div>
                `;
    }

    container.innerHTML = summaryHtml + reviewsHtml;
}

function generateStarRating(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let stars = "";

    for (let i = 1; i <= 5; i++) {
        if (i <= fullStars) {
            stars += '<span class="text-yellow-400">★</span>';
        } else if (i === fullStars + 1 && hasHalfStar) {
            stars += '<span class="text-yellow-400">☆</span>';
        } else {
            stars += '<span class="text-gray-300">☆</span>';
        }
    }
    return stars;
}

function generateRatingDistribution(distribution, totalCount) {
    let html = "";
    for (let i = 5; i >= 1; i--) {
        const count = distribution[i] || 0;
        const percentage = totalCount > 0 ? (count / totalCount) * 100 : 0;
        html += `
                    <div class="flex items-center text-sm">
                        <span class="w-8 text-gray-600">${i}★</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-2 mx-2">
                            <div class="bg-yellow-400 h-2 rounded-full" style="width: ${percentage}%"></div>
                        </div>
                        <span class="w-8 text-gray-600 text-right">${count}</span>
                    </div>
                `;
    }
    return html;
}

function viewApplicant(userId) {
    (window.location.href = "/Applicants/" + userId), "_blank";
}

function updateApplicationStatus(applicantId, status) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to " + status + " this application?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: status === "approved" ? "#10B981" : "#EF4444",
        cancelButtonColor: "#6B7280",
        confirmButtonText: "Yes, " + status + " it!",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("/career/update-application-status", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                },
                body: JSON.stringify({
                    applicant_id: applicantId,
                    status: status,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Application " + status + " successfully!",
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text:
                                data.message ||
                                "Failed to update application status.",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "An error occurred while updating the application.",
                    });
                });
        }
    });
}

// Initialize after DOM is ready
