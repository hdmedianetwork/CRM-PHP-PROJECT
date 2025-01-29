<?php include "includes/header.php"; ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Recent Bookings</h4>
            </div>
            <div class="pb-20">
                <table class="table hover multiple-select-row data-table-export nowrap">
                    <thead>
                        <tr>
                            <th>Select Dispatch Item</th>
                            <th>SR NO</th>
                            <th>Patient ID</th>
                            <th>Booking ID</th>
                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Patient Age</th>
                            <th>Lab Name</th>
                            <th>Order Status</th>
                            <th>Dispatch Type</th>
                            <th>Order Amount</th>
                            <th>Booking Date</th>
                            <th>Test Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>1</td>
                            <td>P001</td>
                            <td>B001</td>
                            <td>John Doe</td>
                            <td>Male</td>
                            <td>45</td>
                            <td>ABC Labs</td>
                            <td>Completed</td>
                            <td>Home Delivery</td>
                            <td>$100</td>
                            <td>2025-01-28</td>
                            <td>Blood Test</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>2</td>
                            <td>P002</td>
                            <td>B002</td>
                            <td>Jane Smith</td>
                            <td>Female</td>
                            <td>32</td>
                            <td>XYZ Labs</td>
                            <td>Pending</td>
                            <td>Pickup</td>
                            <td>$200</td>
                            <td>2025-01-27</td>
                            <td>COVID Test</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>3</td>
                            <td>P003</td>
                            <td>B003</td>
                            <td>Robert Brown</td>
                            <td>Male</td>
                            <td>50</td>
                            <td>DEF Labs</td>
                            <td>In Progress</td>
                            <td>Home Delivery</td>
                            <td>$150</td>
                            <td>2025-01-26</td>
                            <td>Urine Test</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>
</div>

<?php include "includes/footer.php"; ?>