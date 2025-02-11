<?php include "includes/header_admin.php"; ?>

<style>
    .modal {
        z-index: 1050;
        /* Bootstrap default for modals */
    }

    .modal-backdrop {
        z-index: 1040;
        /* Bootstrap default for modal backdrop */
    }
</style>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Manage Labs</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Labs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Lab List Section -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <button class="btn-sm btn-primary" onclick="openLabModal()">Add Lab</button>
                </div>
                <div class="pb-20">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Lab Name</th>
                                <th>Lab Logo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="lab-list">
                            <!-- Lab rows will be added dynamically here -->
                            <?php viewAllLabs(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lab Modal -->
<div id="labModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Lab</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="labForm" name="manageLab" method="POST" enctype="multipart/form-data">
                    <?php addLabs(); ?>

                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <input type="hidden" id="labId" name="labId"><!-- Hidden lab ID -->
                    <div class="form-group">
                        <label>Lab Name</label>
                        <input type="text" id="labName" name="labName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Lab Logo</label>
                        <input type="file" id="labLogo" name="labLogo" class="form-control" accept="image/*,.pdf" required>
                    </div>
                    <button type="submit" name="addLabs" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(labId) {
        if (confirm("Are you sure you want to delete this lab? This action cannot be undone.")) {
            window.location.href = "lab_delete.php?delete=" + labId;
        }
    }
</script>
<script>
    let labs = [];

    document.getElementById("labForm").addEventListener("submit", function(event) {
        // event.preventDefault();
        const labId = document.getElementById("labId").value;
        const labName = document.getElementById("labName").value;
        const labLogo = document.getElementById("labLogo").files[0]?.name || "default-logo.png"; // Corrected ID

        if (labId) {
            labs[labId] = {
                name: labName,
                logo: labLogo
            };
        } else {
            labs.push({
                name: labName,
                logo: labLogo
            });
        }

        updateLabList();
        closeModal(); // Close the modal
    });

    function openLabModal(index = null) {
        document.getElementById("labForm").reset();
        document.getElementById("labId").value = index !== null ? index : "";
        if (index !== null) {
            document.getElementById("labName").value = labs[index].name;
        }
        $('#labModal').modal('show');
    }

    function closeModal() {
        $('#labModal').modal('hide');
        $('.modal-backdrop').remove(); // Ensure backdrop is removed
    }

    function deleteLab(index) {
        labs.splice(index, 1);
        updateLabList();
    }

    function updateLabList() {
        const labList = document.getElementById("lab-list");
        labList.innerHTML = "";
        labs.forEach((lab, index) => {
            labList.innerHTML += `
                <tr>
                    <td>${lab.name}</td>
                    <td><img src="../src/images/add_lab_image/${lab.logo}" alt="Lab Logo" width="50"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="openLabModal(${index})">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteLab(${index})">Delete</button>
                    </td>
                </tr>`;
        });
    }
</script>
<?php include "includes/footer_admin.php"; ?>