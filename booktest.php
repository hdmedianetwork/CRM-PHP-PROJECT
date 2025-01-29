<?php include "includes/header.php"; ?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
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

            <!-- PHP Logic for Pagination -->
            <?php
            // Define total labs and labs per page
            $totalLabs = 21;
            $labsPerPage = 8;
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Calculate total pages
            $totalPages = ceil($totalLabs / $labsPerPage);

            // Calculate the starting lab index for the current page
            $startIndex = ($currentPage - 1) * $labsPerPage;

            // Generate labs data dynamically
            $labs = [];
            for ($i = 1; $i <= $totalLabs; $i++) {
                $labs[] = [
                    'name' => "Lab $i",
                    'image' => "vendors/images/product-img" . (($i % 4) + 1) . ".jpg", // Rotates through 4 example images
                ];
            }

            // Get labs for the current page
            $labsToShow = array_slice($labs, $startIndex, $labsPerPage);
            ?>

            <!-- Labs List -->
            <div class="product-wrap">
                <div class="product-list">
                    <ul class="row">
                        <?php foreach ($labsToShow as $lab): ?>
                            <li class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="product-box" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                    <div class="producct-img" style="height: 150px; overflow: hidden;">
                                        <img src="<?php echo $lab['image']; ?>" alt="" style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="product-caption" style="text-align: center;">
                                        <h4><a href="#"><?php echo $lab['name']; ?></a></h4>
                                        <a href="#" class="btn btn-outline-primary" style="margin-top: 10px;">Select</a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
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