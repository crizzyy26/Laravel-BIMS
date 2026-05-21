<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            border: "#dbeafe",
            ring: "#2563eb",
            background: "#ffffff",
            foreground: "#172554"
          },
          boxShadow: {
            soft: "0 18px 55px rgba(37, 99, 235, 0.13)"
          }
        }
      }
    };
  </script>
  <style>
    body {
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .modal-open {
      overflow: hidden;
    }

    #sidebar,
    #pageMain {
      transition: all 0.25s ease;
    }

    #sidebar {
      transform: translateX(-100%);
    }

    body.sidebar-open #sidebar {
      transform: translateX(0);
    }

    @media (min-width: 1024px) {
      #sidebar {
        transform: translateX(0);
      }

      #pageMain {
        margin-left: 16rem;
      }

      body.sidebar-closed #sidebar {
        transform: translateX(-100%);
      }

      body.sidebar-closed #pageMain {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="min-h-screen bg-blue-50/60 text-slate-900">
  <button id="sidebarToggle" type="button" class="fixed right-4 top-4 z-50 flex h-11 w-11 items-center justify-center rounded-xl border border-blue-100 bg-white text-blue-700 shadow-sm hover:bg-gray-100" aria-label="Toggle sidebar">
    <i data-lucide="menu" class="h-5 w-5"></i>
  </button>
  <div id="sidebarBackdrop" class="fixed inset-0 z-30 hidden bg-blue-950/30 lg:hidden"></div>

  <div class="flex min-h-screen">
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-white px-4 py-5 shadow-sm">
      <div class="mb-7 border-b border-blue-100 pb-5">
        <h1 class="pr-10 text-base font-bold leading-snug text-blue-950">Barangay Information Management System</h1>
      </div>

      <nav class="space-y-1.5">
        <a href="dashboard.html" class="flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-sm font-semibold text-blue-800">
          <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
          Dashboard
        </a>
        <a href="resident-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900">
          <i data-lucide="users-round" class="h-4 w-4"></i>
          Resident Management
        </a>
        <a href="blotter-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900">
          <i data-lucide="file-warning" class="h-4 w-4"></i>
          Blotter Management
        </a>
        <a href="event-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900">
          <i data-lucide="calendar-days" class="h-4 w-4"></i>
          Event Management
        </a>
        <a href="certificate-document-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900">
          <i data-lucide="file-check-2" class="h-4 w-4"></i>
          Certificate & Document Management
        </a>
        <a href="officials-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900">
          <i data-lucide="landmark" class="h-4 w-4"></i>
          Officials Management
        </a>
        <a href="logs-history.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900">
          <i data-lucide="history" class="h-4 w-4"></i>
          Logs History
        </a>
      </nav>

      <div class="mt-auto rounded-xl border border-blue-100 bg-white p-3">
        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-blue-700">Admin Name</p>
        <p id="adminName" class="mt-1 text-sm font-semibold text-blue-950">admin</p>
        <button id="logoutButton" type="button" class="mt-3 flex h-10 w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white hover:bg-gray-700">
          <i data-lucide="log-out" class="h-4 w-4"></i>
          Logout
        </button>
      </div>
    </aside>

    <main id="pageMain" class="min-h-screen flex-1 bg-white">
      <section class="min-h-screen bg-white p-6 pt-20 sm:p-8 lg:pt-8">
        <div class="flex flex-col gap-4 border-b border-blue-100 pb-6 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-700">Dashboard</p>
            <h2 class="mt-2 text-2xl font-bold text-blue-950">System Overview</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Quick look at barangay records, requests, reports, schedules, and officials.</p>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-blue-50 px-5 py-4">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Signed in as</p>
            <p id="dashboardUser" class="mt-1 text-sm font-bold text-blue-950">admin</p>
          </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
            <div class="flex items-center justify-between gap-4">
              <p class="text-sm font-medium text-slate-600">Residents</p>
              <i data-lucide="users-round" class="h-5 w-5 text-blue-700"></i>
            </div>
            <h3 id="residentCount" class="mt-3 text-3xl font-bold text-blue-950">0</h3>
            <p id="residentMeta" class="mt-2 text-sm text-slate-600">0 archived</p>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <div class="flex items-center justify-between gap-4">
              <p class="text-sm font-medium text-slate-600">Open Blotters</p>
              <i data-lucide="file-warning" class="h-5 w-5 text-amber-600"></i>
            </div>
            <h3 id="openBlotterCount" class="mt-3 text-3xl font-bold text-blue-950">0</h3>
            <p id="blotterMeta" class="mt-2 text-sm text-slate-600">0 total reports</p>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <div class="flex items-center justify-between gap-4">
              <p class="text-sm font-medium text-slate-600">Pending Documents</p>
              <i data-lucide="file-check-2" class="h-5 w-5 text-blue-700"></i>
            </div>
            <h3 id="pendingDocumentCount" class="mt-3 text-3xl font-bold text-blue-950">0</h3>
            <p id="documentMeta" class="mt-2 text-sm text-slate-600">0 total requests</p>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <div class="flex items-center justify-between gap-4">
              <p class="text-sm font-medium text-slate-600">Upcoming Events</p>
              <i data-lucide="calendar-days" class="h-5 w-5 text-emerald-600"></i>
            </div>
            <h3 id="upcomingEventCount" class="mt-3 text-3xl font-bold text-blue-950">0</h3>
            <p id="eventMeta" class="mt-2 text-sm text-slate-600">0 total events</p>
          </div>
        </div>

        <div class="mt-6 grid gap-4 xl:grid-cols-[1.15fr_0.85fr]">
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <div class="flex items-center justify-between gap-4 border-b border-blue-100 pb-4">
              <div>
                <p class="text-sm font-semibold text-blue-950">Subsystem Quick Look</p>
                <p class="mt-1 text-sm text-slate-600">Main records by module</p>
              </div>
            </div>
            <div id="moduleGrid" class="mt-5 grid gap-3 md:grid-cols-2"></div>
          </div>

          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <div class="border-b border-blue-100 pb-4">
              <p class="text-sm font-semibold text-blue-950">Recent Records</p>
              <p class="mt-1 text-sm text-slate-600">Latest saved activity</p>
            </div>
            <div id="recentList" class="mt-5 space-y-3"></div>
          </div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-5">
          <p class="text-sm font-semibold text-blue-950">Daily flow</p>
          <p class="mt-2 text-sm leading-6 text-slate-600">Start by checking pending requests and open blotter cases, then review new residents, events, and official records as needed.</p>
        </div>
      </section>
    </main>
  </div>

  <div id="modalBackdrop" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="w-full max-w-md rounded-3xl border border-blue-100 bg-white p-6 shadow-2xl">
      <div id="modalIcon" class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
        <i data-lucide="circle-help" class="h-6 w-6"></i>
      </div>
      <h2 id="modalTitle" class="text-xl font-bold text-blue-950">Confirm action</h2>
      <p id="modalMessage" class="mt-3 text-sm leading-6 text-slate-600">Please confirm before continuing.</p>

      <div id="confirmActions" class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
        <button id="cancelModal" type="button" class="h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">
          Cancel
        </button>
        <button id="proceedModal" type="button" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">
          Proceed
        </button>
      </div>

      <div id="successActions" class="mt-7 hidden">
        <button id="closeSuccess" type="button" class="h-11 w-full rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">
          Done
        </button>
      </div>
    </div>
  </div>

  <script>
    const adminName = document.getElementById("adminName");
    const logoutButton = document.getElementById("logoutButton");
    const modalBackdrop = document.getElementById("modalBackdrop");
    const modalIcon = document.getElementById("modalIcon");
    const modalTitle = document.getElementById("modalTitle");
    const modalMessage = document.getElementById("modalMessage");
    const confirmActions = document.getElementById("confirmActions");
    const successActions = document.getElementById("successActions");
    const cancelModal = document.getElementById("cancelModal");
    const proceedModal = document.getElementById("proceedModal");
    const closeSuccess = document.getElementById("closeSuccess");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarBackdrop = document.getElementById("sidebarBackdrop");
    const dashboardUser = document.getElementById("dashboardUser");

    let pendingAction = "";
    let successRedirect = "";

    adminName.textContent = localStorage.getItem("bimsUser") || "admin";
    dashboardUser.textContent = localStorage.getItem("bimsUser") || "admin";

    const getRecords = (key) => JSON.parse(localStorage.getItem(key) || "[]");
    const formatDate = (value) => value ? new Date(value.includes("T") ? value : `${value}T00:00:00`).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" }) : "N/A";
    const sortByLatest = (items, dateKey) => [...items].sort((a, b) => new Date(b[dateKey] || b.createdAt || b.updatedAt || 0) - new Date(a[dateKey] || a.createdAt || a.updatedAt || 0));

    function renderDashboard() {
      const residents = getRecords("bimsResidents");
      const blotters = getRecords("bimsBlotters");
      const events = getRecords("bimsEvents");
      const documents = getRecords("bimsDocuments");
      const officials = getRecords("bimsOfficials");

      const activeResidents = residents.filter((item) => item.status === "Active");
      const openBlotters = blotters.filter((item) => item.status === "Pending" || item.status === "In Progress");
      const pendingDocuments = documents.filter((item) => item.status === "Pending");
      const upcomingEvents = events.filter((item) => item.status === "Scheduled");

      document.getElementById("residentCount").textContent = activeResidents.length;
      document.getElementById("residentMeta").textContent = `${residents.filter((item) => item.status === "Archived").length} archived`;
      document.getElementById("openBlotterCount").textContent = openBlotters.length;
      document.getElementById("blotterMeta").textContent = `${blotters.length} total reports`;
      document.getElementById("pendingDocumentCount").textContent = pendingDocuments.length;
      document.getElementById("documentMeta").textContent = `${documents.length} total requests`;
      document.getElementById("upcomingEventCount").textContent = upcomingEvents.length;
      document.getElementById("eventMeta").textContent = `${events.length} total events`;

      const modules = [
        { label: "Resident Management", href: "resident-management.html", icon: "users-round", count: activeResidents.length, meta: "active residents" },
        { label: "Blotter Management", href: "blotter-management.html", icon: "file-warning", count: openBlotters.length, meta: "open cases" },
        { label: "Event Management", href: "event-management.html", icon: "calendar-days", count: upcomingEvents.length, meta: "upcoming events" },
        { label: "Certificate & Document", href: "certificate-document-management.html", icon: "file-check-2", count: pendingDocuments.length, meta: "pending requests" },
        { label: "Officials Management", href: "officials-management.html", icon: "landmark", count: officials.filter((item) => item.status === "Active").length, meta: "active officials" }
      ];

      document.getElementById("moduleGrid").innerHTML = modules.map((item) => `
        <a href="${item.href}" class="rounded-2xl border border-blue-100 bg-white p-4 hover:bg-gray-100">
          <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700"><i data-lucide="${item.icon}" class="h-5 w-5"></i></span>
              <div>
                <p class="text-sm font-semibold text-blue-950">${item.label}</p>
                <p class="text-xs text-slate-500">${item.meta}</p>
              </div>
            </div>
            <span class="text-xl font-bold text-blue-950">${item.count}</span>
          </div>
        </a>
      `).join("");

      const recent = [
        ...sortByLatest(residents, "createdAt").slice(0, 2).map((item) => ({ type: "Resident", title: [item.firstName, item.lastName].filter(Boolean).join(" "), date: item.createdAt })),
        ...sortByLatest(blotters, "incidentDate").slice(0, 2).map((item) => ({ type: "Blotter", title: item.incidentType, date: item.incidentDate })),
        ...sortByLatest(documents, "requestDate").slice(0, 2).map((item) => ({ type: "Document", title: item.documentType, date: item.requestDate })),
        ...sortByLatest(events, "date").slice(0, 2).map((item) => ({ type: "Event", title: item.title, date: item.date }))
      ].sort((a, b) => new Date(b.date || 0) - new Date(a.date || 0)).slice(0, 6);

      document.getElementById("recentList").innerHTML = recent.length ? recent.map((item) => `
        <div class="rounded-xl border border-blue-100 bg-white p-4">
          <div class="flex items-center justify-between gap-4">
            <div>
              <p class="text-sm font-semibold text-blue-950">${item.title || "Untitled"}</p>
              <p class="mt-1 text-xs text-slate-500">${item.type}</p>
            </div>
            <p class="text-xs font-medium text-slate-500">${formatDate(item.date)}</p>
          </div>
        </div>
      `).join("") : '<div class="rounded-xl border border-blue-100 bg-blue-50 p-4 text-sm text-slate-600">No recent records yet.</div>';

      refreshIcons();
    }

    function toggleSidebar() {
      if (window.matchMedia("(min-width: 1024px)").matches) {
        document.body.classList.toggle("sidebar-closed");
        return;
      }

      document.body.classList.toggle("sidebar-open");
      sidebarBackdrop.classList.toggle("hidden", !document.body.classList.contains("sidebar-open"));
    }

    sidebarToggle.addEventListener("click", toggleSidebar);
    sidebarBackdrop.addEventListener("click", () => {
      document.body.classList.remove("sidebar-open");
      sidebarBackdrop.classList.add("hidden");
    });

    function refreshIcons() {
      lucide.createIcons();
    }

    function openModal(type, title, message) {
      const isSuccess = type === "success";
      modalIcon.innerHTML = isSuccess
        ? '<i data-lucide="circle-check" class="h-6 w-6"></i>'
        : '<i data-lucide="circle-help" class="h-6 w-6"></i>';

      modalIcon.className = isSuccess
        ? "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white"
        : "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700";

      modalTitle.textContent = title;
      modalMessage.textContent = message;
      confirmActions.classList.toggle("hidden", type !== "confirm");
      successActions.classList.toggle("hidden", type === "confirm");
      modalBackdrop.classList.remove("hidden");
      modalBackdrop.classList.add("flex");
      document.body.classList.add("modal-open");
      refreshIcons();
    }

    function closeModal() {
      modalBackdrop.classList.add("hidden");
      modalBackdrop.classList.remove("flex");
      document.body.classList.remove("modal-open");
      pendingAction = "";
      successRedirect = "";
    }

    logoutButton.addEventListener("click", () => {
      pendingAction = "logout";
      openModal("confirm", "Confirm logout", "Proceed with logout?");
    });

    proceedModal.addEventListener("click", () => {
      if (pendingAction === "logout") {
        localStorage.removeItem("bimsUser");
        window.location.href = "index.html";
        return;
      }
    });

    cancelModal.addEventListener("click", closeModal);
    closeSuccess.addEventListener("click", () => {
      if (successRedirect) {
        window.location.href = successRedirect;
        return;
      }

      closeModal();
    });

    refreshIcons();
    renderDashboard();
  </script>
</body>
</html>
