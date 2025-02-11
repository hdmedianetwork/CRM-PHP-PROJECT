<?php
include "includes/db.php";
include "includes/header.php";

?>

<style>

.imagecontainer {
    width: 100%;
    height: 150px; /* Adjust the height as needed */
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.imagecontainer img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* Ensures the image fits inside without overflow */
    transition: transform 0.3s ease-in-out;
}

/* Hover Effect */
.imagecontainer:hover {
    transform: scale(1.05); /* Slightly enlarge the container */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Add a smooth shadow */
}

.imagecontainer:hover img {
    transform: scale(1.1); /* Slightly enlarge the image */
}

/* Ensure all cards are of equal height */
.mcon {
    width: 100%;
    min-height: 280px; /* Set a minimum height for uniformity */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    background: white;
}

/* Ensure image container size is fixed */
.imagecontainer {
    width: 100%;
    height: 150px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.imagecontainer img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease-in-out;
}

/* Ensure text content is aligned properly */
.bottom {
    text-align: center;
    width: 100%;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.bottom h4 {
    font-size: 16px;
    font-weight: bold;
    margin: 10px 0;
    min-height: 50px; /* Fixed height for uniformity */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Button Styling */
.bottom a {
    margin-top: 10px;
}

/* Hover Effect on Whole Card */
.mcon:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Extra hover effect on image */
.mcon:hover .imagecontainer img {
    transform: scale(1.1);
}


</style>


<link rel="stylesheet" href="src\styles\booktest.css" class="css">
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
                <img src="https://cdn-icons-png.flaticon.com/512/2652/2652234.png" alt="">
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
                                    
                                        <h4> <img src="https://cdn-icons-png.flaticon.com/512/620/620423.png" style="margin-right: 12px;" alt=""> <a href="#"><?php echo htmlspecialchars($lab['lab_name']); ?></a></h4>
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