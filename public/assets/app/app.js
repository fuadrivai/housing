$(document).ajaxStop($.unblockUI);
$(function () {
    const $sidebar = $("#sidebar");
    const $sidebarOverlay = $("#sidebarOverlay");
    const $mainContent = $("#mainContent");
    const $hamburgerBtn = $("#hamburgerBtn");
    const $sidebarToggleBtn = $("#sidebarToggleBtn");
    const $navItems = $(".sidebar-nav .nav-item");
    const $pageTitle = $("#pageTitle");
    const $body = $("body");

    const MOBILE_BREAKPOINT = 992;
    let isMobile = window.innerWidth < MOBILE_BREAKPOINT;
    let isSidebarCollapsed = false;
    let isMobileOpen = false;

    // ============ INITIALIZE LUCIDE ICONS ============
    if (typeof lucide !== "undefined") {
        lucide.createIcons();
    }

    // ============ LOAD PERSISTED STATE ============
    const savedCollapsed = localStorage.getItem("eduadmin_sidebar_collapsed");
    if (savedCollapsed === "true" && !isMobile) {
        isSidebarCollapsed = true;
        $sidebar.addClass("collapsed");
        $mainContent.addClass("expanded");
        updateToggleIcon();
    }

    $("#masterParent").on("click", function (e) {
        e.preventDefault();
        if (isMobile || !isSidebarCollapsed) {
            $(this).toggleClass("expanded");
            $("#masterSubmenu").toggleClass("expanded");
        }
    });

    $("#masterSubmenu .nav-item").on("click", function () {
        $("#masterParent").addClass("expanded");
        $("#masterSubmenu").addClass("expanded");
    });

    // ============ RESIZE HANDLER ============
    function handleResize() {
        const wasMobile = isMobile;
        isMobile = window.innerWidth < MOBILE_BREAKPOINT;

        if (wasMobile && !isMobile) {
            // Transitioned from mobile to desktop
            closeMobileSidebar();
            // Restore collapsed state
            if (isSidebarCollapsed) {
                $sidebar.addClass("collapsed");
                $mainContent.addClass("expanded");
            } else {
                $sidebar.removeClass("collapsed");
                $mainContent.removeClass("expanded");
            }
            updateToggleIcon();
        } else if (!wasMobile && isMobile) {
            // Transitioned from desktop to mobile
            $sidebar.removeClass("collapsed");
            $mainContent.removeClass("expanded");
            closeMobileSidebar();
        }
    }
    $(window).on("resize", $.debounce ? undefined : handleResize);
    // Simple debounce for resize
    let resizeTimeout;
    $(window).on("resize", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(handleResize, 150);
    });

    // ============ MOBILE SIDEBAR TOGGLE ============
    function openMobileSidebar() {
        if (!isMobile) return;
        isMobileOpen = true;
        $sidebar.addClass("mobile-open");
        $sidebarOverlay.addClass("active");
        $sidebarOverlay.attr("aria-hidden", "false");
        $hamburgerBtn.attr("aria-expanded", "true");
        $hamburgerBtn.attr("aria-label", "Close navigation menu");
        $body.css("overflow", "hidden");
        // Focus first nav item
        setTimeout(function () {
            $sidebar.find(".nav-item.active").focus();
        }, 300);
    }

    function closeMobileSidebar() {
        isMobileOpen = false;
        $sidebar.removeClass("mobile-open");
        $sidebarOverlay.removeClass("active");
        $sidebarOverlay.attr("aria-hidden", "true");
        $hamburgerBtn.attr("aria-expanded", "false");
        $hamburgerBtn.attr("aria-label", "Open navigation menu");
        $body.css("overflow", "");
    }

    function toggleMobileSidebar() {
        if (isMobileOpen) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    }

    $hamburgerBtn.on("click", function (e) {
        e.preventDefault();
        if (isMobile) {
            toggleMobileSidebar();
        } else {
            // Desktop: toggle collapse
            toggleSidebarCollapse();
        }
    });

    $sidebarOverlay.on("click", function () {
        if (isMobile && isMobileOpen) {
            closeMobileSidebar();
        }
    });

    // ============ DESKTOP SIDEBAR COLLAPSE ============
    function toggleSidebarCollapse() {
        isSidebarCollapsed = !isSidebarCollapsed;
        if (isSidebarCollapsed) {
            $sidebar.addClass("collapsed");
            $mainContent.addClass("expanded");
        } else {
            $sidebar.removeClass("collapsed");
            $mainContent.removeClass("expanded");
        }
        updateToggleIcon();
        localStorage.setItem(
            "eduadmin_sidebar_collapsed",
            isSidebarCollapsed.toString(),
        );

        // Re-render charts after transition
        setTimeout(function () {
            if (
                typeof houseRankingsChart !== "undefined" &&
                houseRankingsChart
            ) {
                houseRankingsChart.resize();
            }
            if (
                typeof pointsDistributionChart !== "undefined" &&
                pointsDistributionChart
            ) {
                pointsDistributionChart.resize();
            }
        }, 300);
    }

    function updateToggleIcon() {
        const $icon = $sidebarToggleBtn.find(".toggle-icon i");
        if ($icon.length && typeof lucide !== "undefined") {
            const newIcon = isSidebarCollapsed
                ? "chevron-right"
                : "chevron-left";
            $icon.attr("data-lucide", newIcon);
            lucide.createIcons({
                attr: "data-lucide",
            });
        }
    }

    $sidebarToggleBtn.on("click", function (e) {
        e.preventDefault();
        if (isMobile) {
            closeMobileSidebar();
        } else {
            toggleSidebarCollapse();
        }
    });

    // ============ KEYBOARD NAVIGATION ============
    $(document).on("keydown", function (e) {
        // Escape key closes mobile sidebar
        if (e.key === "Escape" && isMobile && isMobileOpen) {
            closeMobileSidebar();
            $hamburgerBtn.focus();
        }
    });

    // Trap focus within mobile sidebar when open
    $sidebar.on("keydown", function (e) {
        if (!isMobile || !isMobileOpen) return;
        if (e.key === "Tab") {
            const $focusable = $sidebar
                .find('a, button, [tabindex]:not([tabindex="-1"])')
                .filter(":visible");
            const first = $focusable.first();
            const last = $focusable.last();

            if (e.shiftKey && $(document.activeElement).is(first)) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && $(document.activeElement).is(last)) {
                e.preventDefault();
                first.focus();
            }
        }
    });

    // ============ INITIAL SETUP ============
    function initLayout() {
        isMobile = window.innerWidth < MOBILE_BREAKPOINT;
        if (isMobile) {
            $sidebar.removeClass("collapsed mobile-open");
            $mainContent.removeClass("expanded");
            $sidebarOverlay.removeClass("active").attr("aria-hidden", "true");
            $hamburgerBtn.attr("aria-expanded", "false");
            $body.css("overflow", "");
            isMobileOpen = false;
        } else {
            closeMobileSidebar();
            if (isSidebarCollapsed) {
                $sidebar.addClass("collapsed");
                $mainContent.addClass("expanded");
            } else {
                $sidebar.removeClass("collapsed");
                $mainContent.removeClass("expanded");
            }
            updateToggleIcon();
        }
    }

    initLayout();

    // ============ RENDER LUCIDE ICONS AGAIN AFTER DOM CHANGES ============
    setTimeout(function () {
        if (typeof lucide !== "undefined") {
            lucide.createIcons();
        }
    }, 100);
});

