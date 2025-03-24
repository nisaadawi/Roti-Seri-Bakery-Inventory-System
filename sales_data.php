<?php include 'db_connect.php'; ?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <!-- <div class="card-header">
            <button class="btn btn-sm btn-primary btn-flat" id="toggle_add_form"><i class="fa fa-plus"></i> Add Sales File</button>
        </div>

          Hidden Add Sales Form 
         <div id="add_form" style="display: none; margin: 20px;">
            <form id="add_sales_form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="sales_file">Upload Sales File (CSV)</label>
                    <input type="file" class="form-control" id="sales_file" name="sales_file" accept=".csv" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" id="cancel_add_form">Cancel</button>
                </div>
            </form>
        </div> -->


        <div class="card-body">
            <!-- Sales List Table -->
            <table class="table table-hover table-bordered" id="sales_list">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Sales (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM sales");
                    while ($row = $qry->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><b><?php echo $row['product_code']; ?></b></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                            <td><?php echo $row['month']; ?></td>
                            <td>RM<?php echo number_format($row['sales'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>


            <!-- Charts Section -->
            <div class="row">
                <div class="col-md-6">
                    <h4>Top Products</h4>
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4>Ingredient Trends</h4>
                    <canvas id="ingredientTrendsChart"></canvas>
                </div>
            </div>


        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $('#sales_list').dataTable();


        // Toggle Add Form
        $('#toggle_add_form').click(function() {
            $('#add_form').toggle();
        });


        $('#cancel_add_form').click(function() {
            $('#add_form').hide();
        });


        // Handle form submission
    $('#add_sales_form').submit(function (e) {
        e.preventDefault();


        var formData = new FormData(this);


        $.ajax({
            url: 'ajax.php?action=upload_sales_file',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 1) {
                    alert("Sales data successfully uploaded");
                    location.reload();
                } else {
                    alert("Failed to upload sales data");
                }
            }
        });
    });


        // Dummy data for ingredient trends
        const ingredientTrends = {
            labels: ['Chocolate', 'Flour', 'Egg', 'Sugar', 'Butter'],
            datasets: [{
                label: 'Ingredient Usage (kg)',
                data: [1200, 1155, 1000, 950, 900], // Dummy sales data for each ingredient
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(74, 44, 136, 0.2)'
                ],
                borderColor: [
                    'rgb(187, 43, 74)',
                    'rgb(19, 127, 199)',
                    'rgb(212, 166, 48)',
                    'rgb(52, 155, 155)',
                    'rgb(110, 63, 203)'
                ],
                borderWidth: 1
            }]
        };


        // Create the chart using Chart.js
        const ctx = document.getElementById('ingredientTrendsChart').getContext('2d');
        const ingredientTrendsChart = new Chart(ctx, {
            type: 'bar', // You can change this to 'bar', 'line', etc.
            data: ingredientTrends,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' kg';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true, // Start the x-axis at zero
                        title: {
                            display: true,
                            text: 'Ingredients'
                        }
                    },
                    y: {
                        beginAtZero: true, // Start the y-axis at zero
                        title: {
                            display: true,
                            text: 'Usage (kg)'
                        }
                    }
                }
            }
        });




        // Add Sales Form Submission
        $('#add_sales_form').submit(function(e) {
            e.preventDefault();
            start_load();
            $.ajax({
                url: 'ajax.php?action=add_sales',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Sales entry successfully added", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        alert_toast("Failed to add sales entry", 'error');
                    }
                }
            });
        });


        $(document).ready(function() {
            // Fetch data for Top Products Chart
            $.ajax({
                url: 'ajax.php?action=fetch_top_products',
                method: 'GET',
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data) {
                        var ctx = document.getElementById('topProductsChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.product_names,
                                datasets: [{
                                    label: 'Total Sales (RM)',
                                    data: data.sales,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                }
            });


            // Fetch data for Ingredient Trends Chart
            $.ajax({
                url: 'ajax.php?action=fetch_ingredient_trends',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const ingredientTrends = {
                        labels: response.ingredients,
                        datasets: [{
                            label: 'Ingredient Usage (kg)',
                            data: response.usage, // Usage values from the response
                            backgroundColor: [
                                'rgba(174, 26, 58, 0.96)',
                                'rgba(47, 156, 229, 0.93)',
                                'rgba(229, 186, 79, 0.94)',
                                'rgba(56, 201, 201, 0.92)',
                                'rgba(110, 52, 228, 0.86)'
                            ],
                            borderColor: [
                                'rgb(187, 43, 74)',
                                'rgb(19, 127, 199)',
                                'rgb(212, 166, 48)',
                                'rgb(52, 155, 155)',
                                'rgb(110, 63, 203)'
                            ],
                            borderWidth: 1
                        }]
                    };


                    const ctx = document.getElementById('ingredientTrendsChart').getContext('2d');
                    const ingredientTrendsChart = new Chart(ctx, {
                        type: 'bar',
                        data: ingredientTrends
                    });
                }
            });


            $('#add_sales_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create a FormData object to handle file upload
                start_load();


                $.ajax({
                    url: 'ajax.php?action=upload_sales', // Adjust URL to your backend handler
                    method: 'POST',
                    data: formData,
                    contentType: false, // Prevent jQuery from setting the content type
                    processData: false, // Prevent jQuery from processing the data
                    success: function(resp) {
                        if (resp == 1) {
                            alert_toast("Sales data successfully uploaded", 'success');
                            setTimeout(function() {
                                location.reload(); // Reload the page after successful upload
                            }, 1500);
                        } else {
                            alert_toast("Failed to upload sales data", 'error');
                        }
                    }
                });
            });


        });


    });
</script>

