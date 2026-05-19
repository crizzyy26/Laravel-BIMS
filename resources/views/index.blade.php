<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Barangay Information Management System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            border: "#dbeafe",
            input: "#dbeafe",
            ring: "#2563eb",
            background: "#ffffff",
            foreground: "#172554",
            primary: {
              DEFAULT: "#2563eb",
              foreground: "#ffffff"
            },
            muted: {
              DEFAULT: "#eff6ff",
              foreground: "#475569"
            }
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

    .glass-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(18px);
    }

    .modal-open {
      overflow: hidden;
    }
  </style>
</head>
<body class="min-h-screen bg-white text-slate-900">
  <main class="relative min-h-screen overflow-hidden">
    <div class="absolute -left-24 top-0 h-72 w-72 rounded-full bg-blue-100 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-blue-200/70 blur-3xl"></div>
    <div class="absolute inset-x-0 top-0 h-2 bg-blue-600"></div>

    <section class="relative mx-auto flex min-h-screen w-full max-w-6xl items-center px-5 py-10 sm:px-8 lg:px-10">
      <div class="grid w-full overflow-hidden rounded-[2rem] border border-blue-100 bg-white shadow-soft lg:grid-cols-[1.05fr_0.95fr]">
        <!-- Protected brand panel: keep this Davao City image/label permanent and non-interactive. -->
        <div class="pointer-events-none relative min-h-[320px] select-none bg-blue-900 lg:min-h-[650px]" aria-hidden="true">
          <img
            src="https://commons.wikimedia.org/wiki/Special:FilePath/Davao%20City%20Hall.jpg"
            alt="Davao City"
            class="absolute inset-0 h-full w-full object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-blue-950/85 via-blue-950/25 to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-7 sm:p-9">
            <p class="text-sm font-medium uppercase tracking-[0.24em] text-blue-100">Davao City</p>
            <h1 class="mt-3 max-w-md text-3xl font-bold leading-tight text-white sm:text-4xl">
              Barangay Information Management System
            </h1>
          </div>
        </div>

        <div class="flex items-center border-t border-blue-100 bg-white p-6 sm:p-8 lg:border-l lg:border-t-0 lg:p-10">
          <div class="w-full">
            <div class="mb-8">
              <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                <i data-lucide="log-in" class="h-6 w-6"></i>
              </div>
              <h2 class="text-2xl font-bold text-blue-950">Sign in</h2>
            </div>

            <form id="loginForm" class="space-y-5">
            <div class="space-y-2">
              <label for="username" class="text-sm font-medium text-blue-950">Username</label>
              <div class="relative">
                <i data-lucide="user-round" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>
                <input
                  id="username"
                  name="username"
                  type="text"
                  autocomplete="username"
                  required
                  placeholder="admin"
                  class="h-12 w-full rounded-xl border border-blue-100 bg-white pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                />
              </div>
            </div>

            <div class="space-y-2">
              <div class="flex items-center justify-between gap-3">
                <label for="password" class="text-sm font-medium text-blue-950">Password</label>
                <button type="button" data-action="Password recovery" class="confirm-action text-sm font-medium text-blue-700 hover:text-slate-600">
                  Forgot password?
                </button>
              </div>
              <div class="relative">
                <i data-lucide="lock-keyhole" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  required
                  placeholder="Enter password"
                  class="h-12 w-full rounded-xl border border-blue-100 bg-white pl-12 pr-12 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                />
                <button type="button" id="togglePassword" aria-label="Show password" class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-slate-500 hover:bg-gray-100 hover:text-slate-700">
                  <i data-lucide="eye" class="h-5 w-5"></i>
                </button>
              </div>
            </div>

            <div class="flex items-center justify-between gap-3">
              <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" class="h-4 w-4 rounded border-blue-200 text-blue-600 focus:ring-blue-500" />
                Remember me
              </label>
              <span class="text-sm font-medium text-blue-700">Staff access</span>
            </div>

            <button type="submit" class="flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
              Sign in
              <i data-lucide="arrow-right" class="h-5 w-5"></i>
            </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

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
    const modalBackdrop = document.getElementById("modalBackdrop");
    const modalIcon = document.getElementById("modalIcon");
    const modalTitle = document.getElementById("modalTitle");
    const modalMessage = document.getElementById("modalMessage");
    const confirmActions = document.getElementById("confirmActions");
    const successActions = document.getElementById("successActions");
    const cancelModal = document.getElementById("cancelModal");
    const proceedModal = document.getElementById("proceedModal");
    const closeSuccess = document.getElementById("closeSuccess");
    const loginForm = document.getElementById("loginForm");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    let pendingAction = "";
    let successRedirect = "";

    function refreshIcons() {
      lucide.createIcons();
    }

    function openModal(type, title, message) {
      const isSuccess = type === "success";
      const isError = type === "error";

      modalIcon.innerHTML = isSuccess
        ? '<i data-lucide="circle-check" class="h-6 w-6"></i>'
        : isError
          ? '<i data-lucide="circle-alert" class="h-6 w-6"></i>'
          : '<i data-lucide="circle-help" class="h-6 w-6"></i>';

      modalIcon.className = isSuccess
        ? "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white"
        : isError
          ? "mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-red-600"
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

    function confirmAction(action) {
      pendingAction = action;
      openModal("confirm", "Confirm action", `Proceed with ${action}?`);
    }

    loginForm.addEventListener("submit", (event) => {
      event.preventDefault();

      if (!loginForm.checkValidity()) {
        loginForm.reportValidity();
        return;
      }

      if (usernameInput.value.trim() !== "admin" || passwordInput.value !== "admin123") {
        openModal("error", "Login failed", "Invalid username or password.");
        return;
      }

      localStorage.setItem("bimsUser", usernameInput.value.trim());
      successRedirect = "dashboard.html";
      openModal("success", "Success", "Login completed successfully.");
    });

    document.querySelectorAll(".confirm-action").forEach((button) => {
      button.addEventListener("click", () => {
        confirmAction(button.dataset.action || button.textContent.trim());
      });
    });

    proceedModal.addEventListener("click", () => {
      const completedAction = pendingAction || "action";
      openModal("success", "Success", `${completedAction.charAt(0).toUpperCase()}${completedAction.slice(1)} completed successfully.`);
    });

    cancelModal.addEventListener("click", closeModal);
    closeSuccess.addEventListener("click", () => {
      if (successRedirect) {
        window.location.href = successRedirect;
        return;
      }

      closeModal();
    });

    togglePassword.addEventListener("click", () => {
      const isHidden = passwordInput.type === "password";
      passwordInput.type = isHidden ? "text" : "password";
      togglePassword.innerHTML = isHidden
        ? '<i data-lucide="eye-off" class="h-5 w-5"></i>'
        : '<i data-lucide="eye" class="h-5 w-5"></i>';
      togglePassword.setAttribute("aria-label", isHidden ? "Hide password" : "Show password");
      refreshIcons();
    });

    refreshIcons();
  </script>
</body>
</html>