function ajaxRequest(options) {
    return new Promise((resolve, reject) => {
        let settings = {
            url: "",
            method: "POST",
            data: {},
            button: null,
            loadingText: "Processing...",
            buttonText: "Submit",
            contentType: null,
        };

        settings = $.extend({}, settings, options);

        const $button = settings.button ? $(settings.button) : null;
        let originalButtonText = "";

        if ($button) {
            originalButtonText = $button.html();

            $button.prop("disabled", true).html(`
                <span class="spinner-border spinner-border-sm"></span>
                ${settings.loadingText}
            `);
        }

        $.ajax({
            url: settings.url,
            type: settings.method,
            data: settings.data,

            processData:
                settings.data instanceof FormData
                    ? false
                    : settings.contentType === "application/json"
                      ? false
                      : true,

            contentType:
                settings.data instanceof FormData
                    ? false
                    : (settings.contentType ??
                      "application/x-www-form-urlencoded; charset=UTF-8"),

            cache: false,

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },

            success: function (response) {
                resolve(response);
            },

            error: function (xhr) {
                let message = "Something went wrong";

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    message = Object.values(xhr.responseJSON.errors)
                        .map((e) => e[0])
                        .join("<br>");
                } else if (xhr.responseJSON?.message) {
                    message = xhr.responseJSON.message;
                }

                reject({
                    xhr,
                    message,
                });
            },

            complete: function () {
                if ($button) {
                    $button.prop("disabled", false).html(originalButtonText);

                    if (typeof lucide !== "undefined") {
                        lucide.createIcons();
                    }
                }
            },
        });
    });
}

function blockUI(message = null) {
    $.blockUI({
        message:
            message ??
            '<label><i class="fa fa-spinner fa-spin"></i> Just a moment...</label>',
    });
}

function unBlockUI() {
    $.unblockUI();
}
