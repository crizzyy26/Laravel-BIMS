<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blotter Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { border: "#dbeafe", ring: "#2563eb" },
          boxShadow: { soft: "0 18px 55px rgba(37, 99, 235, 0.13)" }
        }
      }
    };
  </script>
  <style>
    body { font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
    .modal-open { overflow: hidden; }
    #sidebar, #pageMain { transition: all 0.25s ease; }
    #sidebar { transform: translateX(-100%); }
    body.sidebar-open #sidebar { transform: translateX(0); }
    @media (min-width: 1024px) {
      #sidebar { transform: translateX(0); }
      #pageMain { margin-left: 16rem; }
      body.sidebar-closed #sidebar { transform: translateX(-100%); }
      body.sidebar-closed #pageMain { margin-left: 0; }
    }
  </style>
</head>
<body class="min-h-screen bg-blue-50/60 text-slate-900">
  <button id="sidebarToggle" type="button" class="fixed right-4 top-4 z-50 flex h-11 w-11 items-center justify-center rounded-xl border border-blue-100 bg-white text-blue-700 shadow-sm hover:bg-gray-100" aria-label="Toggle sidebar">
    <i data-lucide="menu" class="h-5 w-5"></i>
  </button>
  <div id="sidebarBackdrop" class="fixed inset-0 z-30 hidden bg-blue-950/30 lg:hidden"></div>

  <div class="flex min-h-screen">
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-blue-100 bg-white px-4 py-5 shadow-sm">
      <div class="mb-7 border-b border-blue-100 pb-5">
        <h1 class="pr-10 text-base font-bold leading-snug text-blue-950">Barangay Information Management System</h1>
      </div>

      <nav class="space-y-1.5">
        <a href="dashboard.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="layout-dashboard" class="h-4 w-4"></i>Dashboard</a>
        <a href="resident-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="users-round" class="h-4 w-4"></i>Resident Management</a>
        <a href="blotter-management.html" class="flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-sm font-semibold text-blue-800"><i data-lucide="file-warning" class="h-4 w-4"></i>Blotter Management</a>
        <a href="event-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="calendar-days" class="h-4 w-4"></i>Event Management</a>
        <a href="certificate-document-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="file-check-2" class="h-4 w-4"></i>Certificate & Document Management</a>
        <a href="officials-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="landmark" class="h-4 w-4"></i>Officials Management</a>
        <a href="logs-history.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="history" class="h-4 w-4"></i>Logs History</a>
      </nav>

      <div class="mt-auto rounded-xl border border-blue-100 bg-white p-3">
        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-blue-700">Admin Name</p>
        <p id="adminName" class="mt-1 text-sm font-semibold text-blue-950">admin</p>
        <button id="logoutButton" type="button" class="mt-3 flex h-10 w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white hover:bg-gray-700"><i data-lucide="log-out" class="h-4 w-4"></i>Logout</button>
      </div>
    </aside>

    <main id="pageMain" class="min-h-screen flex-1 bg-white">
      <section class="min-h-screen border-l border-blue-100 bg-white p-6 pt-20 sm:p-8 lg:pt-8">
        <div class="flex flex-col gap-4 border-b border-blue-100 pb-6 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-700">Blotter Management</p>
            <h2 class="mt-2 text-2xl font-bold text-blue-950">Blotter Reports</h2>
          </div>
          <div class="flex flex-col gap-3 sm:flex-row">
            <button id="addBlotterButton" type="button" class="flex h-11 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-gray-700">
              <i data-lucide="plus" class="h-4 w-4"></i>
              Add Blotter
            </button>
          </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
            <p class="text-sm font-medium text-slate-600">Total Reports</p>
            <h3 id="totalReports" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <p class="text-sm font-medium text-slate-600">Open Cases</p>
            <h3 id="openCases" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <p class="text-sm font-medium text-slate-600">Resolved</p>
            <h3 id="resolvedCases" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <p class="text-sm font-medium text-slate-600">Archived</p>
            <h3 id="archivedCases" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-5">
          <p class="text-sm font-semibold text-blue-950">Simple workflow</p>
          <p class="mt-2 text-sm text-slate-600">Record the complaint, review case details, update progress, mark resolved when settled, then archive or delete records when needed.</p>
        </div>

        <div class="mt-6 grid gap-3 lg:grid-cols-[1fr_220px_220px]">
          <div class="relative">
            <i data-lucide="search" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>
            <input id="searchInput" type="search" placeholder="Search case number, complainant, respondent, location" class="h-12 w-full rounded-xl border border-blue-100 bg-white pl-12 pr-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100" />
          </div>
          <select id="statusFilter" class="h-12 rounded-xl border border-blue-100 bg-white px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            <option value="All">All Status</option>
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Archived">Archived</option>
          </select>
          <select id="typeFilter" class="h-12 rounded-xl border border-blue-100 bg-white px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            <option value="All">All Types</option>
          </select>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-blue-100">
          <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
              <thead class="bg-blue-50 text-xs uppercase tracking-[0.16em] text-blue-800">
                <tr>
                  <th class="px-5 py-4 font-semibold">Case No.</th>
                  <th class="px-5 py-4 font-semibold">Complainant</th>
                  <th class="px-5 py-4 font-semibold">Respondent</th>
                  <th class="px-5 py-4 font-semibold">Type</th>
                  <th class="px-5 py-4 font-semibold">Date</th>
                  <th class="px-5 py-4 font-semibold">Status</th>
                  <th class="px-5 py-4 text-right font-semibold">Action</th>
                </tr>
              </thead>
              <tbody id="blotterTable" class="divide-y divide-blue-50 bg-white"></tbody>
            </table>
          </div>
          <div id="emptyState" class="hidden p-8 text-center text-sm text-slate-500">No blotter records found.</div>
        </div>
        <div id="pagination" class="mt-4 flex flex-wrap items-center justify-end gap-2"></div>
      </section>
    </main>
  </div>

  <div id="blotterModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[92vh] w-full max-w-4xl overflow-y-auto rounded-3xl border border-blue-100 bg-white shadow-2xl">
      <div class="sticky top-0 z-10 flex items-center justify-between border-b border-blue-100 bg-white p-5">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">Blotter Record</p>
          <h3 id="blotterModalTitle" class="mt-1 text-xl font-bold text-blue-950">Add Blotter</h3>
        </div>
        <button type="button" class="close-blotter-modal rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100 hover:text-slate-900">Close</button>
      </div>

      <form id="blotterForm" class="p-5">
        <input id="editingCaseNo" type="hidden" />
        <div class="grid gap-5 lg:grid-cols-2">
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Complainant Name</label>
            <input id="complainantName" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Complainant Contact</label>
            <input id="complainantContact" required placeholder="09XXXXXXXXX" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Respondent Name</label>
            <input id="respondentName" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Incident Type</label>
            <select id="incidentType" required class="field">
              <option value="">Select</option>
              <option>Noise Complaint</option>
              <option>Physical Injury</option>
              <option>Property Dispute</option>
              <option>Threat</option>
              <option>Theft</option>
              <option>Domestic Concern</option>
              <option>Other</option>
            </select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Incident Date</label>
            <input id="incidentDate" type="date" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Incident Time</label>
            <input id="incidentTime" type="time" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Location</label>
            <input id="location" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Status</label>
            <select id="caseStatus" required class="field">
              <option>Pending</option>
              <option>In Progress</option>
              <option>Resolved</option>
            </select>
          </div>
          <div class="space-y-2 lg:col-span-2">
            <label class="text-sm font-medium text-blue-950">Narrative</label>
            <textarea id="narrative" required rows="5" class="field min-h-32 py-3"></textarea>
          </div>
          <div class="space-y-2 lg:col-span-2">
            <label class="text-sm font-medium text-blue-950">Action Taken</label>
            <textarea id="actionTaken" rows="4" class="field min-h-28 py-3"></textarea>
          </div>
        </div>

        <div class="mt-6 flex flex-col-reverse gap-3 border-t border-blue-100 pt-5 sm:flex-row sm:justify-end">
          <button type="button" class="close-blotter-modal h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Cancel</button>
          <button type="submit" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Save Blotter</button>
        </div>
      </form>
    </div>
  </div>

  <div id="detailModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[92vh] w-full max-w-3xl overflow-y-auto rounded-3xl border border-blue-100 bg-white p-6 shadow-2xl">
      <div class="flex items-start justify-between gap-4">
        <div>
          <p id="detailCaseNo" class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-700"></p>
          <h3 id="detailTitle" class="mt-2 text-2xl font-bold text-blue-950"></h3>
          <p id="detailMeta" class="mt-1 text-sm text-slate-600"></p>
        </div>
        <button type="button" id="closeDetail" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100 hover:text-slate-900">Close</button>
      </div>
      <div id="detailContent" class="mt-6 grid gap-4 sm:grid-cols-2"></div>
      <div class="mt-6 flex flex-col-reverse gap-3 border-t border-blue-100 pt-5 sm:flex-row sm:justify-end">
        <button id="deleteBlotterButton" type="button" class="h-11 rounded-xl border border-red-100 bg-white px-5 text-sm font-semibold text-red-600 hover:bg-gray-100">Delete</button>
        <button id="archiveBlotterButton" type="button" class="h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Archive</button>
        <button id="progressBlotterButton" type="button" class="h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Mark In Progress</button>
        <button id="resolveBlotterButton" type="button" class="h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Mark Resolved</button>
        <button id="editBlotterButton" type="button" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Edit</button>
      </div>
    </div>
  </div>

  <div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="w-full max-w-md rounded-3xl border border-blue-100 bg-white p-6 shadow-2xl">
      <div id="confirmIcon" class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"><i data-lucide="circle-help" class="h-6 w-6"></i></div>
      <h2 id="confirmTitle" class="text-xl font-bold text-blue-950">Confirm action</h2>
      <p id="confirmMessage" class="mt-3 text-sm leading-6 text-slate-600">Proceed?</p>
      <div id="confirmActions" class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
        <button id="cancelConfirm" type="button" class="h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Cancel</button>
        <button id="proceedConfirm" type="button" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Proceed</button>
      </div>
      <div id="successActions" class="mt-7 hidden">
        <button id="closeSuccess" type="button" class="h-11 w-full rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Done</button>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll(".field").forEach((field) => {
      field.className = "field h-11 w-full rounded-xl border border-blue-100 bg-white px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100";
    });

    const storageKey = "bimsBlotters";
    const logKey = "bimsLogs";
    const adminName = document.getElementById("adminName");
    const blotterForm = document.getElementById("blotterForm");
    const blotterTable = document.getElementById("blotterTable");
    const emptyState = document.getElementById("emptyState");
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const typeFilter = document.getElementById("typeFilter");
    const blotterModal = document.getElementById("blotterModal");
    const detailModal = document.getElementById("detailModal");
    const confirmModal = document.getElementById("confirmModal");
    const confirmIcon = document.getElementById("confirmIcon");
    const confirmTitle = document.getElementById("confirmTitle");
    const confirmMessage = document.getElementById("confirmMessage");
    const confirmActions = document.getElementById("confirmActions");
    const successActions = document.getElementById("successActions");
    const editingCaseNoInput = document.getElementById("editingCaseNo");
    const complainantNameInput = document.getElementById("complainantName");
    const complainantContactInput = document.getElementById("complainantContact");
    const respondentNameInput = document.getElementById("respondentName");
    const incidentTypeInput = document.getElementById("incidentType");
    const incidentDateInput = document.getElementById("incidentDate");
    const incidentTimeInput = document.getElementById("incidentTime");
    const locationInput = document.getElementById("location");
    const caseStatusInput = document.getElementById("caseStatus");
    const narrativeInput = document.getElementById("narrative");
    const actionTakenInput = document.getElementById("actionTaken");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarBackdrop = document.getElementById("sidebarBackdrop");

    let blotters = JSON.parse(localStorage.getItem(storageKey) || "[]");
    let selectedCaseNo = "";
    let pendingAction = null;
    let successRedirect = "";
    let currentPage = 1;

    adminName.textContent = localStorage.getItem("bimsUser") || "admin";
    incidentDateInput.max = new Date().toISOString().split("T")[0];

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

    function saveBlotters() {
      localStorage.setItem(storageKey, JSON.stringify(blotters));
    }

    function saveLog(entry) {
      const logs = JSON.parse(localStorage.getItem(logKey) || "[]");
      logs.unshift(entry);
      localStorage.setItem(logKey, JSON.stringify(logs));
    }

    function moveBlotterToLogs(item, result) {
      saveLog({
        id: `LOG-${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
        module: "Blotter Management",
        reference: item.caseNo,
        record: `${item.incidentType} - ${item.complainantName}`,
        result,
        date: item.incidentDate || new Date().toISOString().split("T")[0],
        details: {
          caseNo: item.caseNo,
          complainantName: item.complainantName,
          complainantContact: item.complainantContact,
          respondentName: item.respondentName,
          incidentType: item.incidentType,
          incidentDate: item.incidentDate,
          incidentTime: item.incidentTime,
          location: item.location,
          status: result,
          narrative: item.narrative,
          actionTaken: item.actionTaken || "N/A",
          resolvedAt: new Date().toISOString()
        },
        createdAt: new Date().toISOString()
      });
    }

    function migrateEndedBlotters() {
      const ended = blotters.filter((item) => item.status === "Resolved");
      if (!ended.length) return;
      ended.forEach((item) => moveBlotterToLogs(item, "Resolved"));
      blotters = blotters.filter((item) => item.status !== "Resolved");
      saveBlotters();
    }

    function generateCaseNo() {
      const year = new Date().getFullYear();
      const count = blotters.filter((item) => item.caseNo.startsWith(`BLT-${year}`)).length + 1;
      return `BLT-${year}-${String(count).padStart(4, "0")}`;
    }

    function statusClass(status) {
      if (status === "Resolved") return "bg-emerald-50 text-emerald-700";
      if (status === "Archived") return "bg-slate-100 text-slate-600";
      if (status === "In Progress") return "bg-blue-50 text-blue-700";
      return "bg-amber-50 text-amber-700";
    }

    function formatDate(value) {
      if (!value) return "N/A";
      return new Date(`${value}T00:00:00`).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" });
    }

    function renderStats() {
      const active = blotters.filter((item) => item.status !== "Archived");
      const logs = JSON.parse(localStorage.getItem(logKey) || "[]");
      document.getElementById("totalReports").textContent = active.length;
      document.getElementById("openCases").textContent = active.filter((item) => item.status === "Pending" || item.status === "In Progress").length;
      document.getElementById("resolvedCases").textContent = logs.filter((item) => item.module === "Blotter Management" && item.result === "Resolved").length;
      document.getElementById("archivedCases").textContent = blotters.filter((item) => item.status === "Archived").length;
    }

    function renderTypeFilter() {
      const current = typeFilter.value;
      const types = [...new Set(blotters.map((item) => item.incidentType).filter(Boolean))].sort();
      typeFilter.innerHTML = '<option value="All">All Types</option>' + types.map((type) => `<option value="${type}">${type}</option>`).join("");
      typeFilter.value = types.includes(current) ? current : "All";
    }

    function getFilteredBlotters() {
      const query = searchInput.value.trim().toLowerCase();
      return blotters.filter((item) => {
        const searchable = [item.caseNo, item.complainantName, item.respondentName, item.location, item.incidentType].join(" ").toLowerCase();
        const matchesSearch = !query || searchable.includes(query);
        const matchesStatus = statusFilter.value === "All" || item.status === statusFilter.value;
        const matchesType = typeFilter.value === "All" || item.incidentType === typeFilter.value;
        return matchesSearch && matchesStatus && matchesType;
      }).sort((a, b) => new Date(b.incidentDate || b.createdAt || 0) - new Date(a.incidentDate || a.createdAt || 0));
    }

    function getPageSize() {
      if (window.innerWidth < 640) return 4;
      if (window.innerWidth < 1024) return 6;
      if (window.innerWidth < 1440) return 8;
      return 10;
    }

    function renderPagination(totalItems) {
      const pageSize = getPageSize();
      const totalPages = Math.max(1, Math.ceil(totalItems / pageSize));
      currentPage = Math.min(currentPage, totalPages);
      const pages = Array.from({ length: totalPages }, (_, index) => index + 1);
      document.getElementById("pagination").innerHTML = totalItems <= pageSize ? "" : pages.map((page) => `
        <button type="button" data-page="${page}" class="page-button h-9 min-w-9 rounded-lg border px-3 text-sm font-semibold ${page === currentPage ? "border-blue-600 bg-blue-600 text-white" : "border-blue-100 bg-white text-slate-700 hover:bg-gray-100"}">${page}</button>
      `).join("");
    }

    function renderTable() {
      const filtered = getFilteredBlotters();
      const pageSize = getPageSize();
      const paged = filtered.slice((currentPage - 1) * pageSize, currentPage * pageSize);
      blotterTable.innerHTML = paged.map((item) => `
        <tr class="hover:bg-gray-50">
          <td class="px-5 py-4 font-semibold text-blue-800">${item.caseNo}</td>
          <td class="px-5 py-4 text-slate-800">${item.complainantName}</td>
          <td class="px-5 py-4 text-slate-600">${item.respondentName}</td>
          <td class="px-5 py-4 text-slate-600">${item.incidentType}</td>
          <td class="px-5 py-4 text-slate-600">${formatDate(item.incidentDate)}</td>
          <td class="px-5 py-4"><span class="rounded-full ${statusClass(item.status)} px-3 py-1 text-xs font-semibold">${item.status}</span></td>
          <td class="px-5 py-4 text-right">
            <button type="button" data-id="${item.caseNo}" class="view-blotter rounded-lg px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-gray-100">View</button>
          </td>
        </tr>
      `).join("");
      emptyState.classList.toggle("hidden", filtered.length > 0);
      renderStats();
      renderTypeFilter();
      renderPagination(filtered.length);
      lucide.createIcons();
    }

    function openBlotterModal(item = null) {
      blotterForm.reset();
      editingCaseNoInput.value = item ? item.caseNo : "";
      document.getElementById("blotterModalTitle").textContent = item ? "Edit Blotter" : "Add Blotter";

      if (item) {
        Object.keys(item).forEach((key) => {
          const field = document.getElementById(key);
          if (field) field.value = item[key] ?? "";
        });
        caseStatusInput.value = item.status === "Archived" ? "Pending" : item.status;
      }

      blotterModal.classList.remove("hidden");
      blotterModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeBlotterModal() {
      blotterModal.classList.add("hidden");
      blotterModal.classList.remove("flex");
      document.body.classList.remove("modal-open");
    }

    function openDetail(caseNo) {
      const item = blotters.find((record) => record.caseNo === caseNo);
      if (!item) return;
      selectedCaseNo = caseNo;
      document.getElementById("detailCaseNo").textContent = item.caseNo;
      document.getElementById("detailTitle").textContent = item.incidentType;
      document.getElementById("detailMeta").textContent = `${formatDate(item.incidentDate)} • ${item.location} • ${item.status}`;
      document.getElementById("archiveBlotterButton").textContent = item.status === "Archived" ? "Restore" : "Archive";
      document.getElementById("progressBlotterButton").classList.toggle("hidden", item.status === "In Progress" || item.status === "Resolved" || item.status === "Archived");
      document.getElementById("resolveBlotterButton").classList.toggle("hidden", item.status === "Resolved" || item.status === "Archived");
      document.getElementById("detailContent").innerHTML = [
        ["Complainant", item.complainantName],
        ["Contact", item.complainantContact],
        ["Respondent", item.respondentName],
        ["Incident Time", item.incidentTime],
        ["Status", item.status],
        ["Location", item.location],
        ["Narrative", item.narrative],
        ["Action Taken", item.actionTaken || "N/A"]
      ].map(([label, value]) => `<div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 ${label === "Narrative" || label === "Action Taken" ? "sm:col-span-2" : ""}"><p class="text-xs font-semibold uppercase tracking-[0.16em] text-blue-700">${label}</p><p class="mt-2 text-sm font-medium leading-6 text-slate-800">${value}</p></div>`).join("");
      detailModal.classList.remove("hidden");
      detailModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeDetail() {
      detailModal.classList.add("hidden");
      detailModal.classList.remove("flex");
      document.body.classList.remove("modal-open");
    }

    function openConfirm(title, message, action) {
      pendingAction = action;
      confirmIcon.innerHTML = '<i data-lucide="circle-help" class="h-6 w-6"></i>';
      confirmIcon.className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700";
      confirmTitle.textContent = title;
      confirmMessage.textContent = message;
      confirmActions.classList.remove("hidden");
      successActions.classList.add("hidden");
      confirmModal.classList.remove("hidden");
      confirmModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function openSuccess(message) {
      confirmIcon.innerHTML = '<i data-lucide="circle-check" class="h-6 w-6"></i>';
      confirmIcon.className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white";
      confirmTitle.textContent = "Success";
      confirmMessage.textContent = message;
      confirmActions.classList.add("hidden");
      successActions.classList.remove("hidden");
      confirmModal.classList.remove("hidden");
      confirmModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function openError(message) {
      confirmIcon.innerHTML = '<i data-lucide="circle-alert" class="h-6 w-6"></i>';
      confirmIcon.className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-red-600";
      confirmTitle.textContent = "Unable to save";
      confirmMessage.textContent = message;
      confirmActions.classList.add("hidden");
      successActions.classList.remove("hidden");
      confirmModal.classList.remove("hidden");
      confirmModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeConfirm() {
      confirmModal.classList.add("hidden");
      confirmModal.classList.remove("flex");
      document.body.classList.remove("modal-open");
      pendingAction = null;
      if (successRedirect) {
        const target = successRedirect;
        successRedirect = "";
        window.location.href = target;
      }
    }

    function getFormData() {
      return {
        complainantName: complainantNameInput.value.trim(),
        complainantContact: complainantContactInput.value.trim(),
        respondentName: respondentNameInput.value.trim(),
        incidentType: incidentTypeInput.value,
        incidentDate: incidentDateInput.value,
        incidentTime: incidentTimeInput.value,
        location: locationInput.value.trim(),
        status: caseStatusInput.value,
        narrative: narrativeInput.value.trim(),
        actionTaken: actionTakenInput.value.trim()
      };
    }

    function validateBlotter(data) {
      if (new Date(data.incidentDate) > new Date()) return "Incident date cannot be in the future.";
      if (!/^09\d{9}$/.test(data.complainantContact)) return "Contact number must use 09XXXXXXXXX format.";
      return "";
    }

    blotterForm.addEventListener("submit", (event) => {
      event.preventDefault();
      const editingCaseNo = editingCaseNoInput.value;
      const data = getFormData();
      const error = validateBlotter(data);
      if (error) {
        openError(error);
        return;
      }

      openConfirm("Save blotter", "Are you sure you want to save this blotter record?", () => {
        if (data.status === "Resolved") {
          const existing = editingCaseNo ? blotters.find((item) => item.caseNo === editingCaseNo) : null;
          const resolvedItem = editingCaseNo ? { ...existing, ...data, caseNo: editingCaseNo } : { ...data, caseNo: generateCaseNo() };
          moveBlotterToLogs(resolvedItem, "Resolved");
          blotters = editingCaseNo ? blotters.filter((item) => item.caseNo !== editingCaseNo) : blotters;
          saveBlotters();
          closeBlotterModal();
          currentPage = 1;
          renderTable();
          openSuccess("Resolved blotter moved to Logs History.");
          return;
        }

        if (editingCaseNo) {
          blotters = blotters.map((item) => item.caseNo === editingCaseNo ? { ...item, ...data, updatedAt: new Date().toISOString() } : item);
        } else {
          blotters.unshift({ ...data, caseNo: generateCaseNo(), createdAt: new Date().toISOString(), updatedAt: new Date().toISOString() });
        }
        saveBlotters();
        closeBlotterModal();
        renderTable();
        openSuccess(editingCaseNo ? "Blotter record updated successfully." : "Blotter record saved successfully.");
      });
    });

    document.getElementById("addBlotterButton").addEventListener("click", () => openBlotterModal());
    document.querySelectorAll(".close-blotter-modal").forEach((button) => button.addEventListener("click", closeBlotterModal));
    document.getElementById("closeDetail").addEventListener("click", closeDetail);
    searchInput.addEventListener("input", () => { currentPage = 1; renderTable(); });
    statusFilter.addEventListener("change", () => { currentPage = 1; renderTable(); });
    typeFilter.addEventListener("change", () => { currentPage = 1; renderTable(); });
    document.getElementById("pagination").addEventListener("click", (event) => {
      const button = event.target.closest(".page-button");
      if (!button) return;
      currentPage = Number(button.dataset.page);
      renderTable();
    });
    window.addEventListener("resize", () => { currentPage = 1; renderTable(); });
    blotterTable.addEventListener("click", (event) => {
      const button = event.target.closest(".view-blotter");
      if (button) openDetail(button.dataset.id);
    });

    document.getElementById("editBlotterButton").addEventListener("click", () => {
      const item = blotters.find((record) => record.caseNo === selectedCaseNo);
      closeDetail();
      openBlotterModal(item);
    });

    document.getElementById("resolveBlotterButton").addEventListener("click", () => {
      openConfirm("Resolve case", "Mark this blotter case as resolved?", () => {
        const item = blotters.find((record) => record.caseNo === selectedCaseNo);
        if (!item) return;
        moveBlotterToLogs({ ...item, resolvedAt: new Date().toISOString() }, "Resolved");
        blotters = blotters.filter((record) => record.caseNo !== selectedCaseNo);
        saveBlotters();
        closeDetail();
        currentPage = 1;
        renderTable();
        openSuccess("Resolved blotter moved to Logs History.");
      });
    });

    document.getElementById("progressBlotterButton").addEventListener("click", () => {
      openConfirm("Update case", "Mark this blotter case as in progress?", () => {
        blotters = blotters.map((item) => item.caseNo === selectedCaseNo ? { ...item, status: "In Progress", updatedAt: new Date().toISOString() } : item);
        saveBlotters();
        closeDetail();
        renderTable();
        openSuccess("Blotter case marked as in progress.");
      });
    });

    document.getElementById("archiveBlotterButton").addEventListener("click", () => {
      const item = blotters.find((record) => record.caseNo === selectedCaseNo);
      const nextStatus = item.status === "Archived" ? "Pending" : "Archived";
      openConfirm(nextStatus === "Archived" ? "Archive blotter" : "Restore blotter", `Proceed to ${nextStatus === "Archived" ? "archive" : "restore"} this blotter record?`, () => {
        blotters = blotters.map((record) => record.caseNo === selectedCaseNo ? { ...record, status: nextStatus, archivedAt: nextStatus === "Archived" ? new Date().toISOString() : "" } : record);
        saveBlotters();
        closeDetail();
        renderTable();
        openSuccess(nextStatus === "Archived" ? "Blotter record archived successfully." : "Blotter record restored successfully.");
      });
    });

    document.getElementById("deleteBlotterButton").addEventListener("click", () => {
      openConfirm("Delete blotter", "Proceed to delete this blotter record?", () => {
        blotters = blotters.filter((record) => record.caseNo !== selectedCaseNo);
        saveBlotters();
        closeDetail();
        currentPage = 1;
        renderTable();
        openSuccess("Blotter record deleted successfully.");
      });
    });

    document.getElementById("logoutButton").addEventListener("click", () => {
      openConfirm("Confirm logout", "Proceed with logout?", () => {
        localStorage.removeItem("bimsUser");
        window.location.href = "index.html";
      });
    });

    document.getElementById("cancelConfirm").addEventListener("click", closeConfirm);
    document.getElementById("proceedConfirm").addEventListener("click", () => {
      if (typeof pendingAction === "function") pendingAction();
    });
    document.getElementById("closeSuccess").addEventListener("click", closeConfirm);

    migrateEndedBlotters();
    renderTable();
  </script>
</body>
</html>
