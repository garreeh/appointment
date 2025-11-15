<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header("Location: /appointment/index.php");
  exit();
}
?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Search -->
  <h1 class="h3 mb-0 text-gray-800 ps-3">
    <?php echo "User Name: " . $_SESSION['user_fullname']; ?>
  </h1>

  <!-- Push right -->
  <ul class="navbar-nav ml-auto">

    <!-- Notification Icon -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>

        <!-- Counter badge -->
        <span id="notification-counter" class="badge badge-danger badge-counter">0</span>
      </a>

      <!-- Dropdown content -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="notificationsDropdown">

        <h6 class="dropdown-header">Notifications</h6>

        <!-- Dynamic list here -->
        <div id="notifications-list"></div>

      </div>
    </li>

  </ul>

</nav>

<script>
  function loadNotifications() {
    fetch("/appointment/controllers/users/user_get_notification.php")
      .then(res => res.json())
      .then(data => {
        let list = document.getElementById("notifications-list");
        let counter = document.getElementById("notification-counter");

        list.innerHTML = "";

        if (data.length === 0) {
          list.innerHTML = `
          <span class="dropdown-item text-center small text-gray-500">
            No notifications
          </span>
        `;
          counter.innerText = "0";
          return;
        }

        counter.innerText = data.length;

        data.forEach(item => {
          let notificationItem = document.createElement('div');
          notificationItem.classList.add('dropdown-item', 'd-flex', 'align-items-center', 'justify-content-between');

          // Notification content with spacing for the X button
          notificationItem.innerHTML = `
          <div>
            <div class="small text-gray-500">${item.updated_at}</div>
            <a href="${item.redirect_url}" class="notification-link">${item.message}</a>
          </div>
          <button class="btn btn-sm btn-danger remove-notification" data-id="${item.appointment_id}" style="margin-left:10px;">&times;</button>
        `;

          list.appendChild(notificationItem);
        });

        // Add remove button click events
        document.querySelectorAll('.remove-notification').forEach(button => {
          button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent dropdown from closing
            let appointmentId = this.dataset.id;

            fetch('/appointment/controllers/admin/remove_notification.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `appointment_id=${appointmentId}`
              })
              .then(res => res.json())
              .then(res => {
                if (res.status === 'success') {
                  loadNotifications(); // Reload notifications after removal
                } else {
                  alert('Error removing notification: ' + res.message);
                }
              })
              .catch(err => console.log(err));
          });
        });
      })
      .catch(err => console.log(err));
  }

  // Load notifications immediately
  loadNotifications();

  // Auto-refresh every 10 seconds
  setInterval(loadNotifications, 10000);
</script>