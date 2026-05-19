<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logs History</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
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
        <a href="dashboard.html" class="nav"><i data-lucide="layout-dashboard" class="h-4 w-4"></i>Dashboard</a>
        <a href="resident-management.html" class="nav"><i data-lucide="users-round" class="h-4 w-4"></i>Resident Management</a>
        <a href="blotter-management.html" class="nav"><i data-lucide="file-warning" class="h-4 w-4"></i>Blotter Management</a>
        <a href="event-management.html" class="nav"><i data-lucide="calendar-days" class="h-4 w-4"></i>Event Management</a>
        <a href="certificate-document-management.html" class="nav"><i data-lucide="file-check-2" class="h-4 w-4"></i>Certificate & Document Management</a>
        <a href="officials-management.html" class="nav"><i data-lucide="landmark" class="h-4 w-4"></i>Officials Management</a>
        <a href="logs-history.html" class="nav-active"><i data-lucide="history" class="h-4 w-4"></i>Logs History</a>
      </nav>
      <div class="mt-auto rounded-xl border border-blue-100 bg-white p-3">
        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-blue-700">Admin Name</p>
        <p id="adminName" class="mt-1 text-sm font-semibold text-blue-950">admin</p>
        <button id="logoutButton" class="mt-3 flex h-10 w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white hover:bg-gray-700"><i data-lucide="log-out" class="h-4 w-4"></i>Logout</button>
      </div>
    </aside>

    <main id="pageMain" class="min-h-screen flex-1 bg-white">
      <section class="min-h-screen border-l border-blue-100 bg-white p-6 pt-20 sm:p-8 lg:pt-8">
        <div class="flex flex-col gap-4 border-b border-blue-100 pb-6 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-700">Logs History</p>
            <h2 class="mt-2 text-2xl font-bold text-blue-950">Completed Transactions</h2>
          </div>
          <button id="clearLogsButton" class="h-11 rounded-xl border border-red-100 bg-white px-4 text-sm font-semibold text-red-600 hover:bg-gray-100">Clear Logs</button>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-5">
          <p class="text-sm font-semibold text-blue-950">Simple workflow</p>
          <p class="mt-2 text-sm text-slate-600">Resolved, completed, and released records from subsystems are moved here for history tracking.</p>
        </div>

        <div class="mt-6 flex flex-wrap gap-2" id="moduleFilters">
          <button data-module="All" class="module-filter h-10 rounded-lg border border-blue-600 bg-blue-600 px-4 text-sm font-semibold text-white">All</button>
          <button data-module="Blotter Management" class="module-filter h-10 rounded-lg border border-blue-100 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-gray-100">Blotter</button>
          <button data-module="Event Management" class="module-filter h-10 rounded-lg border border-blue-100 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-gray-100">Event</button>
          <button data-module="Certificate & Document Management" class="module-filter h-10 rounded-lg border border-blue-100 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-gray-100">Certificate/Document</button>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-blue-100">
          <table class="w-full min-w-[900px] text-left text-sm">
            <thead class="bg-blue-50 text-xs uppercase tracking-[0.16em] text-blue-800">
              <tr>
                <th class="px-5 py-4">Date</th>
                <th class="px-5 py-4">Module</th>
                <th class="px-5 py-4">Reference</th>
                <th class="px-5 py-4">Record</th>
                <th class="px-5 py-4">Result</th>
                <th class="px-5 py-4 text-right">Action</th>
              </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-blue-50"></tbody>
          </table>
          <div id="emptyState" class="hidden p-8 text-center text-sm text-slate-500">No logs found.</div>
        </div>
        <div id="pagination" class="mt-4 flex flex-wrap items-center justify-end gap-2"></div>
      </section>
    </main>
  </div>

  <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[90vh] w-full max-w-4xl overflow-y-auto rounded-3xl border border-blue-100 bg-white p-6 shadow-2xl">
      <div class="flex flex-col gap-4 border-b border-blue-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
        <div>
          <p id="detailId" class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">LOG</p>
          <h2 id="detailTitle" class="mt-2 text-xl font-bold text-blue-950">Log Details</h2>
          <p id="detailMeta" class="mt-1 text-sm text-slate-600">Completed transaction</p>
        </div>
        <button id="closeDetail" type="button" class="h-10 rounded-xl border border-blue-100 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-gray-100">Close</button>
      </div>
      <div id="detailContent" class="mt-5 grid gap-3 sm:grid-cols-2"></div>
    </div>
  </div>

  <div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="w-full max-w-md rounded-3xl border border-blue-100 bg-white p-6 shadow-2xl">
      <div id="confirmIcon" class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"><i data-lucide="circle-help" class="h-6 w-6"></i></div>
      <h2 id="confirmTitle" class="text-xl font-bold text-blue-950">Confirm action</h2>
      <p id="confirmMessage" class="mt-3 text-sm text-slate-600">Proceed?</p>
      <div id="confirmActions" class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
        <button id="cancelConfirm" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold hover:bg-gray-100">Cancel</button>
        <button id="proceedConfirm" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Proceed</button>
      </div>
      <div id="successActions" class="mt-7 hidden">
        <button id="closeSuccess" class="h-11 w-full rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Done</button>
      </div>
    </div>
  </div>

  <script>
    const $ = (id) => document.getElementById(id);
    const key = "bimsLogs";
    let logs = JSON.parse(localStorage.getItem(key) || "[]");
    let currentPage = 1;
    let currentModule = "All";
    let pendingAction = null;
    let selectedLogId = "";

    document.querySelectorAll(".nav").forEach((el) => el.className = "flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900");
    document.querySelectorAll(".nav-active").forEach((el) => el.className = "flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-sm font-semibold text-blue-800");
    $("adminName").textContent = localStorage.getItem("bimsUser") || "admin";

    function toggleSidebar() {
      if (window.matchMedia("(min-width: 1024px)").matches) {
        document.body.classList.toggle("sidebar-closed");
        return;
      }
      document.body.classList.toggle("sidebar-open");
      $("sidebarBackdrop").classList.toggle("hidden", !document.body.classList.contains("sidebar-open"));
    }

    $("sidebarToggle").addEventListener("click", toggleSidebar);
    $("sidebarBackdrop").addEventListener("click", () => {
      document.body.classList.remove("sidebar-open");
      $("sidebarBackdrop").classList.add("hidden");
    });

    const formatDate = (value) => value ? new Date(value.includes("T") ? value : `${value}T00:00:00`).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" }) : "N/A";
    const getPageSize = () => window.innerWidth < 640 ? 5 : window.innerWidth < 1024 ? 8 : 12;

    function escapeHtml(value) {
      return String(value ?? "N/A")
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
    }

    function formatDetailValue(label, value) {
      if (!value) return "N/A";
      if (label.toLowerCase().includes("date") || label.endsWith("At")) return formatDate(value);
      return value;
    }

    function detailPairs(item) {
      const d = item.details || {};
      if (item.module === "Blotter Management") {
        return [
          ["Case No", d.caseNo || item.reference],
          ["Complainant", d.complainantName],
          ["Contact", d.complainantContact],
          ["Respondent", d.respondentName],
          ["Incident Type", d.incidentType],
          ["Incident Date", d.incidentDate || item.date],
          ["Incident Time", d.incidentTime],
          ["Location", d.location],
          ["Status", d.status || item.result],
          ["Narrative", d.narrative],
          ["Action Taken", d.actionTaken],
          ["Resolved At", d.resolvedAt || item.createdAt]
        ];
      }
      if (item.module === "Event Management") {
        return [
          ["Event ID", d.eventId || item.reference],
          ["Title", d.title || item.record],
          ["Type", d.type],
          ["Date", d.date || item.date],
          ["Time", d.time],
          ["Venue", d.venue],
          ["Organizer", d.organizer],
          ["Status", d.status || item.result],
          ["Description", d.description],
          ["Completed At", d.completedAt || item.createdAt]
        ];
      }
      if (item.module === "Certificate & Document Management") {
        return [
          ["Request No", d.requestNo || item.reference],
          ["Resident Name", d.residentName],
          ["Document Type", d.documentType],
          ["Request Date", d.requestDate || item.date],
          ["Purpose", d.purpose],
          ["Status", d.status || item.result],
          ["Released At", d.releasedAt || item.createdAt]
        ];
      }
      return [
        ["Reference", item.reference],
        ["Record", item.record],
        ["Date", item.date || item.createdAt]
      ];
    }

    function renderDetails(item) {
      return detailPairs(item).map(([label, value]) => `
        <div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4">
          <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-blue-700">${escapeHtml(label)}</p>
          <p class="mt-2 whitespace-pre-wrap text-sm font-medium leading-6 text-slate-800">${escapeHtml(formatDetailValue(label, value))}</p>
        </div>
      `).join("");
    }

    function openDetail(logId) {
      const item = logs.find((record) => record.id === logId);
      if (!item) return;
      selectedLogId = logId;
      $("detailId").textContent = item.reference || "LOG";
      $("detailTitle").textContent = item.record || "Log Details";
      $("detailMeta").textContent = `${formatDate(item.date || item.createdAt)} - ${item.module} - ${item.result || "Completed"}`;
      $("detailContent").innerHTML = renderDetails(item);
      $("detailModal").classList.remove("hidden");
      $("detailModal").classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeDetail() {
      $("detailModal").classList.add("hidden");
      $("detailModal").classList.remove("flex");
      document.body.classList.remove("modal-open");
      selectedLogId = "";
    }

    function getFilteredLogs() {
      const items = currentModule === "All" ? logs : logs.filter((item) => item.module === currentModule);
      return [...items].sort((a, b) => new Date(b.date || b.createdAt || 0) - new Date(a.date || a.createdAt || 0));
    }

    function renderPagination(totalItems) {
      const pageSize = getPageSize();
      const totalPages = Math.max(1, Math.ceil(totalItems / pageSize));
      currentPage = Math.min(currentPage, totalPages);
      const pages = Array.from({ length: totalPages }, (_, index) => index + 1);
      $("pagination").innerHTML = totalItems <= pageSize ? "" : pages.map((page) => `<button type="button" data-page="${page}" class="page-button h-9 min-w-9 rounded-lg border px-3 text-sm font-semibold ${page === currentPage ? "border-blue-600 bg-blue-600 text-white" : "border-blue-100 bg-white text-slate-700 hover:bg-gray-100"}">${page}</button>`).join("");
    }

    function render() {
      const filtered = getFilteredLogs();
      const pageSize = getPageSize();
      const paged = filtered.slice((currentPage - 1) * pageSize, currentPage * pageSize);
      $("tableBody").innerHTML = paged.map((item) => `
        <tr class="hover:bg-gray-50">
          <td class="px-5 py-4 text-slate-600">${formatDate(item.date || item.createdAt)}</td>
          <td class="px-5 py-4">${escapeHtml(item.module)}</td>
          <td class="px-5 py-4 font-semibold text-blue-800">${escapeHtml(item.reference || "N/A")}</td>
          <td class="px-5 py-4 text-slate-700">${escapeHtml(item.record || "N/A")}</td>
          <td class="px-5 py-4"><span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">${escapeHtml(item.result || "Completed")}</span></td>
          <td class="px-5 py-4 text-right">
            <button type="button" data-id="${escapeHtml(item.id)}" class="view-log rounded-lg px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-gray-100">View</button>
          </td>
        </tr>
      `).join("");
      $("emptyState").classList.toggle("hidden", filtered.length > 0);
      renderPagination(filtered.length);
      lucide.createIcons();
    }

    function openConfirm(title, message, action) {
      pendingAction = action;
      $("confirmIcon").innerHTML = '<i data-lucide="circle-help" class="h-6 w-6"></i>';
      $("confirmIcon").className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700";
      $("confirmTitle").textContent = title;
      $("confirmMessage").textContent = message;
      $("confirmActions").classList.remove("hidden");
      $("successActions").classList.add("hidden");
      $("confirmModal").classList.remove("hidden");
      $("confirmModal").classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeConfirm() {
      $("confirmModal").classList.add("hidden");
      $("confirmModal").classList.remove("flex");
      document.body.classList.remove("modal-open");
      pendingAction = null;
    }

    $("moduleFilters").addEventListener("click", (event) => {
      const button = event.target.closest(".module-filter");
      if (!button) return;
      currentModule = button.dataset.module;
      currentPage = 1;
      document.querySelectorAll(".module-filter").forEach((item) => item.className = "module-filter h-10 rounded-lg border border-blue-100 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-gray-100");
      button.className = "module-filter h-10 rounded-lg border border-blue-600 bg-blue-600 px-4 text-sm font-semibold text-white";
      render();
    });

    $("pagination").addEventListener("click", (event) => {
      const button = event.target.closest(".page-button");
      if (!button) return;
      currentPage = Number(button.dataset.page);
      render();
    });

    $("tableBody").addEventListener("click", (event) => {
      const button = event.target.closest(".view-log");
      if (!button) return;
      openDetail(button.dataset.id);
    });

    $("logoutButton").onclick = () => openConfirm("Confirm logout", "Proceed with logout?", () => { localStorage.removeItem("bimsUser"); window.location.href = "index.html"; });
    $("clearLogsButton").onclick = () => openConfirm("Clear logs", "Proceed to clear all logs history?", () => { logs = []; localStorage.setItem(key, JSON.stringify(logs)); currentPage = 1; closeConfirm(); render(); });
    $("closeDetail").onclick = closeDetail;
    $("cancelConfirm").onclick = closeConfirm;
    $("proceedConfirm").onclick = () => { if (typeof pendingAction === "function") pendingAction(); };
    $("closeSuccess").onclick = closeConfirm;
    window.addEventListener("resize", () => { currentPage = 1; render(); });

    render();
  </script>
</body>
</html>
