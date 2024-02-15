<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="home.php" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" onclick="load_notification();">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="loadnotif">



            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<script>
    function load_notification(view = '') {
        fetch('Utilities/fetch-notif-func.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    view: view
                })
            })
            .then(response => response.json())
            .then(data => {
                document.querySelector('#loadnotif').innerHTML = '<span class="dropdown-item dropdown-header" id="count"></span>' + data.notification;
                if (data.new_notification > 0) {
                    document.querySelector('.count').innerHTML = data.new_notification;
                    document.querySelector('#count').innerHTML = 'Total Kilometer reached count : ' + data.totalcount;
                }
            });
    }

    //setInterval(load_notification, 5000);
    setTimeout(load_notification, 1000);
</script>