<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate & Document Management</title>
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
      <div class="mb-7 border-b border-blue-100 pb-5"><h1 class="pr-10 text-base font-bold leading-snug text-blue-950">Barangay Information Management System</h1></div>
      <nav class="space-y-1.5">
        <a href="dashboard.html" class="nav"><i data-lucide="layout-dashboard" class="h-4 w-4"></i>Dashboard</a>
        <a href="resident-management.html" class="nav"><i data-lucide="users-round" class="h-4 w-4"></i>Resident Management</a>
        <a href="blotter-management.html" class="nav"><i data-lucide="file-warning" class="h-4 w-4"></i>Blotter Management</a>
        <a href="event-management.html" class="nav"><i data-lucide="calendar-days" class="h-4 w-4"></i>Event Management</a>
        <a href="certificate-document-management.html" class="nav-active"><i data-lucide="file-check-2" class="h-4 w-4"></i>Certificate & Document Management</a>
        <a href="officials-management.html" class="nav"><i data-lucide="landmark" class="h-4 w-4"></i>Officials Management</a>
        <a href="logs-history.html" class="nav"><i data-lucide="history" class="h-4 w-4"></i>Logs History</a>
      </nav>
      <div class="mt-auto rounded-xl border border-blue-100 bg-white p-3"><p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-blue-700">Admin Name</p><p id="adminName" class="mt-1 text-sm font-semibold text-blue-950">admin</p><button id="logoutButton" class="mt-3 flex h-10 w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white hover:bg-gray-700"><i data-lucide="log-out" class="h-4 w-4"></i>Logout</button></div>
    </aside>

    <main id="pageMain" class="min-h-screen flex-1 bg-white">
      <section class="min-h-screen border-l border-blue-100 bg-white p-6 pt-20 sm:p-8 lg:pt-8">
        <div class="flex flex-col gap-4 border-b border-blue-100 pb-6 lg:flex-row lg:items-center lg:justify-between">
          <div><p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-700">Certificate & Document Management</p><h2 class="mt-2 text-2xl font-bold text-blue-950">Document Requests</h2></div>
          <button id="addButton" class="flex h-11 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-gray-700"><i data-lucide="plus" class="h-4 w-4"></i>New Request</button>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-5">
          <div class="card"><p>Total Requests</p><h3 id="totalCount">0</h3></div>
          <div class="card"><p>Pending</p><h3 id="pendingCount">0</h3></div>
          <div class="card"><p>For Release</p><h3 id="releaseCount">0</h3></div>
          <div class="card"><p>Released</p><h3 id="releasedCount">0</h3></div>
          <div class="card"><p>Archived</p><h3 id="archivedCount">0</h3></div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-5">
          <p class="text-sm font-semibold text-blue-950">Simple workflow</p>
          <p class="mt-2 text-sm text-slate-600">Receive request, verify resident details, prepare document, then release and record the transaction.</p>
        </div>

        <div class="mt-6 grid gap-3 lg:grid-cols-[1fr_220px]">
          <div class="relative"><i data-lucide="search" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i><input id="searchInput" class="h-12 w-full rounded-xl border border-blue-100 pl-12 pr-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Search request number, resident, document type" /></div>
          <select id="statusFilter" class="h-12 rounded-xl border border-blue-100 px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"><option>All</option><option>Pending</option><option>For Release</option><option>Cancelled</option><option>Archived</option></select>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-blue-100">
          <table class="w-full min-w-[850px] text-left text-sm">
            <thead class="bg-blue-50 text-xs uppercase tracking-[0.16em] text-blue-800"><tr><th class="px-5 py-4">Request No.</th><th class="px-5 py-4">Resident</th><th class="px-5 py-4">Document</th><th class="px-5 py-4">Purpose</th><th class="px-5 py-4">Status</th><th class="px-5 py-4 text-right">Action</th></tr></thead>
            <tbody id="tableBody" class="divide-y divide-blue-50"></tbody>
          </table>
          <div id="emptyState" class="hidden p-8 text-center text-sm text-slate-500">No document requests found.</div>
        </div>
        <div id="pagination" class="mt-4 flex flex-wrap items-center justify-end gap-2"></div>
      </section>
    </main>
  </div>

  <div id="formModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="w-full max-w-3xl rounded-3xl bg-white shadow-2xl">
      <div class="flex items-center justify-between border-b border-blue-100 p-5"><h3 id="formTitle" class="text-xl font-bold text-blue-950">New Request</h3><button class="closeForm rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100 hover:text-slate-900">Close</button></div>
      <form id="recordForm" class="grid gap-5 p-5 lg:grid-cols-2">
        <input id="editingId" type="hidden" />
        <label class="label">Resident Name<input id="residentName" required class="field" /></label>
        <label class="label">Document Type<select id="documentType" required class="field"><option value="">Select</option><option>Barangay Clearance</option><option>Certificate of Residency</option><option>Certificate of Indigency</option><option>Business Clearance</option><option>Good Moral Certificate</option></select></label>
        <label class="label">Request Date<input id="requestDate" type="date" required class="field" /></label>
        <label class="label lg:col-span-2">Purpose<textarea id="purpose" required rows="3" class="field min-h-24 py-3"></textarea></label>
        <div class="flex justify-end gap-3 border-t border-blue-100 pt-5 lg:col-span-2"><button type="button" class="closeForm h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold hover:bg-gray-100">Cancel</button><button class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Save Request</button></div>
      </form>
    </div>
  </div>

  <div id="detailModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[92vh] w-full max-w-3xl overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl">
      <div class="flex items-start justify-between gap-4">
        <div>
          <p id="detailId" class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-700"></p>
          <h3 id="detailTitle" class="mt-2 text-2xl font-bold text-blue-950"></h3>
          <p id="detailMeta" class="mt-1 text-sm text-slate-600"></p>
        </div>
        <button id="closeDetail" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100">Close</button>
      </div>
      <div id="detailContent" class="mt-6 grid gap-4 sm:grid-cols-2"></div>
      <div class="mt-6 flex flex-col-reverse gap-3 border-t border-blue-100 pt-5 sm:flex-row sm:justify-end">
        <button id="deleteRequestButton" class="h-11 rounded-xl border border-red-100 px-5 text-sm font-semibold text-red-600 hover:bg-gray-100">Delete</button>
        <button id="archiveRequestButton" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Archive</button>
        <button id="releaseRequestButton" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold text-emerald-700 hover:bg-gray-100">Released</button>
        <button id="forReleaseRequestButton" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold text-blue-700 hover:bg-gray-100">For Release</button>
        <button id="editRequestButton" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Edit</button>
      </div>
    </div>
  </div>

  <div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/40 p-4"><div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl"><div id="confirmIcon" class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"><i data-lucide="circle-help" class="h-6 w-6"></i></div><h2 id="confirmTitle" class="text-xl font-bold text-blue-950">Confirm action</h2><p id="confirmMessage" class="mt-3 text-sm text-slate-600">Proceed?</p><div id="confirmActions" class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end"><button id="cancelConfirm" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold hover:bg-gray-100">Cancel</button><button id="proceedConfirm" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Proceed</button></div><div id="successActions" class="mt-7 hidden"><button id="closeSuccess" class="h-11 w-full rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Done</button></div></div></div>

  <script>
    const $ = (id) => document.getElementById(id);
    document.querySelectorAll(".nav").forEach((el) => el.className = "flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900");
    document.querySelectorAll(".nav-active").forEach((el) => el.className = "flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-sm font-semibold text-blue-800");
    document.querySelectorAll(".field").forEach((el) => el.className = "field h-11 w-full rounded-xl border border-blue-100 px-4 text-sm font-normal text-slate-900 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100");
    document.querySelectorAll(".label").forEach((el) => el.className = "label space-y-2 text-sm font-medium text-blue-950");
    document.querySelectorAll(".card").forEach((el) => el.className = "card rounded-2xl border border-blue-100 bg-white p-5");
    document.querySelectorAll(".card p").forEach((el) => el.className = "text-sm font-medium text-slate-600");
    document.querySelectorAll(".card h3").forEach((el) => el.className = "mt-2 text-3xl font-bold text-blue-950");

    const key = "bimsDocuments";
    const logKey = "bimsLogs";
    let records = JSON.parse(localStorage.getItem(key) || "[]");
    let pendingAction = null;
    let successRedirect = "";
    let currentPage = 1;
    let selectedRequestNo = "";
    $("adminName").textContent = localStorage.getItem("bimsUser") || "admin";
    $("requestDate").max = new Date().toISOString().split("T")[0];

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

    const save = () => localStorage.setItem(key, JSON.stringify(records));
    const saveLog = (entry) => {
      const logs = JSON.parse(localStorage.getItem(logKey) || "[]");
      logs.unshift(entry);
      localStorage.setItem(logKey, JSON.stringify(logs));
    };
    const moveRequestToLogs = (item, result) => {
      saveLog({
        id: `LOG-${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
        module: "Certificate & Document Management",
        reference: item.requestNo,
        record: `${item.documentType} - ${item.residentName}`,
        result,
        date: item.requestDate || new Date().toISOString().split("T")[0],
        details: {
          requestNo: item.requestNo,
          residentName: item.residentName,
          documentType: item.documentType,
          requestDate: item.requestDate,
          purpose: item.purpose,
          status: result,
          releasedAt: new Date().toISOString()
        },
        createdAt: new Date().toISOString()
      });
    };
    const migrateReleasedRequests = () => {
      const ended = records.filter((item) => item.status === "Released");
      if (!ended.length) return;
      ended.forEach((item) => moveRequestToLogs(item, "Released"));
      records = records.filter((item) => item.status !== "Released");
      save();
    };
    const nextId = () => `DOC-${new Date().getFullYear()}-${String(records.length + 1).padStart(4, "0")}`;
    const badge = (s) => s === "Released" ? "bg-emerald-50 text-emerald-700" : s === "For Release" ? "bg-blue-50 text-blue-700" : s === "Cancelled" || s === "Archived" ? "bg-slate-100 text-slate-600" : "bg-amber-50 text-amber-700";
    const getPageSize = () => window.innerWidth < 640 ? 4 : window.innerWidth < 1024 ? 6 : window.innerWidth < 1440 ? 8 : 10;
    const formatDate = (value) => value ? new Date(`${value}T00:00:00`).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" }) : "N/A";
    function renderPagination(totalItems) { const pageSize = getPageSize(); const totalPages = Math.max(1, Math.ceil(totalItems / pageSize)); currentPage = Math.min(currentPage, totalPages); const pages = Array.from({ length: totalPages }, (_, index) => index + 1); $("pagination").innerHTML = totalItems <= pageSize ? "" : pages.map((page) => `<button type="button" data-page="${page}" class="page-button h-9 min-w-9 rounded-lg border px-3 text-sm font-semibold ${page === currentPage ? "border-blue-600 bg-blue-600 text-white" : "border-blue-100 bg-white text-slate-700 hover:bg-gray-100"}">${page}</button>`).join(""); }
    const values = () => ({ residentName: $("residentName").value.trim(), documentType: $("documentType").value, requestDate: $("requestDate").value, purpose: $("purpose").value.trim() });
    function openForm(record = null) { $("recordForm").reset(); $("editingId").value = record?.requestNo || ""; $("formTitle").textContent = record ? "Edit Request" : "New Request"; if (record) Object.keys(values()).forEach((k) => $(k).value = record[k] || ""); $("formModal").classList.replace("hidden","flex"); document.body.classList.add("modal-open"); lucide.createIcons(); }
    function closeForm() { $("formModal").classList.add("hidden"); $("formModal").classList.remove("flex"); document.body.classList.remove("modal-open"); }
    function filtered() { const q = $("searchInput").value.toLowerCase(); return records.filter((r) => [r.requestNo,r.residentName,r.documentType,r.purpose].join(" ").toLowerCase().includes(q) && ($("statusFilter").value === "All" || r.status === $("statusFilter").value)).sort((a, b) => new Date(b.requestDate || b.createdAt || 0) - new Date(a.requestDate || a.createdAt || 0)); }
    function render() { const rows = filtered(); const pageSize = getPageSize(); const paged = rows.slice((currentPage - 1) * pageSize, currentPage * pageSize); const logs = JSON.parse(localStorage.getItem(logKey) || "[]"); $("tableBody").innerHTML = paged.map((r) => `<tr class="hover:bg-gray-50"><td class="px-5 py-4 font-semibold text-blue-800">${r.requestNo}</td><td class="px-5 py-4">${r.residentName}</td><td class="px-5 py-4 text-slate-600">${r.documentType}</td><td class="px-5 py-4 text-slate-600">${r.purpose}</td><td class="px-5 py-4"><span class="rounded-full ${badge(r.status)} px-3 py-1 text-xs font-semibold">${r.status}</span></td><td class="px-5 py-4 text-right"><button data-id="${r.requestNo}" class="view rounded-lg px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-gray-100">View</button></td></tr>`).join(""); $("emptyState").classList.toggle("hidden", rows.length > 0); $("totalCount").textContent = records.length; $("pendingCount").textContent = records.filter((r) => r.status === "Pending").length; $("releaseCount").textContent = records.filter((r) => r.status === "For Release").length; $("releasedCount").textContent = logs.filter((item) => item.module === "Certificate & Document Management" && item.result === "Released").length; $("archivedCount").textContent = records.filter((r) => r.status === "Archived").length; renderPagination(rows.length); lucide.createIcons(); }
    function openConfirm(title, message, action) { pendingAction = action; $("confirmIcon").innerHTML = '<i data-lucide="circle-help" class="h-6 w-6"></i>'; $("confirmIcon").className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"; $("confirmTitle").textContent = title; $("confirmMessage").textContent = message; $("confirmActions").classList.remove("hidden"); $("successActions").classList.add("hidden"); $("confirmModal").classList.replace("hidden","flex"); document.body.classList.add("modal-open"); lucide.createIcons(); }
    function success(message) { $("confirmIcon").innerHTML = '<i data-lucide="circle-check" class="h-6 w-6"></i>'; $("confirmIcon").className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white"; $("confirmTitle").textContent = "Success"; $("confirmMessage").textContent = message; $("confirmActions").classList.add("hidden"); $("successActions").classList.remove("hidden"); $("confirmModal").classList.replace("hidden","flex"); document.body.classList.add("modal-open"); lucide.createIcons(); }
    function closeConfirm() { $("confirmModal").classList.add("hidden"); $("confirmModal").classList.remove("flex"); document.body.classList.remove("modal-open"); if (successRedirect) location.href = successRedirect; pendingAction = null; }
    function openDetail(requestNo) { const r = records.find((item) => item.requestNo === requestNo); if (!r) return; selectedRequestNo = requestNo; $("detailId").textContent = r.requestNo; $("detailTitle").textContent = r.residentName; $("detailMeta").textContent = `${r.documentType} • ${r.status}`; $("archiveRequestButton").textContent = r.status === "Archived" ? "Restore" : "Archive"; $("detailContent").innerHTML = [["Document", r.documentType], ["Request Date", formatDate(r.requestDate)], ["Status", r.status], ["Purpose", r.purpose]].map(([label, value]) => `<div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 ${label === "Purpose" ? "sm:col-span-2" : ""}"><p class="text-xs font-semibold uppercase tracking-[0.16em] text-blue-700">${label}</p><p class="mt-2 text-sm font-medium text-slate-800">${value}</p></div>`).join(""); $("detailModal").classList.replace("hidden", "flex"); document.body.classList.add("modal-open"); }
    function closeDetail() { $("detailModal").classList.add("hidden"); $("detailModal").classList.remove("flex"); document.body.classList.remove("modal-open"); }
    $("addButton").onclick = () => openForm(); document.querySelectorAll(".closeForm").forEach((btn) => btn.onclick = closeForm); $("searchInput").oninput = () => { currentPage = 1; render(); }; $("statusFilter").onchange = () => { currentPage = 1; render(); };
    $("pagination").onclick = (event) => { const btn = event.target.closest(".page-button"); if (!btn) return; currentPage = Number(btn.dataset.page); render(); };
    window.addEventListener("resize", () => { currentPage = 1; render(); });
    $("tableBody").onclick = (e) => { const view = e.target.closest(".view"); if (view) openDetail(view.dataset.id); };
    $("closeDetail").onclick = closeDetail;
    $("editRequestButton").onclick = () => { const item = records.find((r) => r.requestNo === selectedRequestNo); closeDetail(); openForm(item); };
    $("forReleaseRequestButton").onclick = () => openConfirm("Update request", "Mark this request as For Release?", () => { records = records.map((r) => r.requestNo === selectedRequestNo ? { ...r, status: "For Release", updatedAt: new Date().toISOString() } : r); save(); closeDetail(); render(); success("Document request status updated."); });
    $("releaseRequestButton").onclick = () => openConfirm("Update request", "Mark this request as Released?", () => { const item = records.find((r) => r.requestNo === selectedRequestNo); if (!item) return; moveRequestToLogs({ ...item, updatedAt: new Date().toISOString() }, "Released"); records = records.filter((r) => r.requestNo !== selectedRequestNo); save(); closeDetail(); currentPage = 1; render(); success("Released request moved to Logs History."); });
    $("archiveRequestButton").onclick = () => { const current = records.find((r) => r.requestNo === selectedRequestNo); const nextStatus = current.status === "Archived" ? "Pending" : "Archived"; openConfirm(nextStatus === "Archived" ? "Archive request" : "Restore request", `Proceed to ${nextStatus === "Archived" ? "archive" : "restore"} this request?`, () => { records = records.map((r) => r.requestNo === selectedRequestNo ? { ...r, status: nextStatus, updatedAt: new Date().toISOString() } : r); save(); closeDetail(); render(); success(nextStatus === "Archived" ? "Document request archived successfully." : "Document request restored successfully."); }); };
    $("deleteRequestButton").onclick = () => openConfirm("Delete request", "Proceed to delete this document request?", () => { records = records.filter((r) => r.requestNo !== selectedRequestNo); save(); closeDetail(); currentPage = 1; render(); success("Document request deleted successfully."); });
    $("recordForm").onsubmit = (e) => { e.preventDefault(); const data = values(); openConfirm("Save request", "Proceed to save this document request?", () => { records = $("editingId").value ? records.map((r) => r.requestNo === $("editingId").value ? { ...r, ...data, updatedAt: new Date().toISOString() } : r) : [{ ...data, status: "Pending", requestNo: nextId(), createdAt: new Date().toISOString() }, ...records]; save(); closeForm(); render(); success("Document request saved successfully."); }); };
    $("logoutButton").onclick = () => openConfirm("Confirm logout", "Proceed with logout?", () => { localStorage.removeItem("bimsUser"); window.location.href = "index.html"; });
    $("cancelConfirm").onclick = closeConfirm; $("closeSuccess").onclick = closeConfirm; $("proceedConfirm").onclick = () => typeof pendingAction === "function" && pendingAction();
    migrateReleasedRequests();
    render();
  </script>
</body>
</html>
