<?php
include "includes/db.php";
include "includes/header.php";

?>

<div class="mobile-menu-overlay"></div>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Select Lab</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Select Lab</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="search">
                <img src="vendors/images/search.jpeg" alt="">
                <input type="text" placeholder="Search Labs...">
            </div>

            <!-- PHP Logic for Pagination -->
            <?php
            // Define labs per page
            $labsPerPage = 8;
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $startIndex = ($currentPage - 1) * $labsPerPage;

            // Fetch total labs count
            $totalResult = mysqli_query($db_conn, "SELECT COUNT(*) AS total FROM labs");
            $totalRow = mysqli_fetch_assoc($totalResult);
            $totalLabs = $totalRow['total'];
            $totalPages = ceil($totalLabs / $labsPerPage);

            // Fetch labs from database with pagination
            $query = "SELECT id, lab_name, lab_logo FROM labs LIMIT $startIndex, $labsPerPage";
            $result = mysqli_query($db_conn, $query);
            ?>

            <!-- Labs List
            <div class="product-wrap">
                <div class="product-list">
                    <ul class="row">
                        <?php //while ($lab = mysqli_fetch_assoc($result)): 
                        ?>
                            <li class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="product-box" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                    <div class="producct-img" style="height: 150px; overflow: hidden;">
                                        <img src="src/images/<?php //echo $lab['lab_logo']; 
                                                                ?>" alt="" style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="product-caption" style="text-align: center;">
                                        <h4><a href="#"><?php //echo htmlspecialchars($lab['lab_name']); 
                                                        ?></a></h4>
                                        <a href="select_test?lab_name=<?php //echo $lab['lab_name']; 
                                                                        ?>" class="btn btn-outline-primary" style="margin-top: 10px;">Select</a>
                                    </div>
                                </div>
                            </li>
                        <?php //endwhile; 
                        ?>
                    </ul>
                </div>
            </div> -->
            <!-- Labs List -->
            <div class="product-wrap">
                <div class="product-list">
                    <ul class="cards">
                        <?php while ($lab = mysqli_fetch_assoc($result)): ?>
                            <li class="mcon">
                                <div class="" style="">
                                    <div class="imagecontainer" style="">
                                        <img src="src/images/<?php echo $lab['lab_logo']; ?>" alt="" style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="bottom" style="">
                                        <h4> <img src="vendors/images/<?php echo $lab['lab_logo']; ?>" alt=""> <a href="#"><?php echo htmlspecialchars($lab['lab_name']); ?></a></h4>
                                        <a href="select_test?lab_name=<?php echo $lab['lab_name']; ?>" class="btn btn-outline-primary" style="margin-top: 10px;">Select</a>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>

            <!-- Pagination -->
            <div class="blog-pagination mb-30">
                <div class="btn-toolbar justify-content-center mb-15">
                    <div class="btn-group">
                        <?php if ($currentPage > 1): ?>
                            <a href="?page=<?php echo $currentPage - 1; ?>" class="btn btn-outline-primary prev"><i class="fa fa-angle-double-left"></i></a>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="btn <?php echo $i === $currentPage ? 'btn-primary' : 'btn-outline-primary'; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?page=<?php echo $currentPage + 1; ?>" class="btn btn-outline-primary next"><i class="fa fa-angle-double-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>