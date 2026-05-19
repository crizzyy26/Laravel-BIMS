<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Management</title>
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
        <a href="event-management.html" class="nav-active"><i data-lucide="calendar-days" class="h-4 w-4"></i>Event Management</a>
        <a href="certificate-document-management.html" class="nav"><i data-lucide="file-check-2" class="h-4 w-4"></i>Certificate & Document Management</a>
        <a href="officials-management.html" class="nav"><i data-lucide="landmark" class="h-4 w-4"></i>Officials Management</a>
        <a href="logs-history.html" class="nav"><i data-lucide="history" class="h-4 w-4"></i>Logs History</a>
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
            <p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-700">Event Management</p>
            <h2 class="mt-2 text-2xl font-bold text-blue-950">Barangay Events</h2>
          </div>
          <button id="addButton" class="flex h-11 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-gray-700"><i data-lucide="plus" class="h-4 w-4"></i>Add Event</button>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-4">
          <div class="card"><p>Total Events</p><h3 id="totalEvents">0</h3></div>
          <div class="card"><p>Upcoming</p><h3 id="upcomingEvents">0</h3></div>
          <div class="card"><p>Completed</p><h3 id="completedEvents">0</h3></div>
          <div class="card"><p>Archived</p><h3 id="archivedEvents">0</h3></div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-5">
          <p class="text-sm font-semibold text-blue-950">Simple workflow</p>
          <p class="mt-2 text-sm text-slate-600">Create an event schedule, update event details when needed, mark it finished or cancelled, then archive or delete records after review.</p>
        </div>

        <div class="mt-6 grid gap-3 lg:grid-cols-[1fr_220px]">
          <div class="relative"><i data-lucide="search" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i><input id="searchInput" class="h-12 w-full rounded-xl border border-blue-100 pl-12 pr-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Search title, venue, organizer" /></div>
          <select id="statusFilter" class="h-12 rounded-xl border border-blue-100 px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"><option>All</option><option>Scheduled</option><option>Cancelled</option><option>Archived</option></select>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-blue-100">
          <table class="w-full min-w-[780px] text-left text-sm">
            <thead class="bg-blue-50 text-xs uppercase tracking-[0.16em] text-blue-800"><tr><th class="px-5 py-4">Event ID</th><th class="px-5 py-4">Title</th><th class="px-5 py-4">Date</th><th class="px-5 py-4">Venue</th><th class="px-5 py-4">Status</th><th class="px-5 py-4 text-right">Action</th></tr></thead>
            <tbody id="tableBody" class="divide-y divide-blue-50"></tbody>
          </table>
          <div id="emptyState" class="hidden p-8 text-center text-sm text-slate-500">No event records found.</div>
        </div>
        <div id="pagination" class="mt-4 flex flex-wrap items-center justify-end gap-2"></div>
      </section>
    </main>
  </div>

  <div id="formModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[92vh] w-full max-w-3xl overflow-y-auto rounded-3xl bg-white shadow-2xl">
      <div class="flex items-center justify-between border-b border-blue-100 p-5"><h3 id="formTitle" class="text-xl font-bold text-blue-950">Add Event</h3><button class="closeForm rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100 hover:text-slate-900">Close</button></div>
      <form id="recordForm" class="grid gap-5 p-5 lg:grid-cols-2">
        <input id="editingId" type="hidden" />
        <label class="space-y-2 text-sm font-medium text-blue-950">Event Title<input id="title" required class="field" /></label>
        <label class="space-y-2 text-sm font-medium text-blue-950">Event Type<select id="type" required class="field"><option value="">Select</option><option>Meeting</option><option>Cleanup Drive</option><option>Health Program</option><option>Seminar</option><option>Community Activity</option></select></label>
        <label class="space-y-2 text-sm font-medium text-blue-950">Date<input id="date" type="date" required class="field" /></label>
        <label class="space-y-2 text-sm font-medium text-blue-950">Time<input id="time" type="time" required class="field" /></label>
        <label class="space-y-2 text-sm font-medium text-blue-950">Venue<input id="venue" required class="field" /></label>
        <label class="space-y-2 text-sm font-medium text-blue-950">Organizer<input id="organizer" required class="field" /></label>
        <label class="space-y-2 text-sm font-medium text-blue-950 lg:col-span-2">Description<textarea id="description" rows="4" class="field min-h-28 py-3"></textarea></label>
        <div class="flex justify-end gap-3 border-t border-blue-100 pt-5 lg:col-span-2"><button type="button" class="closeForm h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold hover:bg-gray-100">Cancel</button><button class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Save Event</button></div>
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
        <button id="deleteEventButton" class="h-11 rounded-xl border border-red-100 px-5 text-sm font-semibold text-red-600 hover:bg-gray-100">Delete</button>
        <button id="archiveEventButton" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Archive</button>
        <button id="cancelEventButton" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Cancel</button>
        <button id="finishEventButton" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold text-emerald-700 hover:bg-gray-100">Finish</button>
        <button id="editEventButton" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Edit</button>
      </div>
    </div>
  </div>

  <div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/40 p-4"><div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl"><div id="confirmIcon" class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"><i data-lucide="circle-help" class="h-6 w-6"></i></div><h2 id="confirmTitle" class="text-xl font-bold text-blue-950">Confirm action</h2><p id="confirmMessage" class="mt-3 text-sm text-slate-600">Proceed?</p><div id="confirmActions" class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end"><button id="cancelConfirm" class="h-11 rounded-xl border border-blue-100 px-5 text-sm font-semibold hover:bg-gray-100">Cancel</button><button id="proceedConfirm" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Proceed</button></div><div id="successActions" class="mt-7 hidden"><button id="closeSuccess" class="h-11 w-full rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Done</button></div></div></div>

  <script>
    const $ = (id) => document.getElementById(id);
    document.querySelectorAll(".nav").forEach((el) => el.className = "flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900");
    document.querySelectorAll(".nav-active").forEach((el) => el.className = "flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-sm font-semibold text-blue-800");
    document.querySelectorAll(".field").forEach((el) => el.className = "field h-11 w-full rounded-xl border border-blue-100 px-4 text-sm font-normal text-slate-900 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100");
    document.querySelectorAll(".card").forEach((el) => el.className = "card rounded-2xl border border-blue-100 bg-white p-5");
    document.querySelectorAll(".card p").forEach((el) => el.className = "text-sm font-medium text-slate-600");
    document.querySelectorAll(".card h3").forEach((el) => el.className = "mt-2 text-3xl font-bold text-blue-950");

    const key = "bimsEvents";
    const logKey = "bimsLogs";
    let records = JSON.parse(localStorage.getItem(key) || "[]");
    let pendingAction = null;
    let successRedirect = "";
    let currentPage = 1;
    let selectedEventId = "";
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

    const save = () => localStorage.setItem(key, JSON.stringify(records));
    const saveLog = (entry) => {
      const logs = JSON.parse(localStorage.getItem(logKey) || "[]");
      logs.unshift(entry);
      localStorage.setItem(logKey, JSON.stringify(logs));
    };
    const moveEventToLogs = (item, result) => {
      saveLog({
        id: `LOG-${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
        module: "Event Management",
        reference: item.eventId,
        record: item.title,
        result,
        date: item.date || new Date().toISOString().split("T")[0],
        details: {
          eventId: item.eventId,
          title: item.title,
          type: item.type,
          date: item.date,
          time: item.time,
          venue: item.venue,
          organizer: item.organizer,
          status: result,
          description: item.description || "N/A",
          completedAt: new Date().toISOString()
        },
        createdAt: new Date().toISOString()
      });
    };
    const migrateEndedEvents = () => {
      const ended = records.filter((item) => item.status === "Completed");
      if (!ended.length) return;
      ended.forEach((item) => moveEventToLogs(item, "Completed"));
      records = records.filter((item) => item.status !== "Completed");
      save();
    };
    const id = () => `EVT-${new Date().getFullYear()}-${String(records.length + 1).padStart(4, "0")}`;
    const badge = (value) => value === "Completed" ? "bg-emerald-50 text-emerald-700" : value === "Cancelled" || value === "Archived" ? "bg-slate-100 text-slate-600" : "bg-blue-50 text-blue-700";
    const getPageSize = () => window.innerWidth < 640 ? 4 : window.innerWidth < 1024 ? 6 : window.innerWidth < 1440 ? 8 : 10;
    const formatDate = (value) => value ? new Date(`${value}T00:00:00`).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" }) : "N/A";
    function renderPagination(totalItems) {
      const pageSize = getPageSize();
      const totalPages = Math.max(1, Math.ceil(totalItems / pageSize));
      currentPage = Math.min(currentPage, totalPages);
      const pages = Array.from({ length: totalPages }, (_, index) => index + 1);
      $("pagination").innerHTML = totalItems <= pageSize ? "" : pages.map((page) => `<button type="button" data-page="${page}" class="page-button h-9 min-w-9 rounded-lg border px-3 text-sm font-semibold ${page === currentPage ? "border-blue-600 bg-blue-600 text-white" : "border-blue-100 bg-white text-slate-700 hover:bg-gray-100"}">${page}</button>`).join("");
    }
    const openForm = (record = null) => {
      $("recordForm").reset(); $("editingId").value = record?.eventId || ""; $("formTitle").textContent = record ? "Edit Event" : "Add Event";
      if (record) ["title","type","date","time","venue","organizer","description"].forEach((field) => document.getElementById(field).value = record[field] || "");
      $("formModal").classList.replace("hidden", "flex"); document.body.classList.add("modal-open"); lucide.createIcons();
    };
    const closeForm = () => { $("formModal").classList.add("hidden"); $("formModal").classList.remove("flex"); document.body.classList.remove("modal-open"); };
    const filtered = () => records.filter((r) => [r.eventId,r.title,r.venue,r.organizer].join(" ").toLowerCase().includes($("searchInput").value.toLowerCase()) && ($("statusFilter").value === "All" || r.status === $("statusFilter").value)).sort((a, b) => new Date(b.date || b.createdAt || 0) - new Date(a.date || a.createdAt || 0));
    function render() {
      const rows = filtered();
      const pageSize = getPageSize();
      const paged = rows.slice((currentPage - 1) * pageSize, currentPage * pageSize);
      $("tableBody").innerHTML = paged.map((r) => `<tr class="hover:bg-gray-50"><td class="px-5 py-4 font-semibold text-blue-800">${r.eventId}</td><td class="px-5 py-4">${r.title}</td><td class="px-5 py-4 text-slate-600">${formatDate(r.date)}</td><td class="px-5 py-4 text-slate-600">${r.venue}</td><td class="px-5 py-4"><span class="rounded-full ${badge(r.status)} px-3 py-1 text-xs font-semibold">${r.status}</span></td><td class="px-5 py-4 text-right"><button data-id="${r.eventId}" class="view rounded-lg px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-gray-100">View</button></td></tr>`).join("");
      $("emptyState").classList.toggle("hidden", rows.length > 0);
      const logs = JSON.parse(localStorage.getItem(logKey) || "[]");
      $("totalEvents").textContent = records.length; $("upcomingEvents").textContent = records.filter((r) => r.status === "Scheduled").length; $("completedEvents").textContent = logs.filter((item) => item.module === "Event Management" && item.result === "Completed").length; $("archivedEvents").textContent = records.filter((r) => r.status === "Archived").length; renderPagination(rows.length); lucide.createIcons();
    }
    function openConfirm(title, message, action) { pendingAction = action; $("confirmIcon").innerHTML = '<i data-lucide="circle-help" class="h-6 w-6"></i>'; $("confirmIcon").className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"; $("confirmTitle").textContent = title; $("confirmMessage").textContent = message; $("confirmActions").classList.remove("hidden"); $("successActions").classList.add("hidden"); $("confirmModal").classList.replace("hidden", "flex"); document.body.classList.add("modal-open"); lucide.createIcons(); }
    function success(message) { $("confirmIcon").innerHTML = '<i data-lucide="circle-check" class="h-6 w-6"></i>'; $("confirmIcon").className = "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white"; $("confirmTitle").textContent = "Success"; $("confirmMessage").textContent = message; $("confirmActions").classList.add("hidden"); $("successActions").classList.remove("hidden"); $("confirmModal").classList.replace("hidden", "flex"); document.body.classList.add("modal-open"); lucide.createIcons(); }
    function closeConfirm() { $("confirmModal").classList.add("hidden"); $("confirmModal").classList.remove("flex"); document.body.classList.remove("modal-open"); if (successRedirect) location.href = successRedirect; pendingAction = null; }
    function openDetail(eventId) { const r = records.find((item) => item.eventId === eventId); if (!r) return; selectedEventId = eventId; $("detailId").textContent = r.eventId; $("detailTitle").textContent = r.title; $("detailMeta").textContent = `${formatDate(r.date)} • ${r.venue} • ${r.status}`; $("archiveEventButton").textContent = r.status === "Archived" ? "Restore" : "Archive"; $("detailContent").innerHTML = [["Type", r.type], ["Time", r.time], ["Organizer", r.organizer], ["Status", r.status], ["Description", r.description || "N/A"]].map(([label, value]) => `<div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 ${label === "Description" ? "sm:col-span-2" : ""}"><p class="text-xs font-semibold uppercase tracking-[0.16em] text-blue-700">${label}</p><p class="mt-2 text-sm font-medium text-slate-800">${value}</p></div>`).join(""); $("detailModal").classList.replace("hidden", "flex"); document.body.classList.add("modal-open"); }
    function closeDetail() { $("detailModal").classList.add("hidden"); $("detailModal").classList.remove("flex"); document.body.classList.remove("modal-open"); }

    $("addButton").onclick = () => openForm();
    document.querySelectorAll(".closeForm").forEach((btn) => btn.onclick = closeForm);
    $("searchInput").oninput = () => { currentPage = 1; render(); }; $("statusFilter").onchange = () => { currentPage = 1; render(); };
    $("pagination").onclick = (event) => { const btn = event.target.closest(".page-button"); if (!btn) return; currentPage = Number(btn.dataset.page); render(); };
    window.addEventListener("resize", () => { currentPage = 1; render(); });
    $("tableBody").onclick = (event) => { const view = event.target.closest(".view"); if (view) openDetail(view.dataset.id); };
    $("closeDetail").onclick = closeDetail;
    $("editEventButton").onclick = () => { const item = records.find((r) => r.eventId === selectedEventId); closeDetail(); openForm(item); };
    $("finishEventButton").onclick = () => openConfirm("Finish event", "Mark this event as completed?", () => { const item = records.find((r) => r.eventId === selectedEventId); if (!item) return; moveEventToLogs({ ...item, updatedAt: new Date().toISOString() }, "Completed"); records = records.filter((r) => r.eventId !== selectedEventId); save(); closeDetail(); currentPage = 1; render(); success("Completed event moved to Logs History."); });
    $("cancelEventButton").onclick = () => openConfirm("Cancel event", "Mark this event as cancelled?", () => { records = records.map((r) => r.eventId === selectedEventId ? { ...r, status: "Cancelled", updatedAt: new Date().toISOString() } : r); save(); closeDetail(); render(); success("Event cancelled successfully."); });
    $("archiveEventButton").onclick = () => { const current = records.find((r) => r.eventId === selectedEventId); const nextStatus = current.status === "Archived" ? "Scheduled" : "Archived"; openConfirm(nextStatus === "Archived" ? "Archive event" : "Restore event", `Proceed to ${nextStatus === "Archived" ? "archive" : "restore"} this event?`, () => { records = records.map((r) => r.eventId === selectedEventId ? { ...r, status: nextStatus, updatedAt: new Date().toISOString() } : r); save(); closeDetail(); render(); success(nextStatus === "Archived" ? "Event archived successfully." : "Event restored successfully."); }); };
    $("deleteEventButton").onclick = () => openConfirm("Delete event", "Proceed to delete this event?", () => { records = records.filter((r) => r.eventId !== selectedEventId); save(); closeDetail(); currentPage = 1; render(); success("Event deleted successfully."); });
    $("recordForm").onsubmit = (event) => {
      event.preventDefault();
      const data = { title: $("title").value.trim(), type: $("type").value, date: $("date").value, time: $("time").value, venue: $("venue").value.trim(), organizer: $("organizer").value.trim(), description: $("description").value.trim() };
      openConfirm("Save event", "Proceed to save this event?", () => {
        records = $("editingId").value ? records.map((r) => r.eventId === $("editingId").value ? { ...r, ...data, updatedAt: new Date().toISOString() } : r) : [{ ...data, status: "Scheduled", eventId: id(), createdAt: new Date().toISOString() }, ...records];
        save(); closeForm(); render(); success("Event saved successfully.");
      });
    };
    $("logoutButton").onclick = () => openConfirm("Confirm logout", "Proceed with logout?", () => { localStorage.removeItem("bimsUser"); window.location.href = "index.html"; });
    $("cancelConfirm").onclick = closeConfirm; $("closeSuccess").onclick = closeConfirm; $("proceedConfirm").onclick = () => typeof pendingAction === "function" && pendingAction();
    migrateEndedEvents();
    render();
  </script>
</body>
</html>
