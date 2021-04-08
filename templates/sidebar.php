<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Sidebar</h3>
        </div>

        <ul class="list-unstyled components">
            <br>
            <li class="active">
                <a href="/tus-control_pen/pen_index.php">Home</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="/tus-control_pen/table1.php">Page 1</a>
                    </li>
                    <li>
                        <a href="/tus-control_pen/table2.php">Page 2</a>
                    </li>
                    <li>
                        <a href="/tus-control_pen/table3.php">Page 3</a>
                    </li>
                    <li>
                        <a href="/tus-control_pen/table4.php">Page 4</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="/tus-control_pen/logout.php" class="article">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="/tus-control_pen/pen_index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" name="Logout" href="./logout.php" role="button">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>