// Progress bar functionality
function startProgressBar() {
    var bar = document.getElementById("pageProgressBar");
    if (!bar) return;
    bar.style.width = "0";
    bar.style.display = "block";
    setTimeout(function () {
        bar.style.width = "60%";
    }, 50);
}

function finishProgressBar() {
    var bar = document.getElementById("pageProgressBar");
    if (!bar) return;
    bar.style.width = "100%";
    setTimeout(function () {
        bar.style.display = "none";
        bar.style.width = "0";
    }, 400);
}

// Mobile filter functionality
document.addEventListener("DOMContentLoaded", function () {
    const mobileFilterBtn = document.getElementById("mobileFilterBtn");
    const mobileFilterOverlay = document.getElementById("mobileFilterOverlay");
    const mobileFilterSidebar = document.getElementById("mobileFilterSidebar");
    const closeMobileFilter = document.getElementById("closeMobileFilter");

    function openMobileFilter() {
        mobileFilterOverlay.classList.add("show");
        mobileFilterSidebar.classList.add("show");
        document.body.style.overflow = "hidden";
    }

    function closeMobileFilterFunc() {
        mobileFilterOverlay.classList.remove("show");
        mobileFilterSidebar.classList.remove("show");
        document.body.style.overflow = "";
    }

    if (mobileFilterBtn) {
        mobileFilterBtn.addEventListener("click", openMobileFilter);
    }

    if (closeMobileFilter) {
        closeMobileFilter.addEventListener("click", closeMobileFilterFunc);
    }

    if (mobileFilterOverlay) {
        mobileFilterOverlay.addEventListener("click", closeMobileFilterFunc);
    }

    // Sync mobile filters with desktop filters
    const mobileForm = document.getElementById("mobileFilterForm");
    if (mobileForm) {
        mobileForm.addEventListener("submit", function (e) {
            e.preventDefault();
            closeMobileFilterFunc();

            // Copy mobile filter values to desktop form
            const desktopForm = document.getElementById("filterForm");
            const mobileCheckboxes = mobileForm.querySelectorAll(
                ".mobile-filter-checkbox"
            );

            // Clear desktop filters first
            desktopForm
                .querySelectorAll(".filter-checkbox")
                .forEach((cb) => (cb.checked = false));

            // Apply mobile selections to desktop
            mobileCheckboxes.forEach((mobileCb) => {
                if (mobileCb.checked) {
                    const name = mobileCb.name;
                    const value = mobileCb.value;
                    const desktopCb = desktopForm.querySelector(
                        `input[name="${name}"][value="${value}"]`
                    );
                    if (desktopCb) {
                        desktopCb.checked = true;
                    }
                }
            });

            // Trigger desktop form submission
            desktopForm.dispatchEvent(new Event("submit"));
        });
    }

    finishProgressBar();

    // AJAX update function
    function ajaxUpdate(url, formData) {
        const productsGrid = document.getElementById("productsGrid");
        const productsLoading = document.getElementById("productsLoading");
        startProgressBar();
        productsGrid.style.display = "none";
        productsLoading.style.display = "block";

        // ✅ Convert to fully qualified URL with current HTTPS origin
        let fullUrl;
        try {
            const baseUrl = new URL(url, window.location.origin);
            fullUrl = baseUrl.href + (formData ? "?" + formData : "");
        } catch (e) {
            console.error("Invalid URL passed to ajaxUpdate", url);
            fullUrl = window.location.href;
        }

        fetch(fullUrl, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "text/html",
            },
            credentials: "same-origin",
            cache: "no-store",
        })
            .then((response) => {
                if (!response.ok) throw new Error("Network error");
                return response.text();
            })
            .then((html) => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const newGrid = doc.getElementById("productsGrid");
                const newCount = doc.getElementById("productsCount");

                if (newGrid) productsGrid.innerHTML = newGrid.innerHTML;
                if (newCount)
                    document.getElementById("productsCount").innerHTML =
                        newCount.innerHTML;

                productsGrid.style.display = "";
                productsLoading.style.display = "none";
                finishProgressBar();
                window.convertUnits && convertUnits();

                if (window.history && window.history.pushState) {
                    window.history.pushState({}, "", fullUrl);
                }

                window.afterAjaxUpdate && afterAjaxUpdate();
            })
            .catch(() => {
                productsGrid.style.display = "";
                productsLoading.style.display = "none";
                finishProgressBar();
            });
    }

    // Unit toggle functionality
    const siBtn = document.getElementById("siBtn");
    const imperialBtn = document.getElementById("imperialBtn");
    const unitInput = document.getElementById("unitInput");

    if (siBtn) {
        siBtn.addEventListener("click", function () {
            unitInput.value = "si";
            siBtn.classList.add("active");
            imperialBtn.classList.remove("active");
            convertUnits();
        });
    }

    if (imperialBtn) {
        imperialBtn.addEventListener("click", function () {
            unitInput.value = "imperial";
            imperialBtn.classList.add("active");
            siBtn.classList.remove("active");
            convertUnits();
        });
    }

    // Filter form logic
    const filterForm = document.getElementById("filterForm");
    const checkboxes = filterForm?.querySelectorAll(".filter-checkbox") || [];
    const mainSearchForm = document.getElementById("mainSearchForm");
    const searchInput = document.getElementById("search");
    let debounceTimeout = null;

    // Debounced AJAX for filter checkboxes
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function (e) {
            e.preventDefault();
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                if (filterForm) {
                    const formData = new FormData(filterForm);
                    const params = new URLSearchParams();
                    for (const [key, value] of formData) {
                        params.append(key, value);
                    }
                    ajaxUpdate(filterForm.action, params.toString());
                }
            }, 250);
        });
    });

    // Search form AJAX
    if (mainSearchForm) {
        mainSearchForm.addEventListener("submit", function (e) {
            e.preventDefault();
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                const formData = new FormData(mainSearchForm);
                const filterData = new FormData(filterForm);
                for (const pair of filterData.entries()) {
                    if (!formData.has(pair[0])) {
                        formData.append(pair[0], pair[1]);
                    }
                }
                const params = new URLSearchParams();
                for (const pair of formData.entries()) {
                    params.append(pair[0], pair[1]);
                }
                ajaxUpdate(mainSearchForm.action, params.toString());
            }, 200);
        });
    }

    if (searchInput) {
        searchInput.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                mainSearchForm.dispatchEvent(new Event("submit"));
            }
        });
    }

    // Unit conversion
    function convertUnits() {
        const isImperial = document
            .getElementById("imperialBtn")
            ?.classList.contains("active");

        document
            .querySelectorAll(".unit-operating-weight")
            .forEach(function (el) {
                const lb = parseFloat(el.dataset.lb);
                if (!isNaN(lb)) {
                    el.textContent = isImperial
                        ? lb.toFixed(1) + " lb"
                        : (lb * 0.453592).toFixed(1) + " kg";
                } else {
                    el.textContent = isImperial ? "- lb" : "- kg";
                }
            });

        document.querySelectorAll(".unit-oil-flow").forEach(function (el) {
            const galmin = el.dataset.galmin?.split("~") || [];
            if (galmin.length === 2) {
                const min = parseFloat(galmin[0]);
                const max = parseFloat(galmin[1]);
                if (!isNaN(min) && !isNaN(max)) {
                    el.textContent = isImperial
                        ? min.toFixed(1) + "~" + max.toFixed(1) + " gal/min"
                        : (min * 3.78541).toFixed(1) +
                          "~" +
                          (max * 3.78541).toFixed(1) +
                          " l/min";
                } else {
                    el.textContent = isImperial ? "- gal/min" : "- l/min";
                }
            } else if (galmin.length === 1) {
                const val = parseFloat(galmin[0]);
                if (!isNaN(val)) {
                    el.textContent = isImperial
                        ? val.toFixed(1) + " gal/min"
                        : (val * 3.78541).toFixed(1) + " l/min";
                } else {
                    el.textContent = isImperial ? "- gal/min" : "- l/min";
                }
            }
        });

        document.querySelectorAll(".unit-carrier").forEach(function (el) {
            const lb = el.dataset.lb?.split("~") || [];
            if (lb.length === 2) {
                const min = parseFloat(lb[0]);
                const max = parseFloat(lb[1]);
                if (!isNaN(min) && !isNaN(max)) {
                    el.textContent = isImperial
                        ? min.toLocaleString(undefined, {
                              maximumFractionDigits: 1,
                          }) +
                          "~" +
                          max.toLocaleString(undefined, {
                              maximumFractionDigits: 1,
                          }) +
                          " lb"
                        : (min * 0.000453592).toFixed(1) +
                          "~" +
                          (max * 0.000453592).toFixed(1) +
                          " ton";
                } else {
                    el.textContent = isImperial ? "- lb" : "- ton";
                }
            } else if (lb.length === 1) {
                const val = parseFloat(lb[0]);
                if (!isNaN(val)) {
                    el.textContent = isImperial
                        ? val.toLocaleString(undefined, {
                              maximumFractionDigits: 1,
                          }) + " lb"
                        : (val * 0.000453592).toFixed(1) + " ton";
                } else {
                    el.textContent = isImperial ? "- lb" : "- ton";
                }
            }
        });
    }

    // Initialize unit conversion
    convertUnits();

    // Set initial unit state
    const currentUnit = "{{ $unit }}";
    if (currentUnit === "imperial") {
        imperialBtn?.classList.add("active");
        siBtn?.classList.remove("active");
    } else {
        siBtn?.classList.add("active");
        imperialBtn?.classList.remove("active");
    }

    // Filter reset functionality
    const resetFiltersBtn = document.getElementById("resetFiltersBtn");
    const resetMobileFiltersBtn = document.getElementById(
        "resetMobileFiltersBtn"
    );

    function resetFilters() {
        filterForm?.querySelectorAll(".filter-checkbox").forEach((cb) => {
            cb.checked = false;
        });
        mobileForm
            ?.querySelectorAll(".mobile-filter-checkbox")
            .forEach((cb) => {
                cb.checked = false;
            });

        const params = new URLSearchParams();
        params.append("unit", unitInput?.value || "imperial");
        if (filterForm) {
            ajaxUpdate(filterForm.action, params.toString());
        }
    }

    resetFiltersBtn?.addEventListener("click", function (e) {
        e.preventDefault();
        resetFilters();
    });

    resetMobileFiltersBtn?.addEventListener("click", function (e) {
        e.preventDefault();
        resetFilters();
    });

    // Filter category toggle
    document.querySelectorAll(".filter-category-header").forEach((header) => {
        header.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const options = document.querySelector(targetId);
            const isExpanded = this.classList.contains("expanded");

            this.classList.toggle("expanded", !isExpanded);
            this.classList.toggle("collapsed", isExpanded);

            // Update chevron direction (up for expanded, down for collapsed)
            const chevron = this.querySelector(".filter-arrow i");
            if (chevron) {
                chevron.classList.toggle("fa-chevron-up", !isExpanded);
                chevron.classList.toggle("fa-chevron-down", isExpanded);
            }

            if (options) {
                options.classList.toggle("collapsed", isExpanded);
                options.classList.toggle("expanded", !isExpanded);
            }
        });
    });

    // Initialize filter categories as expanded
    function expandAllFilterCategories() {
        document
            .querySelectorAll(".filter-category-header")
            .forEach((header) => {
                header.classList.add("expanded");
                header.classList.remove("collapsed");
            });
        document.querySelectorAll(".filter-options").forEach((options) => {
            options.classList.add("expanded");
            options.classList.remove("collapsed");
        });
    }

    expandAllFilterCategories();

    // Sort functionality
    document.querySelectorAll(".sort-option").forEach(function (option) {
        option.addEventListener("click", function (e) {
            e.preventDefault();
            const sortValue = this.dataset.sort;
            const sortInput = document.getElementById("sortInput");
            if (sortInput) {
                sortInput.value = sortValue;
            }

            // Update label
            const sortLabel = document.getElementById("sortLabel");
            const sortTranslations = {
                sort_default: "{{ __('common.sort_default') }}",
                sort_none: "{{ __('common.sort_none') }}",
                sort_carrier_desc: "{{ __('common.sort_carrier_desc') }}",
                sort_carrier_asc: "{{ __('common.sort_carrier_asc') }}",
                sort_weight_desc: "{{ __('common.sort_weight_desc') }}",
                sort_weight_asc: "{{ __('common.sort_weight_asc') }}",
            };
            let labelText = sortTranslations["sort_default"];
            switch (sortValue) {
                case "carrier-desc":
                    labelText = sortTranslations["sort_carrier_desc"];
                    break;
                case "carrier-asc":
                    labelText = sortTranslations["sort_carrier_asc"];
                    break;
                case "weight-desc":
                    labelText = sortTranslations["sort_weight_desc"];
                    break;
                case "weight-asc":
                    labelText = sortTranslations["sort_weight_asc"];
                    break;
                case "none":
                    labelText = sortTranslations["sort_none"];
                    break;
                default:
                    labelText = sortTranslations["sort_default"];
                    break;
            }
            if (sortLabel) sortLabel.textContent = labelText;

            // Update active state
            document
                .querySelectorAll(".sort-option")
                .forEach((opt) => opt.classList.remove("active"));
            this.classList.add("active");

            // Trigger form submission
            if (filterForm) {
                const filterFormData = new FormData(filterForm);
                const searchFormData = new FormData(mainSearchForm);

                for (const [key, value] of searchFormData.entries()) {
                    if (!filterFormData.has(key)) {
                        filterFormData.append(key, value);
                    }
                }

                filterFormData.set("sort", sortValue);

                const params = new URLSearchParams();
                for (const pair of filterFormData.entries()) {
                    params.append(pair[0], pair[1]);
                }

                const urlBase = filterForm.action;
                const newUrl =
                    urlBase +
                    (params.toString() ? "?" + params.toString() : "");
                window.location = newUrl;
            }
        });
    });

    // Copy link functionality
    const copyButtons = document.querySelectorAll(".copy-link-btn");
    const copyToast = document.getElementById("copyToast");

    copyButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const url = this.getAttribute("data-url");
            navigator.clipboard
                .writeText(url)
                .then(() => {
                    copyToast?.classList.add("active");
                    setTimeout(() => {
                        copyToast?.classList.remove("active");
                    }, 2000);
                })
                .catch((err) => {
                    console.error("Copy failed:", err);
                });
        });
    });

    // After AJAX update function
    function afterAjaxUpdate() {
        expandAllFilterCategories();
        convertUnits();

        // Re-attach copy link event listeners
        document.querySelectorAll(".copy-link-btn").forEach((btn) => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();

                const url = this.getAttribute("data-url");
                navigator.clipboard.writeText(url).then(() => {
                    copyToast?.classList.add("active");
                    setTimeout(() => {
                        copyToast?.classList.remove("active");
                    }, 2000);
                });
            });
        });
    }

    // Expose functions globally for reuse
    window.ajaxUpdate = ajaxUpdate;
    window.convertUnits = convertUnits;
    window.afterAjaxUpdate = afterAjaxUpdate;
});
