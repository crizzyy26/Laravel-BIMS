<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resident Management</title>
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
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-white px-4 py-5 shadow-sm">
      <div class="mb-7 border-b border-blue-100 pb-5">
        <h1 class="pr-10 text-base font-bold leading-snug text-blue-950">Barangay Information Management System</h1>
      </div>

      <nav class="space-y-1.5">
        <a href="dashboard.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="layout-dashboard" class="h-4 w-4"></i>Dashboard</a>
        <a href="resident-management.html" class="flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-sm font-semibold text-blue-800"><i data-lucide="users-round" class="h-4 w-4"></i>Resident Management</a>
        <a href="blotter-management.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-gray-100 hover:text-slate-900"><i data-lucide="file-warning" class="h-4 w-4"></i>Blotter Management</a>
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
      <section class="min-h-screen bg-white p-6 pt-20 sm:p-8 lg:pt-8">
        <div class="flex flex-col gap-4 border-b border-blue-100 pb-6 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-700">Resident Management</p>
            <h2 class="mt-2 text-2xl font-bold text-blue-950">Residents</h2>
          </div>
          <div class="flex flex-col gap-3 sm:flex-row">
            <button id="addResidentButton" type="button" class="flex h-11 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-gray-700">
              <i data-lucide="plus" class="h-4 w-4"></i>
              Add Resident
            </button>
          </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
            <p class="text-sm font-medium text-slate-600">Total Residents</p>
            <h3 id="totalResidents" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <p class="text-sm font-medium text-slate-600">Registered Voters</p>
            <h3 id="totalVoters" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <p class="text-sm font-medium text-slate-600">Senior Citizens</p>
            <h3 id="totalSeniors" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
          <div class="rounded-2xl border border-blue-100 bg-white p-5">
            <p class="text-sm font-medium text-slate-600">Archived</p>
            <h3 id="totalArchived" class="mt-2 text-3xl font-bold text-blue-950">0</h3>
          </div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-5">
          <p class="text-sm font-semibold text-blue-950">Simple workflow</p>
          <p class="mt-2 text-sm text-slate-600">Register resident details, review the profile, update information when needed, then archive or delete records when no longer active.</p>
        </div>

        <div class="mt-6 grid gap-3 lg:grid-cols-[1fr_220px_220px]">
          <div class="relative">
            <i data-lucide="search" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>
            <input id="searchInput" type="search" placeholder="Search name, resident ID, purok, household ID" class="h-12 w-full rounded-xl border border-blue-100 bg-white pl-12 pr-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100" />
          </div>
          <select id="statusFilter" class="h-12 rounded-xl border border-blue-100 bg-white px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            <option value="Active">Active</option>
            <option value="Archived">Archived</option>
            <option value="All">All Status</option>
          </select>
          <select id="purokFilter" class="h-12 rounded-xl border border-blue-100 bg-white px-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            <option value="All">All Purok</option>
          </select>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-blue-100">
          <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-left text-sm">
              <thead class="bg-blue-50 text-xs uppercase tracking-[0.16em] text-blue-800">
                <tr>
                  <th class="px-5 py-4 font-semibold">Resident ID</th>
                  <th class="px-5 py-4 font-semibold">Name</th>
                  <th class="px-5 py-4 font-semibold">Age</th>
                  <th class="px-5 py-4 font-semibold">Purok</th>
                  <th class="px-5 py-4 font-semibold">Voter</th>
                  <th class="px-5 py-4 font-semibold">Status</th>
                  <th class="px-5 py-4 text-right font-semibold">Action</th>
                </tr>
              </thead>
              <tbody id="residentTable" class="divide-y divide-blue-50 bg-white"></tbody>
            </table>
          </div>
          <div id="emptyState" class="hidden p-8 text-center text-sm text-slate-500">No resident records found.</div>
        </div>
        <div id="pagination" class="mt-4 flex flex-wrap items-center justify-end gap-2"></div>
      </section>
    </main>
  </div>

  <div id="residentModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[92vh] w-full max-w-5xl overflow-y-auto rounded-3xl border border-blue-100 bg-white shadow-2xl">
      <div class="sticky top-0 z-10 flex items-center justify-between border-b border-blue-100 bg-white p-5">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">Resident Record</p>
          <h3 id="residentModalTitle" class="mt-1 text-xl font-bold text-blue-950">Add Resident</h3>
        </div>
        <button type="button" class="close-resident-modal rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100 hover:text-slate-900">Close</button>
      </div>

      <form id="residentForm" class="p-5">
        <input id="editingId" type="hidden" />
        <div class="grid gap-5 lg:grid-cols-3">
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">First Name</label>
            <input id="firstName" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Middle Name</label>
            <input id="middleName" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Last Name</label>
            <input id="lastName" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Gender</label>
            <select id="gender" required class="field"><option value="">Select</option><option>Male</option><option>Female</option></select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Birthdate</label>
            <input id="birthdate" type="date" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Civil Status</label>
            <select id="civilStatus" required class="field"><option value="">Select</option><option>Single</option><option>Married</option><option>Widowed</option><option>Separated</option></select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Nationality</label>
            <input id="nationality" required value="Filipino" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Mobile Number</label>
            <input id="mobileNumber" required placeholder="09XXXXXXXXX" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Email Address</label>
            <input id="email" type="email" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">House Number</label>
            <input id="houseNumber" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Street</label>
            <input id="street" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Purok/Zone</label>
            <input id="purok" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Municipality/City</label>
            <input id="municipality" required value="Davao City" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Province</label>
            <input id="province" required value="Davao del Sur" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Residency Type</label>
            <select id="residentStatus" required class="field"><option>Permanent</option><option>Temporary</option></select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Voter Status</label>
            <select id="voterStatus" required class="field"><option>Registered Voter</option><option>Non-Voter</option></select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Years of Residency</label>
            <input id="yearsOfResidency" type="number" min="0" required class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Occupation</label>
            <input id="occupation" class="field" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Employment Status</label>
            <select id="employmentStatus" class="field"><option value="">Select</option><option>Employed</option><option>Self-employed</option><option>Unemployed</option><option>Student</option><option>Retired</option></select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Monthly Income</label>
            <select id="monthlyIncome" class="field"><option value="">Select</option><option>Below 10,000</option><option>10,000 - 20,000</option><option>20,001 - 40,000</option><option>Above 40,000</option></select>
          </div>
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-950">Classification</label>
            <select id="classification" class="field">
              <option>None</option>
              <option>Senior Citizen</option>
              <option>PWD</option>
              <option>Solo Parent</option>
              <option>Indigent</option>
            </select>
          </div>
        </div>

        <div class="mt-6 flex flex-col-reverse gap-3 border-t border-blue-100 pt-5 sm:flex-row sm:justify-end">
          <button type="button" class="close-resident-modal h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Cancel</button>
          <button type="submit" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Save Resident</button>
        </div>
      </form>
    </div>
  </div>

  <div id="profileModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-blue-950/40 p-4">
    <div class="max-h-[92vh] w-full max-w-3xl overflow-y-auto rounded-3xl border border-blue-100 bg-white p-6 shadow-2xl">
      <div class="flex items-start justify-between gap-4">
        <div>
          <p id="profileResidentId" class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-700"></p>
          <h3 id="profileName" class="mt-2 text-2xl font-bold text-blue-950"></h3>
          <p id="profileMeta" class="mt-1 text-sm text-slate-600"></p>
        </div>
        <button type="button" id="closeProfile" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-gray-100 hover:text-slate-900">Close</button>
      </div>
      <div id="profileDetails" class="mt-6 grid gap-4 sm:grid-cols-2"></div>
      <div class="mt-6 flex flex-col-reverse gap-3 border-t border-blue-100 pt-5 sm:flex-row sm:justify-end">
        <button id="deleteResidentButton" type="button" class="h-11 rounded-xl border border-red-100 bg-white px-5 text-sm font-semibold text-red-600 hover:bg-gray-100">Delete</button>
        <button id="archiveResidentButton" type="button" class="h-11 rounded-xl border border-blue-100 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-gray-100">Archive</button>
        <button id="editResidentButton" type="button" class="h-11 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-gray-700">Edit</button>
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
    const storageKey = "bimsResidents";
    const adminName = document.getElementById("adminName");
    const residentForm = document.getElementById("residentForm");
    const residentTable = document.getElementById("residentTable");
    const emptyState = document.getElementById("emptyState");
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const purokFilter = document.getElementById("purokFilter");
    const residentModal = document.getElementById("residentModal");
    const profileModal = document.getElementById("profileModal");
    const confirmModal = document.getElementById("confirmModal");
    const confirmIcon = document.getElementById("confirmIcon");
    const confirmTitle = document.getElementById("confirmTitle");
    const confirmMessage = document.getElementById("confirmMessage");
    const confirmActions = document.getElementById("confirmActions");
    const successActions = document.getElementById("successActions");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarBackdrop = document.getElementById("sidebarBackdrop");

    let residents = JSON.parse(localStorage.getItem(storageKey) || "[]");
    let selectedResidentId = "";
    let pendingAction = null;
    let currentPage = 1;

    adminName.textContent = localStorage.getItem("bimsUser") || "admin";
    document.getElementById("birthdate").max = new Date().toISOString().split("T")[0];

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

    function saveResidents() {
      localStorage.setItem(storageKey, JSON.stringify(residents));
    }

    function getAge(birthdate) {
      const today = new Date();
      const birth = new Date(birthdate);
      let age = today.getFullYear() - birth.getFullYear();
      const month = today.getMonth() - birth.getMonth();
      if (month < 0 || (month === 0 && today.getDate() < birth.getDate())) age--;
      return age;
    }

    function formatDate(value) {
      if (!value) return "N/A";
      return new Date(`${value}T00:00:00`).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" });
    }

    function fullName(resident) {
      return [resident.firstName, resident.middleName, resident.lastName].filter(Boolean).join(" ");
    }

    function generateResidentId() {
      const year = new Date().getFullYear();
      const count = residents.filter((resident) => resident.residentId.startsWith(`RES-${year}`)).length + 1;
      return `RES-${year}-${String(count).padStart(4, "0")}`;
    }

    function renderStats() {
      const active = residents.filter((resident) => resident.status === "Active");
      document.getElementById("totalResidents").textContent = active.length;
      document.getElementById("totalVoters").textContent = active.filter((resident) => resident.voterStatus === "Registered Voter").length;
      document.getElementById("totalSeniors").textContent = active.filter((resident) => resident.classification === "Senior Citizen").length;
      document.getElementById("totalArchived").textContent = residents.filter((resident) => resident.status === "Archived").length;
    }

    function renderPurokFilter() {
      const current = purokFilter.value;
      const puroks = [...new Set(residents.map((resident) => resident.purok).filter(Boolean))].sort();
      purokFilter.innerHTML = '<option value="All">All Purok</option>' + puroks.map((purok) => `<option value="${purok}">${purok}</option>`).join("");
      purokFilter.value = puroks.includes(current) ? current : "All";
    }

    function getFilteredResidents() {
      const query = searchInput.value.trim().toLowerCase();
      return residents.filter((resident) => {
        const searchable = [resident.residentId, fullName(resident), resident.purok].join(" ").toLowerCase();
        const matchesSearch = !query || searchable.includes(query);
        const matchesStatus = statusFilter.value === "All" || resident.status === statusFilter.value;
        const matchesPurok = purokFilter.value === "All" || resident.purok === purokFilter.value;
        return matchesSearch && matchesStatus && matchesPurok;
      }).sort((a, b) => new Date(b.createdAt || b.updatedAt || 0) - new Date(a.createdAt || a.updatedAt || 0));
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
      const filteredResidents = getFilteredResidents();
      const pageSize = getPageSize();
      const pagedResidents = filteredResidents.slice((currentPage - 1) * pageSize, currentPage * pageSize);
      residentTable.innerHTML = pagedResidents.map((resident) => `
        <tr class="hover:bg-gray-50">
          <td class="px-5 py-4 font-semibold text-blue-800">${resident.residentId}</td>
          <td class="px-5 py-4 text-slate-800">${fullName(resident)}</td>
          <td class="px-5 py-4 text-slate-600">${getAge(resident.birthdate)}</td>
          <td class="px-5 py-4 text-slate-600">${resident.purok}</td>
          <td class="px-5 py-4 text-slate-600">${resident.voterStatus}</td>
          <td class="px-5 py-4"><span class="rounded-full ${resident.status === "Active" ? "bg-blue-50 text-blue-700" : "bg-slate-100 text-slate-600"} px-3 py-1 text-xs font-semibold">${resident.status}</span></td>
          <td class="px-5 py-4 text-right">
            <button type="button" data-id="${resident.residentId}" class="view-resident rounded-lg px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-gray-100">View</button>
          </td>
        </tr>
      `).join("");
      emptyState.classList.toggle("hidden", filteredResidents.length > 0);
      renderStats();
      renderPurokFilter();
      renderPagination(filteredResidents.length);
      lucide.createIcons();
    }

    function openResidentModal(resident = null) {
      residentForm.reset();
      document.getElementById("editingId").value = resident ? resident.residentId : "";
      document.getElementById("residentModalTitle").textContent = resident ? "Edit Resident" : "Add Resident";
      document.getElementById("nationality").value = resident?.nationality || "Filipino";
      document.getElementById("municipality").value = resident?.municipality || "Davao City";
      document.getElementById("province").value = resident?.province || "Davao del Sur";

      if (resident) {
        Object.keys(resident).forEach((key) => {
          const field = document.getElementById(key);
          if (!field) return;
          if (field.type === "checkbox") field.checked = Boolean(resident[key]);
          else field.value = resident[key] ?? "";
        });
      }

      residentModal.classList.remove("hidden");
      residentModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeResidentModal() {
      residentModal.classList.add("hidden");
      residentModal.classList.remove("flex");
      document.body.classList.remove("modal-open");
    }

    function openProfile(residentId) {
      const resident = residents.find((item) => item.residentId === residentId);
      if (!resident) return;
      selectedResidentId = residentId;
      document.getElementById("profileResidentId").textContent = resident.residentId;
      document.getElementById("profileName").textContent = fullName(resident);
      document.getElementById("profileMeta").textContent = `${getAge(resident.birthdate)} years old • ${resident.purok} • ${resident.status}`;
      document.getElementById("archiveResidentButton").textContent = resident.status === "Archived" ? "Restore" : "Archive";
      document.getElementById("profileDetails").innerHTML = [
        ["Gender", resident.gender],
        ["Birthdate", formatDate(resident.birthdate)],
        ["Civil Status", resident.civilStatus],
        ["Mobile Number", resident.mobileNumber],
        ["Address", `${resident.houseNumber} ${resident.street}, ${resident.purok}, ${resident.municipality}`],
        ["Residency Type", resident.residentStatus],
        ["Voter Status", resident.voterStatus],
        ["Occupation", resident.occupation || "N/A"],
        ["Classification", resident.classification || "None"]
      ].map(([label, value]) => `<div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4"><p class="text-xs font-semibold uppercase tracking-[0.16em] text-blue-700">${label}</p><p class="mt-2 text-sm font-medium text-slate-800">${value}</p></div>`).join("");
      profileModal.classList.remove("hidden");
      profileModal.classList.add("flex");
      document.body.classList.add("modal-open");
      lucide.createIcons();
    }

    function closeProfile() {
      profileModal.classList.add("hidden");
      profileModal.classList.remove("flex");
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
    }

    function getFormData() {
      return {
        firstName: firstName.value.trim(),
        middleName: middleName.value.trim(),
        lastName: lastName.value.trim(),
        gender: gender.value,
        birthdate: birthdate.value,
        civilStatus: civilStatus.value,
        nationality: nationality.value.trim(),
        mobileNumber: mobileNumber.value.trim(),
        email: email.value.trim(),
        houseNumber: houseNumber.value.trim(),
        street: street.value.trim(),
        purok: purok.value.trim(),
        municipality: municipality.value.trim(),
        province: province.value.trim(),
        residentStatus: residentStatus.value,
        voterStatus: voterStatus.value,
        yearsOfResidency: yearsOfResidency.value,
        occupation: occupation.value.trim(),
        employmentStatus: employmentStatus.value,
        monthlyIncome: monthlyIncome.value,
        classification: classification.value
      };
    }

    function validateResident(data, editingId) {
      if (new Date(data.birthdate) > new Date()) return "Birthdate cannot be in the future.";
      if (!/^09\d{9}$/.test(data.mobileNumber)) return "Mobile number must use 09XXXXXXXXX format.";
      const duplicate = residents.find((resident) => {
        const samePerson = resident.firstName.toLowerCase() === data.firstName.toLowerCase() && resident.lastName.toLowerCase() === data.lastName.toLowerCase() && resident.birthdate === data.birthdate;
        const sameMobile = resident.mobileNumber === data.mobileNumber;
        return resident.residentId !== editingId && (samePerson || sameMobile);
      });
      return duplicate ? "Possible duplicate resident found." : "";
    }

    residentForm.addEventListener("submit", (event) => {
      event.preventDefault();
      const editingId = document.getElementById("editingId").value;
      const data = getFormData();
      const error = validateResident(data, editingId);
      if (error) {
        openError(error);
        return;
      }

      openConfirm("Save resident", "Are you sure you want to save this resident?", () => {
        if (editingId) {
          residents = residents.map((resident) => resident.residentId === editingId ? { ...resident, ...data, updatedAt: new Date().toISOString() } : resident);
        } else {
          residents.unshift({ ...data, residentId: generateResidentId(), status: "Active", createdAt: new Date().toISOString(), updatedAt: new Date().toISOString() });
        }
        saveResidents();
        closeResidentModal();
        renderTable();
        openSuccess(editingId ? "Resident information updated successfully." : "Resident successfully registered.");
      });
    });

    document.getElementById("addResidentButton").addEventListener("click", () => openResidentModal());
    document.querySelectorAll(".close-resident-modal").forEach((button) => button.addEventListener("click", closeResidentModal));
    document.getElementById("closeProfile").addEventListener("click", closeProfile);
    searchInput.addEventListener("input", () => { currentPage = 1; renderTable(); });
    statusFilter.addEventListener("change", () => { currentPage = 1; renderTable(); });
    purokFilter.addEventListener("change", () => { currentPage = 1; renderTable(); });
    document.getElementById("pagination").addEventListener("click", (event) => {
      const button = event.target.closest(".page-button");
      if (!button) return;
      currentPage = Number(button.dataset.page);
      renderTable();
    });
    window.addEventListener("resize", () => { currentPage = 1; renderTable(); });
    residentTable.addEventListener("click", (event) => {
      const button = event.target.closest(".view-resident");
      if (button) openProfile(button.dataset.id);
    });

    document.getElementById("editResidentButton").addEventListener("click", () => {
      const resident = residents.find((item) => item.residentId === selectedResidentId);
      closeProfile();
      openResidentModal(resident);
    });

    document.getElementById("archiveResidentButton").addEventListener("click", () => {
      const resident = residents.find((item) => item.residentId === selectedResidentId);
      const nextStatus = resident.status === "Archived" ? "Active" : "Archived";
      openConfirm(nextStatus === "Archived" ? "Archive resident" : "Restore resident", `Proceed to ${nextStatus === "Archived" ? "archive" : "restore"} this resident?`, () => {
        residents = residents.map((item) => item.residentId === selectedResidentId ? { ...item, status: nextStatus, archivedAt: nextStatus === "Archived" ? new Date().toISOString() : "" } : item);
        saveResidents();
        closeProfile();
        renderTable();
        openSuccess(nextStatus === "Archived" ? "Resident archived successfully." : "Resident restored successfully.");
      });
    });

    document.getElementById("deleteResidentButton").addEventListener("click", () => {
      openConfirm("Delete resident", "Proceed to delete this resident record?", () => {
        residents = residents.filter((item) => item.residentId !== selectedResidentId);
        saveResidents();
        closeProfile();
        currentPage = 1;
        renderTable();
        openSuccess("Resident record deleted successfully.");
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

    renderTable();
  </script>
</body>
</html>
